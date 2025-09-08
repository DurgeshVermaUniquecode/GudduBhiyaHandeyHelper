<?php 
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subcategories = SubCategory::with('category')->get();
        return view('admin.subcategories.index', compact('subcategories'));
    }

    public function create(Request $request)
    {
        $categories = Category::all();
        $subcategories = SubCategory::with('category')->get();

        $editSubCategory = null;

        // If edit query param exists, find that SubCategory
        if ($request->has('edit')) {
          
            $editSubCategory = SubCategory::find($request->edit);
        }

        return view('admin.subcategories.create', compact('categories','subcategories','editSubCategory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        SubCategory::create($request->all());

        return redirect()->back()->with('success', 'Subcategory created successfully.');
    }

    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all();
        return view('subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $subcategory->update($request->all());

        return redirect()->route('subcategories.index')->with('success', 'Subcategory updated successfully.');
    }

   public function updateSubCategory(Request $request)
{
    $id = $request->input('id');

    $request->validate([
        'name' => 'required|unique:subcategories,name,' . $id,
    ]);

    $subCategory = SubCategory::findOrFail($id);

    $subCategory->update($request->only('category_id', 'name', 'description', 'status'));

    return redirect()->route('admin.subcategories.create')->with('success', 'Subcategory updated successfully');
}


    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->back()->with('success', 'Subcategory deleted successfully.');
    }
}
