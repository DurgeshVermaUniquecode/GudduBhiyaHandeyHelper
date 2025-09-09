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
        $request->validate([
            'category_id' => 'required',
            'title' => 'required|string|max:255',
            'base_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        Service::create($data);

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
        $request->validate([
            'category_id' => 'required',
            'title' => 'required|string|max:255',
            'base_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }

    public function getSubcategories($category_id)
        {
            $subcategories = SubCategory::where('category_id', $category_id)->get();

            return response()->json($subcategories);
        }

}
