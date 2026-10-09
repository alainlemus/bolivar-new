<?php

namespace App\Filament\Pages;

use App\Support\SiteContent;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

/**
 * Textos editables de la página: encabezados, estadísticas, pasos del proceso, banda 24/7…
 * Si un campo se deja vacío, el sitio usa el texto predeterminado.
 */
class SiteContentPage extends Page
{
    protected static ?string $slug = 'textos-del-sitio';

    protected static ?string $navigationLabel = 'Textos del sitio';

    protected static ?string $title = 'Textos del sitio';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPencilSquare;

    protected static string|UnitEnum|null $navigationGroup = 'Configuración del Sitio';

    protected static ?int $navigationSort = 2;

    protected string $view = 'filament.pages.site-content';

    public ?array $data = [];

    public function mount(): void
    {
        // Se muestran los valores actuales (guardados o predeterminados) para editarlos
        $this->form->fill(array_replace_recursive(SiteContent::defaults(), SiteContent::all()));
    }

    public function form(Schema $schema): Schema
    {
        $pageFields = fn (string $key, string $label) => Section::make($label)
            ->columns(2)
            ->collapsible()
            ->schema([
                TextInput::make("pages.$key.eyebrow")->label('Etiqueta superior')->maxLength(60),
                TextInput::make("pages.$key.title")->label('Título')->maxLength(120),
                Textarea::make("pages.$key.subtitle")->label('Subtítulo')->rows(2)->maxLength(300)->columnSpanFull(),
            ]);

        return $schema
            ->statePath('data')
            ->components([
                Tabs::make('Contenido')->persistTabInQueryString()->tabs([
                    Tab::make('Inicio')->icon(Heroicon::OutlinedHome)->schema([
                        Section::make('Portada')->schema([
                            TextInput::make('home.hero_eyebrow')->label('Frase sobre el título')->maxLength(80),
                        ]),
                        Section::make('Cifras destacadas')
                            ->description('Franja oscura bajo la portada. Los números cuentan hacia arriba al aparecer.')
                            ->schema([
                                Repeater::make('home.stats')->label('')->maxItems(4)->defaultItems(0)->addActionLabel('Agregar cifra')->columns(4)->schema([
                                    TextInput::make('value')->label('Número')->numeric()->required(),
                                    TextInput::make('prefix')->label('Antes (ej. +)')->maxLength(3),
                                    TextInput::make('suffix')->label('Después (ej. %, /7)')->maxLength(5),
                                    TextInput::make('label')->label('Descripción')->required()->maxLength(40),
                                ]),
                            ]),
                    ]),

                    Tab::make('Proceso')->icon(Heroicon::OutlinedQueueList)->schema([
                        Section::make('Sección «Cómo te acompañamos»')->columns(2)->schema([
                            TextInput::make('process.eyebrow')->label('Etiqueta superior')->maxLength(60),
                            TextInput::make('process.title')->label('Título')->maxLength(120),
                            Textarea::make('process.intro')->label('Introducción')->rows(2)->maxLength(300)->columnSpanFull(),
                        ]),
                        Section::make('Pasos')->description('Aparecen como línea de tiempo en el inicio y en Servicios.')->schema([
                            Repeater::make('process.steps')->label('')->reorderable()->addActionLabel('Agregar paso')->defaultItems(0)->maxItems(8)->columns(1)
                                ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)->schema([
                                    TextInput::make('title')->label('Título del paso')->required()->maxLength(80),
                                    Textarea::make('text')->label('Descripción')->rows(2)->required()->maxLength(300),
                                ]),
                        ]),
                    ]),

                    Tab::make('Encabezados')->icon(Heroicon::OutlinedRectangleGroup)->schema([
                        $pageFields('servicios', 'Servicios'),
                        $pageFields('planes', 'Planes'),
                        $pageFields('obituario', 'Obituario'),
                        $pageFields('testimonios', 'Testimonios'),
                        $pageFields('guia', 'Guía'),
                        $pageFields('contacto', 'Contacto'),
                    ]),

                    Tab::make('Banda 24/7 y mapa')->icon(Heroicon::OutlinedPhone)->schema([
                        Section::make('Banda de atención inmediata')
                            ->description('Franja con botones de llamada y WhatsApp que aparece al final de varias páginas.')
                            ->columns(1)->schema([
                                TextInput::make('cta.title')->label('Título')->maxLength(100),
                                TextInput::make('cta.text')->label('Texto')->maxLength(200),
                            ]),
                        Section::make('Mapa de panteones y crematorios (Planes)')->columns(2)->schema([
                            TextInput::make('map.eyebrow')->label('Etiqueta superior')->maxLength(60),
                            TextInput::make('map.title')->label('Título')->maxLength(120),
                            Textarea::make('map.text')->label('Texto')->rows(2)->maxLength(300)->columnSpanFull(),
                        ]),
                    ]),
                ]),
            ]);
    }

    public function save(): void
    {
        SiteContent::save($this->form->getState());

        Notification::make()->title('Textos guardados')->body('Los cambios ya se ven en el sitio.')->success()->send();
    }

    public function restoreDefaults(): void
    {
        SiteContent::save([]);
        $this->form->fill(SiteContent::defaults());

        Notification::make()->title('Se restauraron los textos originales')->success()->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('ver')->label('Ver sitio')->icon(Heroicon::OutlinedArrowTopRightOnSquare)->color('gray')->url(url('/'), shouldOpenInNewTab: true),
            Action::make('restaurar')->label('Restaurar originales')->color('gray')->requiresConfirmation()
                ->modalHeading('¿Restaurar los textos originales?')->modalDescription('Se perderán los cambios hechos en esta página.')
                ->action(fn () => $this->restoreDefaults()),
        ];
    }
}
