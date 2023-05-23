<?php

namespace App\Http\Livewire;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Slider;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $categories = ServiceCategory::inRandomOrder()->take(18)->get();
        $services = Service::where('featured', 1)->inRandomOrder()->take(8)->get();
        $dash_category = ServiceCategory::where('featured', 1)->take(8)->get();
        $scat_id = ServiceCategory::whereIn('slug', ['plumbing', 'shower-filter', 'water-purifier', 'tv', 'refrigerator', 'movers-packers'])->get()->pluck('id');
        $services_home = Service::whereIn('service_category_id', $scat_id)->inRandomOrder()->take(8)->get();
        $slide = Slider::where('status', 1)->get();
        return view('livewire.home-component', [
            'categories' => $categories,
            'services' => $services,
            'dash_category' => $dash_category,
            'services_home' => $services_home,
            'slide' => $slide
        ])->layout('layouts.main');
    }
}
