<?php

namespace App\Livewire;

use Livewire\Component;

class BannerPreview extends Component
{
    public $bannerUrl;

    public function mount($bannerUrl)
    {
        $this->bannerUrl = $bannerUrl;
    }

    public function render()
    {
        return view('livewire.banner-preview');
    }
}
