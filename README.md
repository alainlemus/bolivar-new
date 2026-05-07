# Funeraria García de Bolívar

Laravel 12 + Livewire + Filament v4 CMS para funeraria.

## Stack

- **Laravel 12** con OPcache
- **Livewire** para frontend
- **Filament v4** (v4.11.2) para panel de administración
- **Filament Shield** para autenticación y permisos
- **Herencia de tablas** (polymorphic relations) para contenido reutilizable

## URLs

- **Sitio**: http://bolivarnew.test
- **Admin**: http://bolivarnew.test/admin
- **Usuario admin**: admin@garciadebolivar.com
- **Obituario detalle**: /obituario/{slug}

## Admin - Estructura de Navegación

```
Configuración del Sitio
├── Configuración (SiteInfo)

Secciones
├── Servicios (ServiceResource)
├── Diapositivas (SlideResource)
├── Obituarios (ObituaryResource)
├── Artículos de Guía (ArticleResource)
├── Planes (PlanResource)
└── Testimonios (TestimonialResource)

Usuarios, Roles y Permisos
├── Usuarios (UserResource)
└── Roles (Shield)
```

## Recursos Filament

| Recurso | Modelo | Notas |
|---------|--------|-------|
| SiteInfoResource | SiteInfo | Configuración global del sitio |
| ServiceResource | Service | Servicios funerarios |
| SlideResource | Slide | Diapositivas del hero |
| ArticleResource | Article | Artículos de la guía |
| PlanResource | Plan | Planes funerarios |
| TestimonialResource | Testimonial | Testimonios de clientes |
| ObituaryResource | Obituary | Obituarios con slug para URL |
| UserResource | User | Usuarios con permisos Shield |

## Decisiones Técnicas Importantes

### Tipo navigationGroup

Filament v4 requiere `string|UnitEnum|null` para `$navigationGroup`. Usar `use UnitEnum;` para evitar errores de tipo.

```php
use UnitEnum;
protected static string|UnitEnum|null $navigationGroup = 'MiGrupo';
```

Para grupos traducidos o dinámicos, usar el método estático:

```php
public static function getNavigationGroup(): ?string
{
    return __('filament-shield::filament-shield.nav.group');
}
```

### Herencia de Contenido (Table Inheritance)

Se usa `ContentBlock` con morphs para campos reutilizables:

- `title`, `content`, `image`, `button_text`, `button_url`
- Cada recurso que necesita bloques hereda de `HasContentBlocks` trait
- Método `getBlockFields()` define qué campos mostrar en cada contexto

### Slug en Obituarios

Obituary tiene campo `slug` con `getRouteKeyName()` retornando `'slug'`.
URLs son `/obituario/nombre-slug` en lugar de `/obituario/1`.

### Navegación del Sitio

`resources/views/livewire/components/navigation.blade.php`:
- Resalta página actual con `Route::is()`
- Menú hamburguesa en móvil
- Dropdown para Servicios

### View Transitions

Configuradas en `resources/views/layouts/app.blade.php` para transiciones suaves entre páginas.

## Traducciones

### Filament Shield

Archivo: `lang/vendor/filament-shield/es/filament-shield.php`

```php
'nav.group' => 'Usuarios, Roles y Permisos',
```

### Publicar traducciones

```bash
php artisan lang:publish
```

## Comandos de Mantenimiento

```bash
# Limpiar cachés
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan optimize:clear

# Regenerar cachés
php artisan optimize

# Reiniciar OPcache (si hay errores de tipo persistentes)
# En Herd: redémtodo el servicio o `herd restart`
```

## Resolver Problemas Comunes

### Errores de tipo después de editar recursos

1. `php artisan config:clear && php artisan optimize:clear && php artisan optimize`
2. Si persiste, reiniciar OPcache (Herd: `herd restart`)

### Cambios en navegación no aparecen

Refrescar con Ctrl+Shift+R (hard refresh) o abrir en modo incógnito.

### Navegación en grupo incorrecto

- Verificar que `navigationGroup` coincida con el grupo definido en `AdminPanelProvider`
- Para Shield: usar `NavigationGroup::make(__('filament-shield::filament-shield.nav.group'))`

## Archivos Clave

```
app/
├── Filament/Resources/*/Resource.php  # Recursos con navigationGroup
├── Models/*.php                       # Modelos Eloquent
├── Providers/Filament/AdminPanelProvider.php  # Config panel Filament
lang/vendor/filament-shield/es/filament-shield.php  # Traducciones Shield
resources/views/
├── layouts/app.blade.php              # Layout principal
├── livewire/components/
│   ├── navigation.blade.php            # Navegación sitio
│   └── footer.blade.php                # Footer
routes/web.php                          # Rutas web
```

## Permisos (Shield)

Roles disponibles:
- `super_admin`: Acceso total
- `admin`: Administrador
- `editor`: Editor de contenido
- `viewer`: Solo lectura

Los permisos se asignan por recurso en la configuración de Shield.
