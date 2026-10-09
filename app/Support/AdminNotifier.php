<?php

namespace App\Support;

use App\Filament\Resources\Contacts\ContactResource;
use App\Filament\Resources\TestimonialResource\TestimonialResource;
use App\Models\Contact;
use App\Models\Testimonial;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

/**
 * Avisos dentro del panel (campana): llegan a los usuarios del panel cuando
 * alguien escribe desde el sitio público.
 */
class AdminNotifier
{
    public static function contact(Contact $contact): void
    {
        self::safely(fn () => self::send(
            Notification::make()
                ->title('Nuevo mensaje de contacto')
                ->body("{$contact->name} escribió: ".str($contact->message)->limit(90))
                ->icon('heroicon-o-envelope')
                ->iconColor('danger')
                ->actions([
                    Action::make('ver')->label('Ver mensaje')->button()->markAsRead()
                        ->url(ContactResource::getUrl('edit', ['record' => $contact])),
                ])
        ));
    }

    public static function testimonial(Testimonial $testimonial): void
    {
        if ($testimonial->is_active) {
            return;
        }

        self::safely(fn () => self::send(
            Notification::make()
                ->title('Testimonio por aprobar')
                ->body("{$testimonial->name} dejó {$testimonial->rating} ".($testimonial->rating === 1 ? 'estrella' : 'estrellas').': '.str($testimonial->text)->limit(80))
                ->icon('heroicon-o-star')
                ->iconColor('warning')
                ->actions([
                    Action::make('revisar')->label('Revisar')->button()->markAsRead()
                        ->url(TestimonialResource::getUrl('index', ['filters' => ['is_active' => ['value' => '0']]])),
                ])
        ));
    }

    private static function send(Notification $notification): void
    {
        $notification->sendToDatabase(User::all());
    }

    /** Un aviso fallido nunca debe romper el formulario público. */
    private static function safely(\Closure $callback): void
    {
        try {
            $callback();
        } catch (\Throwable $e) {
            report($e);
        }
    }
}
