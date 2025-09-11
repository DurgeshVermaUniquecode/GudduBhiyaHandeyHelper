<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ServiceType;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with(['category', 'subcategory', 'serviceType'])->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $serviceTypes = ServiceType::all();

        return view('admin.services.create', compact('categories', 'subcategories', 'serviceTypes'));
    }

   public function store(Request $request)
{
    // Validate the request inputs
    $request->validate([
        'category_id' => 'required',
        'title' => 'required|string|max:255',
        'base_price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Image validation
    ]);

    $data = $request->all(); // Get all input data

    // Handle image upload
    if ($request->hasFile('image')) {
        $image = $request->file('image'); // Get the uploaded image
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension(); // Generate a unique name

        // Move the image to the 'public/service' directory
        $image->move(public_path('service/'), $imageName); 

        // Store the relative path to the image in the database
        $data['category_image'] = 'service/' . $imageName;
    }

    // Create a new service record
    Service::create($data);

    // Redirect to the service index page with a success message
    return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
}


    public function edit(Service $service)
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $serviceTypes = ServiceType::all();

        return view('admin.services.edit', compact('service', 'categories', 'subcategories', 'serviceTypes'));
    }

 public function update(Request $request, Service $service)
{
    // Validate the incoming request
    $request->validate([
        'category_id' => 'required',
        'title' => 'required|string|max:255',
        'base_price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validate image if uploaded
    ]);

    // Get all request data
    $data = $request->all();

    // Check if the image is being updated
    if ($request->hasFile('image')) {
        // Delete the old image from the public/service folder if it exists
        if ($service->image && file_exists(public_path('service/' . $service->image))) {
            unlink(public_path('service/' . $service->image));  // Delete old image
        }

        // Store the new image
        $image = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        
        // Move the new image to the 'public/service/' folder
        $image->move(public_path('service/'), $imageName);

        // Store the image path relative to 'public/service/'
        $data['image'] = 'service/' . $imageName;  // Save relative path in DB
    }

    // Update the service record with new data
    $service->update($data);

    // Redirect back with success message
    return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
}



    public function destroy(Service $service)
    {
       // $service->delete();
         $service->status=$service->status=='active'?'inactive':'active';
         $service->save();
        return redirect()->route('admin.services.index')->with('success', 'Service Status update  successfully.');
    }

    public function getSubcategories($category_id)
        {
            $subcategories = SubCategory::where('category_id', $category_id)->get();

            return response()->json($subcategories);
        }

}
