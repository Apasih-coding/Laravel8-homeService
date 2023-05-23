<?php

namespace App\Http\Livewire\Admin;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class AdminServicesComponent extends Component
{
    use WithPagination;

    public function deleteService($service_id)
    {
        $services = Service::find($service_id);
        if ($services->thumbnail) {
            unlink('images/services/thumbnails' . '/' . $services->thumbnail);
        }
        if ($services->image) {
            unlink('images/services' . '/' . $services->image);
        }
        $services->delete();
        session()->flash('message', 'Service has been deleted successfully!');
    }

    public function render()
    {
        $services = Service::paginate(10);
        return view('livewire.admin.admin-services-component', ['services' => $services])->layout('layouts.main');
    }
}
