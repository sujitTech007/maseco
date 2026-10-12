<?php



namespace App\Http\Controllers\Manufacturer;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Material;



class MaterialController extends Controller

{

    public function index(Request $request)
    {
        $manufacturer = Auth::guard('manufacturer')->user();

        $query = Material::where('manufacturer_id', $manufacturer->id);

        // 🔍 Search by material name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 🔘 Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $materials = $query->latest()->get();

        return view('manufacturer.material.index', compact('materials'));
    }





    public function create()

    {

        return view('manufacturer.material.create');
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

            //    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',

            'status' => 'nullable|in:active,inactive',

            'description' => 'required',

        ]);

        $data = [

            'manufacturer_id' => Auth::id(),

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

            'description' => $request->description ?? '',

        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image'); // now this is a single file
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('material-images'), $imageName);
            $data['image'] = 'material-images/' . $imageName;
        }



        Material::create($data);

        return redirect()->route('manufacturer.material')->with('success', 'Material added successfully!');
    }




    // public function stored(Request $request)

    // {

    //     $manufacturer = Auth::guard('manufacturer')->user();

    //     $data = $request->validate([

    //         'name' => 'required|string|max:255',

    //         'category' => 'nullable|string|max:255',

    //         'sub_category' => 'nullable|string|max:255',

    //         'description' => 'nullable|string',

    //         'grade' => 'nullable|string|max:255',

    //         'strength' => 'nullable|string|max:255',

    //         'size' => 'nullable|string|max:255',

    //         'weight' => 'nullable|string|max:255',

    //         'unit' => 'nullable|string|max:50',

    //         'price' => 'nullable|numeric',

    //         'moq' => 'nullable|numeric',

    //         'stock' => 'nullable|numeric',

    //         'location' => 'nullable|string|max:255',

    //         'lead_time' => 'nullable|string|max:255',

    //         'certification' => 'nullable|string|max:255',

    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

    //     ]);

    //     $data['manufacturer_id'] = $manufacturer->id;

    //     Material::create($data);

    //     return redirect()->route('manufacturer.material')->with('success', 'Material added successfully!');

    // }



    public function edit($id)

    {

        $manufacturer = Auth::guard('manufacturer')->user();

        $material = Material::where('manufacturer_id', $manufacturer->id)->findOrFail($id);

        return view('manufacturer.material.edit', compact('material'));
    }


    public function update(Request $request, $id)

    {

        $manufacturer = Auth::guard('manufacturer')->user();

        $material = Material::where('manufacturer_id', $manufacturer->id)->findOrFail($id);

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

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',

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
            'leadTime',
            'certification',
            'safety',
            'status',
            'description'

        ]);

        $data['sub_category'] = $request->subCategory;

        // if ($request->hasFile('image')) {

        //     $image = $request->file('image');

        //     $imageName = time() . '_' . $image->getClientOriginalName();

        //     $image->move(public_path('material-images'), $imageName);

        //     $data['image'] = 'material-images/' . $imageName;
        // }

        if ($request->hasFile('image')) {
            $image = $request->file('image'); // now this is a single file
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('material-images'), $imageName);
            $data['image'] = 'material-images/' . $imageName;
        }


        $material->update($data);

        return redirect()->route('manufacturer.material')->with('success', 'Material updated successfully!');
    }


    public function updated(Request $request, $id)

    {

        $manufacturer = Auth::guard('manufacturer')->user();

        $material = Material::where('manufacturer_id', $manufacturer->id)->findOrFail($id);

        $data = $request->validate([

            'name' => 'required|string|max:255',

            'category' => 'nullable|string|max:255',

            'sub_category' => 'nullable|string|max:255',

            'description' => 'nullable|string',

            'grade' => 'nullable|string|max:255',

            'strength' => 'nullable|string|max:255',

            'size' => 'nullable|string|max:255',

            'weight' => 'nullable|string|max:255',

            'unit' => 'nullable|string|max:50',

            'price' => 'nullable|numeric',

            'moq' => 'nullable|numeric',

            'stock' => 'nullable|numeric',

            'location' => 'nullable|string|max:255',

            'lead_time' => 'nullable|string|max:255',

            'certification' => 'nullable|string|max:255',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $material->update($data);

        return redirect()->route('manufacturer.material')->with('success', 'Material updated successfully!');
    }



    public function show($id)

    {

        $manufacturer = Auth::guard('manufacturer')->user();

        $material = Material::where('manufacturer_id', $manufacturer->id)->findOrFail($id);

        return view('manufacturer.material.view', compact('material'));
    }



    public function destroy($id)

    {

        $manufacturer = Auth::guard('manufacturer')->user();

        $material = Material::where('manufacturer_id', $manufacturer->id)->findOrFail($id);

        $material->delete();

        return redirect()->route('manufacturer.material')->with('success', 'Material deleted successfully!');
    }



    public function toggleStatus($id)

    {

        $manufacturer = Auth::guard('manufacturer')->user();

        $material = Material::where('manufacturer_id', $manufacturer->id)->findOrFail($id);

        $material->status = $material->status === 'active' ? 'inactive' : 'active';

        $material->save();

        return back()->with('success', 'Status updated');
    }
}
