<?php

namespace App\Http\Livewire\Sprovider;

use App\Models\ServiceCategory;
use App\Models\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditSproviderProfileComponent extends Component
{
    use WithFileUploads;
    public $service_provider_id;
    public $image;
    public $city;
    public $about;
    public $service_category_id;
    public $service_locations;
    public $newImage;

    public function mount()
    {
        $service_provider = ServiceProvider::where('user_id', Auth::user()->id)->first();
        $this->service_provider_id = $service_provider->id;
        $this->image = $service_provider->image;
        $this->city = $service_provider->city;
        $this->about = $service_provider->about;
        $this->service_category_id = $service_provider->service_category_id;
        $this->service_locations = $service_provider->service_locations;
    }

    public function updateProfile()
    {
        $service_provider = ServiceProvider::where('user_id', Auth::user()->id)->first();
        if ($this->newImage) {
            $imageName = Carbon::now()->timestamp . '.' . $this->newImage->extension();
            $this->newImage->storeAs('sproviders', $imageName);
            $service_provider->image = $imageName;
        }
        $service_provider->city = $this->city;
        $service_provider->about = $this->about;
        $service_provider->service_category_id = $this->service_category_id;
        $service_provider->service_locations = $this->service_locations;
        $service_provider->save();
        session()->flash('message', 'Service provider has been updated successfully!');
    }

    public function render()
    {
        $service_category = ServiceCategory::all();
        return view('livewire.sprovider.edit-sprovider-profile-component', [
            'service_category' => $service_category,
        ])->layout('layouts.main');
    }
}
