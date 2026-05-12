<?php

namespace App\Livewire\Pages;

use App\Models\SiteInfo;
use App\Models\Service;
use App\Models\Plan;
use App\Models\Obituary;
use App\Models\Testimonial;
use App\Models\Slide;
use Livewire\Component;

class Home extends Component
{
    public $currentIndex = 0;
    public $selectedObituary = null;
    public $showObituaryModal = false;
    public $selectedImageIndex = null;
    public $showGalleryModal = false;
    public $galleryImages = [];

    protected $seoTitle = 'Funeraria García de Bolívar | Servicios Funerarios de Calidad';
    protected $seoDescription = 'Funeraria García de Bolívar - Más de 50 años de experiencia ofreciendo servicios funerarios integrales, planes de protección familiar y atención personalizada las 24 horas.';
    protected $seoKeywords = 'funeraria, servicios funerarios, planes funerarios, inhumación, cremación, ataúdes, atención 24/7, protección familiar, México';

    public function nextSlide()
    {
        $slidesCount = Slide::where('is_active', true)->count();
        if ($slidesCount > 0) {
            $this->currentIndex = ($this->currentIndex + 1) % $slidesCount;
        }
    }

    public function prevSlide()
    {
        $slidesCount = Slide::where('is_active', true)->count();
        if ($slidesCount > 0) {
            $this->currentIndex = ($this->currentIndex - 1 + $slidesCount) % $slidesCount;
        }
    }

    public function goToSlide($index)
    {
        $this->currentIndex = $index;
    }

    public function openObituaryModal($id)
    {
        $this->selectedObituary = Obituary::find($id);
        $this->showObituaryModal = true;
    }

    public function closeObituaryModal()
    {
        $this->selectedObituary = null;
        $this->showObituaryModal = false;
    }

    public function openGalleryModal($index)
    {
        $this->selectedImageIndex = $index;
        $this->showGalleryModal = true;
    }

    public function closeGalleryModal()
    {
        $this->selectedImageIndex = null;
        $this->showGalleryModal = false;
    }

    public function nextGalleryImage()
    {
        $total = count($this->galleryImages);
        if ($total > 0) {
            $this->selectedImageIndex = ($this->selectedImageIndex + 1) % $total;
        }
    }

    public function prevGalleryImage()
    {
        $total = count($this->galleryImages);
        if ($total > 0) {
            $this->selectedImageIndex = ($this->selectedImageIndex - 1 + $total) % $total;
        }
    }

    public function render()
    {
        $siteInfo = SiteInfo::getSiteInfo();
        $services = Service::where('is_active', true)->orderBy('order')->limit(8)->get();
        $plans = Plan::where('is_active', true)->orderBy('order')->limit(3)->get();
        $obituaries = Obituary::active()
            ->whereNotNull('burial_date')
            ->orderBy('burial_date', 'desc')
            ->limit(4)
            ->get();
        $testimonials = Testimonial::where('is_active', true)
            ->whereIn('rating', [4, 5])
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        $slides = Slide::where('is_active', true)->orderBy('order')->get();

        $galleryImages = $siteInfo->gallery_images ?? [];
        $this->galleryImages = $galleryImages;

        return view('livewire.pages.home', [
            'siteInfo' => $siteInfo,
            'services' => $services,
            'plans' => $plans,
            'obituaries' => $obituaries,
            'testimonials' => $testimonials,
            'slides' => $slides,
            'galleryImages' => $galleryImages,
            'aboutText' => $siteInfo->about_text,
            'missionText' => $siteInfo->mission_text,
            'visionText' => $siteInfo->vision_text,
            'phone' => $siteInfo->phone,
            'address' => $siteInfo->address,
            'whatsapp' => $siteInfo->whatsapp,
            'nosotrosBanner' => $siteInfo->nosotros_banner,
        ]);
    }
}