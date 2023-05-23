<?php

namespace App\Http\Livewire\Admin;

use App\Models\ServiceCategory;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AdminAddServiceCategoryComponent extends Component
{
    use WithFileUploads;
    public $name;
    public $slug;
    public $image;

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name, '-');
    }

    public function update($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required|mimes:jpeg,png'
        ]);
    }

    public function createCategory()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'image' => 'required|mimes:jpeg,png'
        ]);
        $categories = new ServiceCategory();
        $categories->name = $this->name;
        $categories->slug = $this->slug;
        $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
        $this->image->storeAs('categories', $imageName);
        $categories->image = $imageName;
        $categories->save();
        session()->flash('message', 'Category has been created successfully');
    }

    public function render()
    {
        return view('livewire.admin.admin-add-service-category-component')->layout('layouts.main');
    }
}
