<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create( Request $request)
    {   $categories = Category::all();
        
          $editCategory = null;

        // If edit query param exists, find that category
        if ($request->has('edit')) {
          
            $editCategory = Category::find($request->edit);
        }

        return view('admin.categories.create',compact('categories','editCategory'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:categories']);
        Category::create($request->all());
        return redirect()->back()->with('success','Category created successfully');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {    
        $request->validate(['name' => 'required|unique:categories,name,'.$category->id]);
        $category->update($request->all());
        return redirect()->route('admin.categories.create')->with('success','Category updated successfully');
    }

    public function updateCategory(Request $request,Category $category){
        $id=$request->input('id');
        $request->validate(['name' => 'required|unique:categories,name,'.$id]);
        $category->update($request->all());
        return redirect()->route('admin.categories.create')->with('success','Category updated successfully');

    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success','Category deleted successfully');
    }
    
}
