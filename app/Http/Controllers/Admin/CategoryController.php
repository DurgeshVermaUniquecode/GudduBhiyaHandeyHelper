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
       $request->validate([
        'name' => 'required|unique:categories',
        'category_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // image validation
    ]);

    $data = $request->only(['name']);

    // Check if image was uploaded
    if ($request->hasFile('category_image')) {
        $image = $request->file('category_image');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

        // Save the image in public/category/image
        $image->move(public_path('category/'), $imageName);

        // Store the relative path in DB
        $data['category_image'] = 'category/' . $imageName;
    }
   // dd($data);
    Category::create($data);

    return redirect()->back()->with('success', 'Category created successfully');
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

   public function updateCategory(Request $request)
{
    $id = $request->input('id');

    $request->validate([
        'name' => 'required|unique:categories,name,' . $id,
        'description' => 'nullable|string',
        'status' => 'nullable|in:active,inactive',
        'category_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    $category = Category::findOrFail($id);

    // Prepare data
    $data = $request->only('name', 'description', 'status');

    // Check if new image uploaded
    if ($request->hasFile('category_image')) {
        // Delete old image if it exists
        if ($category->category_image && file_exists(public_path($category->category_image))) {
            unlink(public_path($category->category_image));
        }

        // Save new image
        $image = $request->file('category_image');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('category/image'), $imageName);
        $data['category_image'] = 'category/image/' . $imageName;
    }

    $category->update($data);

    return redirect()->route('admin.categories.create')->with('success', 'Category updated successfully');
}


    public function destroy(Category $category)
    {
        // $category->delete();

         // Toggle the category status
    $category->status = ($category->status == 'active') ? 'inactive' : 'active';
    
    // Save the updated status
    $category->save();
          return redirect()->back()->with('success', 'Category status updated successfully');

    }
    
}
