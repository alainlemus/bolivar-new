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

    public function render()
    {
        $siteInfo = SiteInfo::getSiteInfo();
        $services = Service::where('is_active', true)->orderBy('order')->limit(8)->get();
        $plans = Plan::where('is_active', true)->orderBy('order')->limit(3)->get();
        $obituaries = Obituary::where('is_active', true)
            ->whereNotNull('burial_date')
            ->orderBy('burial_date', 'desc')
            ->limit(4)
            ->get();
        $testimonials = Testimonial::where('is_active', true)->limit(3)->get();
        $slides = Slide::where('is_active', true)->orderBy('order')->get();

        $galleryImages = $siteInfo->gallery_images
            ? json_decode($siteInfo->gallery_images, true)
            : [];

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
        ]);
    }
}