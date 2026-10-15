#!/bin/sh
set -e

cd /var/www/html

export PORT="${PORT:-8000}"
FPM_MAX_CHILDREN="${FPM_MAX_CHILDREN:-8}"

sed -i "s/__PORT__/${PORT}/" /etc/nginx/http.d/default.conf

# Procesos PHP simultáneos (~40–60 MB cada uno). "zzz-" para cargarse después del
# zz-docker.conf de la imagen oficial y ganarle.
cat > /usr/local/etc/php-fpm.d/zzz-app.conf <<CONF
[www]
user = www-data
group = www-data
listen = 127.0.0.1:9000
pm = dynamic
pm.max_children = ${FPM_MAX_CHILDREN}
pm.start_servers = 3
pm.min_spare_servers = 2
pm.max_spare_servers = 5
pm.max_requests = 500
request_terminate_timeout = 300
; Sin esto php-fpm borra las variables de entorno que inyecta Dokploy.
clear_env = no
catch_workers_output = yes
decorate_workers_output = no
CONF

# Si Dokploy monta un volumen en storage/, puede llegar con dueño root.
mkdir -p storage/logs storage/app/public storage/app/private/livewire-tmp \
    storage/framework/cache/data storage/framework/sessions storage/framework/views bootstrap/cache
chown www-data:www-data storage storage/app storage/app/public storage/app/private
chown -R www-data:www-data storage/logs storage/framework bootstrap/cache storage/app/private/livewire-tmp
find storage/app ! -user www-data -exec chown www-data:www-data {} +

# Migraciones y cachés con el .env de runtime, como www-data. En pruebas
# (Dockerfile.dev pone SKIP_LARAVEL_CACHE=1) no se cachea.
if [ -z "${APP_KEY:-}" ]; then
    echo "AVISO: falta APP_KEY en las variables de entorno (php artisan key:generate --show)."
fi

# La base puede tardar en estar lista (o las variables DB_* estar mal). Se reintenta y,
# si no hay conexión, el contenedor NO se cae: sigue arriba con el aviso en el log para
# poder abrir la terminal, corregir DB_HOST/DB_USERNAME/DB_PASSWORD y reiniciar.
MIGRATED=0
for i in 1 2 3 4 5 6 7 8 9 10; do
    if su-exec www-data php artisan migrate --force; then
        MIGRATED=1
        break
    fi
    echo "Migración falló (intento $i/10). Reintentando en 5 s..."
    sleep 5
done
if [ "$MIGRATED" != "1" ]; then
    echo "ERROR: no se pudo migrar. Revisa DB_HOST (en Dokploy es el 'Internal Host' del servicio MySQL), DB_PORT, DB_DATABASE, DB_USERNAME y DB_PASSWORD."
fi

# storage/ es un volumen persistente: se limpian las vistas compiladas del despliegue anterior.
su-exec www-data php artisan view:clear || true

if [ "${SKIP_LARAVEL_CACHE:-0}" != "1" ]; then
    su-exec www-data php artisan config:cache || true
    su-exec www-data php artisan route:cache || true
    su-exec www-data php artisan view:cache || true
    su-exec www-data php artisan filament:cache-components || true
fi

exec supervisord -c /etc/supervisord.conf
