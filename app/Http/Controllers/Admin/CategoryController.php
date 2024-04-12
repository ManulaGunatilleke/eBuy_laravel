<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller
{
    public function index()
    {
        // Displays the category index view
        return view('admin.category.index');
    }

    public function create()
    {
        // Displays the category creation form
        return view('admin.category.create');
    }

    public function store(CategoryFormRequest $request)
    {
        // Validates the incoming request using the CategoryFormRequest
        $validatedData = $request->validated();

        // Creates a new instance of the Category model
        $category = new Category;
        // Assigns values to the category attributes from the validated data
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];

        // Handles image upload if present in the request
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;

            $file->move('uploads/category/', $filename);

            $category->image = $filename;
        }

        // Assigns values to the category meta fields
        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];

        // Sets category status based on the request input
        $category->status = $request->status == true ? '1' : '0';
        
        // Saves the category to the database
        $category->save();

        // Redirects to the category index page with a success message
        return redirect('admin/category/')->with('message', 'Category Added Successfully');
    }

    public function edit(Category $category)
    {
        // Displays the category creation form
        return view('admin.category.edit', compact('category'));
    }

    public function update(CategoryFormRequest $request, $category)
    {

        // Validates the incoming request using the CategoryFormRequest
        $validatedData = $request->validated();

        $category = Category::findOrFail($category);
                                            //$category = id

        // Assigns values to the category attributes from the validated data
        $category->name = $validatedData['name'];
        $category->slug = Str::slug($validatedData['slug']);
        $category->description = $validatedData['description'];

        
        if ($request->hasFile('image')) {

            $path = 'uploads/category/'.$category->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;

            $file->move('uploads/category/', $filename);

            $category->image = $filename;
        }

        // Assigns values to the category meta fields
        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keyword = $validatedData['meta_keyword'];
        $category->meta_description = $validatedData['meta_description'];

        // Sets category status based on the request input
        $category->status = $request->status == true ? '1' : '0';
        
        // Saves the category to the database
        $category->update();

        // Redirects to the category index page with a success message
        return redirect('admin/category/')->with('message', 'Category updated Successfully');
    }

}
