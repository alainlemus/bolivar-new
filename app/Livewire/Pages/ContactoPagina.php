<?php

namespace App\Livewire\Pages;

use App\Models\SiteInfo;
use Livewire\Component;

class ContactoPagina extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $message = '';
    public $captcha = '';
    public $captcha_num1;
    public $captcha_num2;

    protected $seoTitle = 'Contacto | Funeraria García de Bolívar';
    protected $seoDescription = 'Contáctanos para más información sobre nuestros servicios funerarios. Atención personalizada, teléfono, WhatsApp y ubicación. Estamos disponibles 24/7.';
    protected $seoKeywords = 'contacto funeraria, teléfono funeraria, WhatsApp funeraria, ubicación funeraria, atención 24/7';

    public function mount()
    {
        $this->generateCaptcha();
    }

    public function generateCaptcha()
    {
        $this->captcha_num1 = rand(1, 9);
        $this->captcha_num2 = rand(1, 9);
        $this->captcha = '';
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'message' => 'required|min:10',
            'captcha' => 'required',
        ]);

        if ((int)$this->captcha !== ($this->captcha_num1 + $this->captcha_num2)) {
            $this->addError('captcha', 'Respuesta incorrecta. Intenta de nuevo.');
            $this->generateCaptcha();
            return;
        }

        $this->reset(['name', 'email', 'phone', 'message', 'captcha']);
        $this->generateCaptcha();

        session()->flash('message', '¡Mensaje enviado correctamente! Nos pondremos en contacto contigo pronto.');
    }

    public function render()
    {
        $siteInfo = SiteInfo::getSiteInfo();

        return view('livewire.pages.contacto-pagina', [
            'siteInfo' => $siteInfo,
            'phone' => $siteInfo->phone,
            'whatsapp' => $siteInfo->whatsapp,
            'email' => $siteInfo->email,
            'address' => $siteInfo->address,
        ]);
    }
}