# Changelog

Todas las versiones de Funeraria García de Bolívar. El número vive en el archivo `VERSION` y sigue
[versionado semántico](https://semver.org/lang/es/):

- **Mayor** (2.0.0): cambios que rompen algo.
- **Menor** (1.1.0): funciones nuevas.
- **Parche** (1.0.1): correcciones.

Cada paso de `develop` a `main` sube la versión y agrega su sección aquí. En
`develop` (pruebas) la versión se muestra como `vX.Y.Z-dev · commit`; en producción,
como `vX.Y.Z`. `/version.json` muestra versión, commit y fecha del despliegue.

## [1.0.0] - 2026-10-15

### Agregado
- Sitio de Funeraria García de Bolívar: portada, servicios, planes, obituario con velas virtuales, testimonios, guía de duelo y contacto.
- Panel de administración (Filament) para datos del sitio, obituarios, planes, artículos, testimonios y contactos.
- SEO: metadatos, Open Graph, datos estructurados (JSON-LD), migas de pan, `sitemap.xml` y `robots.txt` con dominio canónico.
- Aviso de privacidad conforme a la LFPDPPP vigente (aviso simplificado en los formularios) y página de Términos y Condiciones editable desde el panel.
- Portadas fotográficas (WebP) para los artículos de la guía.
- Redirección 301 de dominios alternos (www, `.com.mx`) al dominio canónico (`CANONICAL_HOST`).
- Los obituarios de prueba nunca se muestran ni se conservan en producción.
- Dockerfiles de pruebas (`Dockerfile.dev`) y producción (`Dockerfile.prod`) para Dokploy, con nginx, php-fpm y supervisor en un solo contenedor; las migraciones corren solas al arrancar.
- Versión visible en el pie del sitio y en `/version.json`.

### Corregido
- Desborde horizontal en móvil, salto de tamaño del logo al cargar y X del menú móvil.
- Contenido que desaparecía al encender una vela en el obituario.
- Error 500 de la página cuando no hay número de WhatsApp configurado.
