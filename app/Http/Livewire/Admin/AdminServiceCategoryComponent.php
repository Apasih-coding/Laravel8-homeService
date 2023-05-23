<?php

namespace App\Http\Livewire\Admin;

use App\Models\ServiceCategory;
use Livewire\Component;
use Livewire\WithPagination;

class AdminServiceCategoryComponent extends Component
{
    use WithPagination;

    public function deleteServiceCategory($id)
    {
        $categories = ServiceCategory::find($id);
        if ($categories->image) {
            unlink('images/categories' . '/' . $categories->image);
        }
        $categories->delete();
        session()->flash('message', 'Category has been deleted successfully');
    }

    public function render()
    {
        $categories = ServiceCategory::paginate(10);
        return view('livewire.admin.admin-service-category-component', ['categories' => $categories])->layout('layouts.main');
    }
}
