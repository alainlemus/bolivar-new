<?php

namespace App\Livewire\Pages;

use App\Mail\ContactFormAdminMail;
use App\Mail\ContactFormUserMail;
use App\Models\Contact;
use App\Models\SiteInfo;
use Illuminate\Support\Facades\Mail;
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
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|min:10|max:2000',
            'captcha' => 'required',
        ]);

        if ((int)$this->captcha !== ($this->captcha_num1 + $this->captcha_num2)) {
            $this->addError('captcha', 'Respuesta incorrecta. Intenta de nuevo.');
            $this->generateCaptcha();
            return;
        }

        $siteInfo = SiteInfo::getSiteInfo();

        $logoUrl = null;
        if ($siteInfo->site_logo) {
            $logoUrl = asset('storage/' . $siteInfo->site_logo);
        }

        Contact::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'message' => $this->message,
            'status' => 'pending',
        ]);

        Mail::to($this->email)->send(new ContactFormUserMail(
            $this->name,
            $this->email,
            $this->phone,
            $this->message,
            $logoUrl,
        ));

        if ($siteInfo->admin_email) {
            Mail::to($siteInfo->admin_email)->send(new ContactFormAdminMail(
                $this->name,
                $this->email,
                $this->phone,
                $this->message,
                $logoUrl,
            ));
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