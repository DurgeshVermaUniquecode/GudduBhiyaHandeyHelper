<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceType;
use App\Models\Subcategory;

class ServiceTypeController extends Controller
{
    public function index()
    {
        $serviceTypes = ServiceType::with('subcategory')->get();
        return view('admin.service_types.index', compact('serviceTypes'));
    }

    public function create()
    {
        $subcategories = Subcategory::all();
        return view('admin.service_types.create', compact('subcategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subcategory_id' => 'required',
            'name' => 'required|unique:service_types',
        ]);
        ServiceType::create($request->all());
        return redirect()->route('service-types.index')->with('success','Service Type created successfully');
    }

    public function edit(ServiceType $serviceType)
    {
        $subcategories = Subcategory::all();
        return view('admin.service_types.edit', compact('serviceType','subcategories'));
    }

    public function update(Request $request, ServiceType $serviceType)
    {
        $request->validate([
            'name' => 'required|unique:service_types,name,'.$serviceType->id,
        ]);
        $serviceType->update($request->all());
        return redirect()->route('service-types.index')->with('success','Service Type updated successfully');
    }

    public function destroy(ServiceType $serviceType)
    {
        $serviceType->delete();
        return redirect()->route('service-types.index')->with('success','Service Type deleted successfully');
    }
}

