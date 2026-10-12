<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;

class SubscriptionPlanController extends Controller
{
    public function index()
    {
        $plans = SubscriptionPlan::all();
        return view('admin.subscription.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.subscription.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration' => 'required|string',
            'features' => 'required|array',
            'commission' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);
        $data = $request->only('name', 'price', 'duration', 'commission', 'status');
        $data['features'] = $request->features;
        SubscriptionPlan::create($data);
        return redirect()->route('admin.subscription.index')->with('success', 'Subscription plan added!');
    }

    public function edit($id)
    {
        $plan = SubscriptionPlan::findOrFail($id);
        return view('admin.subscription.edit', compact('plan'));
    }

    public function update(Request $request, $id)
    {
        $plan = SubscriptionPlan::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'duration' => 'required|string',
            'features' => 'required|array',
            'commission' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);
        $data = $request->only('name', 'price', 'duration', 'commission', 'status');
        $data['features'] = $request->features;
        $plan->update($data);
        return redirect()->route('admin.subscription.index')->with('success', 'Subscription plan updated!');
    }

    public function destroy($id)
    {
        $plan = SubscriptionPlan::findOrFail($id);
        $plan->delete();
        return redirect()->route('admin.subscription.index')->with('success', 'Subscription plan deleted!');
    }
}
