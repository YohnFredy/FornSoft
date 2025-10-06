<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;


class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate(10);
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255|unique:brands,name',
            'is_active' => 'boolean'
        ]);

        Brand::create($request->only('name', 'is_active'));

        return redirect()->route('admin.brands.index')
            ->with('success', 'Marca creada correctamente.');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name'      => 'required|string|max:255|unique:brands,name,' . $brand->id,
            'is_active' => 'boolean'
        ]);

        $brand->update($request->only('name', 'is_active'));

        return redirect()->route('admin.brands.index')
            ->with('success', 'Marca actualizada correctamente.');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        return redirect()->route('admin.brands.index')
            ->with('success', 'Marca eliminada correctamente.');
    }
}
