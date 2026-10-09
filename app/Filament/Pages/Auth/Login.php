<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Illuminate\Contracts\Support\Htmlable;

/**
 * Inicio de sesión del panel con diseño dividido:
 * a la izquierda la marca, a la derecha el formulario.
 */
class Login extends BaseLogin
{
    protected static string $layout = 'filament.layouts.auth-split';

    public function getHeading(): string|Htmlable|null
    {
        return filled($this->userUndertakingMultiFactorAuthentication) ? parent::getHeading() : 'Bienvenido de nuevo';
    }

    public function getSubheading(): string|Htmlable|null
    {
        return 'Ingresa tus datos para administrar el sitio.';
    }

    // El logo ya aparece en el panel izquierdo
    public function hasLogo(): bool
    {
        return false;
    }
}
