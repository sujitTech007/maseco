<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserMaterialCollectionController extends Controller
{
    public function toggle(Request $request, string $collection, Material $material)
    {
        abort_unless(in_array($collection, ['wishlist', 'compare'], true), 404);

        $query = DB::table('user_material_collections')
            ->where('user_id', $request->user()->id)
            ->where('material_id', $material->id)
            ->where('collection', $collection);

        if ($query->exists()) {
            $query->delete();
            $message = $collection === 'wishlist' ? 'Removed from wishlist.' : 'Removed from compare list.';
        } else {
            if ($collection === 'compare' && DB::table('user_material_collections')
                ->where('user_id', $request->user()->id)->where('collection', 'compare')->count() >= 3) {
                return back()->with('error', 'You can compare up to 3 materials at a time.');
            }

            DB::table('user_material_collections')->insert([
                'user_id' => $request->user()->id,
                'material_id' => $material->id,
                'collection' => $collection,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $message = $collection === 'wishlist' ? 'Added to wishlist.' : 'Added to compare list.';
        }

        return back()->with('success', $message);
    }

    public function wishlist(Request $request)
    {
        $materials = $request->user()->collectionMaterials('wishlist')->with(['supplier', 'manufacturer'])->latest('user_material_collections.created_at')->get();
        return view('user.wishlist', compact('materials'));
    }

    public function compare(Request $request)
    {
        $materials = $request->user()->collectionMaterials('compare')->with(['supplier', 'manufacturer'])->latest('user_material_collections.created_at')->get();
        $suggestedMaterials = Material::with(['supplier', 'manufacturer'])
            ->where('status', 'active')
            ->whereNotIn('id', $materials->modelKeys())
            ->latest()
            ->take(6)
            ->get();

        return view('compare', compact('materials', 'suggestedMaterials'));
    }

    public function addToCompare(Request $request, Material $material)
    {
        abort_unless($material->status === 'active', 404);

        $query = DB::table('user_material_collections')
            ->where('user_id', $request->user()->id)
            ->where('material_id', $material->id)
            ->where('collection', 'compare');

        if (!$query->exists()) {
            $count = DB::table('user_material_collections')
                ->where('user_id', $request->user()->id)
                ->where('collection', 'compare')
                ->count();

            if ($count >= 3) {
                return redirect()->route('user.compare')->with('error', 'You can compare up to 3 materials at a time.');
            }

            DB::table('user_material_collections')->insert([
                'user_id' => $request->user()->id,
                'material_id' => $material->id,
                'collection' => 'compare',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('user.compare')->with('success', 'Material added to your comparison.');
    }
}
