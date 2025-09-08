<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    public function index()
    {
        $serviceTypes = ServiceType::all();
        return view('admin.service_types.index', compact('serviceTypes'));
    }

    public function create(Request $request)
    {   $serviceTypes = ServiceType::all();
          $editServiceType = null;

        // If edit query param exists, find that SubCategory
        if ($request->has('edit')) {
          
            $editServiceType = ServiceType::find($request->edit);
        }
        return view('admin.service_types.create',compact('serviceTypes','editServiceType'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:service_types,name',
            'description' => 'nullable|string',
        ]);

        ServiceType::create($request->only(['name', 'description']));

        return redirect()->back()
                         ->with('success', 'Service Type created successfully.');
    }

    public function edit(ServiceType $serviceType)
    {
        return view('admin.service_types.edit', compact('serviceType'));
    }

    public function update(Request $request, ServiceType $serviceType)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:service_types,name,' . $serviceType->id,
            'description' => 'nullable|string',
        ]);

        $serviceType->update($request->only(['name', 'description']));

        return redirect()->route('admin.service-types.index')
                         ->with('success', 'Service Type updated successfully.');
    }

    public function updateServiceType(Request $request){
            $id = $request->input('id');
$serviceType = ServiceType::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255|unique:service_types,name,' . $serviceType->id,
            'description' => 'nullable|string',
        ]);

        

        $serviceType->update($request->only('name', 'description', 'status')); // use only safe fields

        return redirect()->back()->with('success', 'Service Type updated successfully');
   
    }

    public function destroy(ServiceType $serviceType)
    {
        $serviceType->delete();
        return redirect()->back()
                         ->with('success', 'Service Type deleted successfully.');
    }
}
