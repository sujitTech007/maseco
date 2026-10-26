<?php



namespace App\Http\Controllers\Seller;



use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Material;
use App\Models\ProductSample;

use Illuminate\Support\Facades\Auth;



class MaterialController extends Controller

{

    public function index(Request $request)

    {
      
        // $query = Material::where('supplier_id', Auth::id());

        $supplier = Auth::guard('supplier')->user();
        $query = Material::where('supplier_id', $supplier->id);

        if ($request->filled('search')) {

            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {

            $query->where('status', $request->status);
        }

        $materials = $query->orderBy('id', 'desc')->get();
        $sampleMaterials = Material::where('supplier_id', $supplier->id)->orderBy('name')->get();
        $samples = ProductSample::where('supplier_id', $supplier->id)->with(['material', 'files'])->latest()->get();

        return view('seller.material.index', compact('materials', 'samples', 'sampleMaterials'));
    }



    public function create()

    {

        return view('seller.material.create');
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

           'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',

            'status' => 'nullable|in:active,inactive',

            'description' => 'required',

        ]);

        $data = [

            'supplier_id' => Auth::id(),

            // 'supplier_id' => '2',

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



        // if ($request->hasFile('image')) {

        //     $image = $request->file('image');

        //     $imageName = time() . '_' . $image->getClientOriginalName();

        //     $image->move(public_path('assets/images/products'), $imageName);

        //     $data['image'] = 'assets/images/products/' . $imageName;

        // }

        if ($request->hasFile('image')) {
            $image = $request->file('image'); // now this is a single file
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('material-images'), $imageName);
            $data['image'] = 'material-images/' . $imageName;
        }



        Material::create($data);

        return redirect()->route('seller.material')->with('success', 'Material added successfully!');
    }



    public function edit($id)

    {

        $material = Material::where('supplier_id', Auth::id())->findOrFail($id);

        return view('seller.material.edit', compact('material'));
    }



    public function update(Request $request, $id)

    {
        // $material = Material::where('supplier_id', '2')->findOrFail($id);
        $supplier = Auth::guard('supplier')->user();

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

        return redirect()->route('seller.material')->with('success', 'Material updated successfully!');
    }



    public function show($id)

    {

        $material = Material::where('supplier_id', Auth::id())->findOrFail($id);

        return view('seller.material.show', compact('material'));
    }



    public function destroy($id)

    {

        $material = Material::findOrFail($id);

        $material->delete();

        return redirect()->route('seller.material')->with('success', 'Material deleted successfully!');
    }



    public function toggleStatus($id)

    {

        $material = Material::where('supplier_id', Auth::id())->findOrFail($id);

        $material->status = $material->status === 'active' ? 'inactive' : 'active';

        $material->save();

        return response()->json(['status' => $material->status]);
    }
}
