<?php

namespace App\Http\Livewire\Admin;

use App\Models\ServiceProvider;
use Livewire\Component;

class AdminServiceProvidersComponent extends Component
{
    public function render()
    {
        $s_provider = ServiceProvider::paginate(12);
        return view('livewire.admin.admin-service-providers-component', ['s_provider' => $s_provider])->layout('layouts.main');
    }
}
