<?php

namespace App\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $slug, $status, $brand_id;

    public function rules()
    {
        return [

            'name' => 'required|string',
            'slug' => 'required|string',
            'status' => 'nullable',

        ];
    }

    public function resetInput()
    {
        $this->name = Null;
        $this->slug = Null;
        $this->status = Null;
        $this->brand_id = Null;

    }

    public function storeBrand()
    {
        $validateData = $this->validate();
        Brand::create([
            'name'=>$this->name,
            'slug'=>Str::slug($this->slug),
            'status'=>$this->status == true ? '1':'0',
        ]);
        session()->flash('message', 'Brand Added Successfully');
        $this->dispatch('close-model');
        $this->resetInput();
    }

    public function editBrand(int $brand_id)
    {
        $this->brand_id = $brand_id;
        $brand = Brand::findOrFail($brand_id);
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->status = $brand->status;
    }

    public function updateBrand()
    {

        $validateData = $this->validate();
        Brand::findOrFail($this->brand_id)->update([
            'name'=>$this->name,
            'slug'=>Str::slug($this->slug),
            'status'=>$this->status == true ? '1':'0',
        ]);
        session()->flash('message', 'Brand Updated Successfully');
        $this->dispatch('close-model');
        $this->resetInput();
    }

    public function deleteBrand(int $brand_id)
    {
        $this->brand_id = $brand_id;
    }

    public function destroyBrand()
    {
        Brand::findOrFail($this->brand_id)->delete();
        session()->flash('message', 'Brand Deleted Successfully');
        $this->dispatch('close-model');
        $this->resetInput();
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    public function render()
    {
        $brands = Brand::orderBy('id','DESC')->paginate(10);
        return view('livewire.admin.brand.index', ['brands' => $brands])
                ->extends('layouts.admin')
                ->section('content');
    }
}
