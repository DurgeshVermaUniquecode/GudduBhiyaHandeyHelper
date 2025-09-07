<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceType;
use App\Models\Vendor;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with(['serviceType','vendor'])->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $serviceTypes = ServiceType::all();
        $vendors = Vendor::all();
        return view('admin.services.create', compact('serviceTypes','vendors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vendor_id' => 'required',
            'service_type_id' => 'required',
            'title' => 'required',
            'price' => 'required|numeric',
        ]);
        Service::create($request->all());
        return redirect()->route('services.index')->with('success','Service created successfully');
    }

    public function edit(Service $service)
    {
        $serviceTypes = ServiceType::all();
        $vendors = Vendor::all();
        return view('admin.services.edit', compact('service','serviceTypes','vendors'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
        ]);
        $service->update($request->all());
        return redirect()->route('services.index')->with('success','Service updated successfully');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success','Service deleted successfully');
    }
}

