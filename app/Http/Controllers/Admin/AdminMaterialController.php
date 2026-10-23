<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class AdminMaterialController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'certification_status' => ['nullable', 'in:certified,not_certified'],
        ]);

        $query = Material::with(['supplier', 'manufacturer']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('certification_status')) {
            $query->where('is_certified', $request->certification_status === 'certified');
        }

        $materials = $query->get();

        return view('admin.material.index', compact('materials'));
    }

    public function create()
    {
        return view('admin.material.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'subCategory' => 'nullable|string|max:255',
            'grade' => 'nullable|string|max:255',
            'strength' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric',
            'unit' => 'nullable|string|max:50',
            'price' => 'nullable|numeric',
            'moq' => 'nullable|integer',
            'stock' => 'nullable|integer',
            'supplier' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'leadTime' => 'nullable|integer',
            'certification' => 'nullable|string|max:255',
            'safety' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|in:active,inactive',
            'description' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'sku' => $request->sku,
            'category' => $request->category,
            'sub_category' => $request->subCategory,
            'grade' => $request->grade,
            'strength' => $request->strength,
            'size' => $request->size,
            'weight' => $request->weight,
            'unit' => $request->unit,
            'price' => $request->price,
            'moq' => $request->moq,
            'stock' => $request->stock,
            'supplier' => $request->supplier,
            'location' => $request->location,
            'lead_time' => $request->leadTime,
            'certification' => $request->certification,
            'safety' => $request->safety,
            'status' => $request->status ?? 'active',
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/images/products'), $imageName);
            $data['image'] = 'assets/images/products/' . $imageName;
        }

        Material::create($data);

        return redirect()
            ->route('admin.material')
            ->with('success', 'Material added successfully!');
    }

    public function edit($id)
    {
        $material = Material::findOrFail($id);

        return view('admin.material.edit', compact('material'));
    }

    public function update(Request $request, $id)
    {
        $material = Material::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'subCategory' => 'nullable|string|max:255',
            'grade' => 'nullable|string|max:255',
            'strength' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric',
            'unit' => 'nullable|string|max:50',
            'price' => 'nullable|numeric',
            'moq' => 'nullable|integer',
            'stock' => 'nullable|integer',
            'supplier' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'leadTime' => 'nullable|integer',
            'certification' => 'nullable|string|max:255',
            'safety' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable|in:active,inactive',
            'description' => 'required',
        ]);

        $data = $request->only([
            'name',
            'sku',
            'category',
            'grade',
            'strength',
            'size',
            'weight',
            'unit',
            'price',
            'moq',
            'stock',
            'supplier',
            'location',
            'certification',
            'safety',
            'status',
            'description',
        ]);

        $data['sub_category'] = $request->subCategory;
        $data['lead_time'] = $request->leadTime;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('assets/images/products'), $imageName);
            $data['image'] = 'assets/images/products/' . $imageName;
        }

        $material->update($data);

        return redirect()
            ->route('admin.material')
            ->with('success', 'Material updated successfully!');
    }

    public function show($id)
    {
        $material = Material::findOrFail($id);

        return view('admin.material.show', compact('material'));
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();

        return redirect()
            ->route('admin.material')
            ->with('success', 'Material deleted successfully!');
    }

    public function toggleStatus($id)
    {
        $material = Material::findOrFail($id);
        $material->status = $material->status === 'active'
            ? 'inactive'
            : 'active';

        $material->save();

        return response()->json([
            'status' => $material->status,
        ]);
    }

    public function toggleCertification(Request $request, $id)
    {
        $validated = $request->validate([
            'is_certified' => ['required', 'boolean'],
        ]);

        $material = Material::findOrFail($id);
        $material->is_certified = (bool) $validated['is_certified'];
        $material->save();

        return redirect()->route('admin.material', $request->only(['search', 'status', 'certification_status']))
            ->with('success', $material->is_certified
                ? 'Certified Listing badge granted to ' . $material->name . '.'
                : 'Certified Listing badge removed from ' . $material->name . '.');
    }
}
