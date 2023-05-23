<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Livewire\Component;

class ServiceDetailsComponent extends Component
{
    public $service_slug;

    public function mount($service_slug)
    {
        $this->service_slug = $service_slug;
    }

    public function render()
    {
        $service = Service::where('slug', $this->service_slug)->first();
        $id_services = Service::where('service_category_id', $service->service_category_id)->where('slug', '!=', $this->service_slug)->inRandomOrder()->first();
        return view('livewire.service-details-component', ['service' => $service, 'id_services' => $id_services])->layout('layouts.main');
    }
}
