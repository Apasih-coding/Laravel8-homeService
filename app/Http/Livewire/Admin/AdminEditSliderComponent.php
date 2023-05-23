<?php

namespace App\Http\Livewire\Admin;

use App\Models\Slider;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditSliderComponent extends Component
{
    use WithFileUploads;
    public $slide_id;
    public $title;
    public $image;
    public $status;
    public $newImage;

    public function mount($slide_id)
    {
        $slide = Slider::find($slide_id);
        $this->slide_id = $slide->id;
        $this->title = $slide->title;
        $this->image = $slide->image;
        $this->status = $slide->status;
    }

    public function update($fields)
    {
        $this->validateOnly($fields, [
            'title' => 'required',
        ]);
        if ($this->newImage) {
            $this->validateOnly($fields, [
                'newImage' => 'required|mimes:jpeg,png'
            ]);
        }
    }

    public function editSlide()
    {
        $this->validate([
            'title' => 'required',
        ]);
        if ($this->newImage) {
            $this->validate([
                'newImage' => 'required|mimes:jpeg,png'
            ]);
        }
        $slide = Slider::find($this->slide_id);
        $slide->title = $this->title;
        if ($this->newImage) {
            unlink('images/slider' . '/' . $slide->image);
            $imageName = Carbon::now()->timestamp . '.' . $this->newImage->extension();
            $this->newImage->storeAs('slider', $imageName);
            $slide->image = $imageName;
        }
        $slide->status = $this->status;
        $slide->save();
        session()->flash('message', 'Slide has been updated successfully!');
    }

    public function render()
    {
        return view('livewire.admin.admin-edit-slider-component')->layout('layouts.main');
    }
}
