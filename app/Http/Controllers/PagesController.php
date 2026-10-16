<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;


use Illuminate\Http\Request;

use App\Models\Supplier;

use App\Models\Manufacturer;

use App\Models\Material;
use App\Models\Newsletter;
use App\Models\Contact;

use App\Models\User;



class PagesController extends Controller

{

    public function index()

    {

        $plans = \App\Models\SubscriptionPlan::where('status', 'active')->get();

        $suppliers = Supplier::with(['materials' => function ($query) {
            $query->where('status', 'active');
        }])->get();

        return view('index', compact('plans', 'suppliers'));
    }

    public function aboutUs()

    {

        return view('about-us');
    }



    public function blog()

    {

        return view('blog');
    }



    public function contactUs()

    {

        return view('contact-us');
    }

    public function reducingTextiles()

    {

        return view('reducing-textiles');
    }

    public function aiDrivenSuggestion()

    {

        return view('ai-driven-suggestion');
    }

    public function manufacturer()

    {

        $manufacturers = Manufacturer::get();

        return view('manufacturer', compact('manufacturers'));
    }

    public function postProductionServices()

    {

        return view('post-production-services');
    }





    public function listing($id = null)

    {

        $request = request();

        $query = Material::with(['supplier', 'manufacturer'])
    ->where('status', 'active');



        // Search by name/description

        if ($request->filled('q')) {

            $search = $request->string('q');

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")

                    ->orWhere('description', 'like', "%{$search}%");
            });
        }



        // Category (string) or sub_category

        if ($request->filled('category')) {

            $category = $request->string('category');

            $query->where(function ($q) use ($category) {

                $q->where('category', $category)

                    ->orWhere('sub_category', $category);
            });
        }



        // Location

        if ($request->filled('location')) {

            $query->where('location', $request->string('location'));
        }



        // Price range

        if ($request->filled('price_min')) {

            $query->where('price', '>=', (float) $request->input('price_min'));
        }

        if ($request->filled('price_max')) {

            $query->where('price', '<=', (float) $request->input('price_max'));
        }



        // Grade, size (thickness), certification, unit

        if ($request->filled('grade')) {

            $query->where('grade', $request->string('grade'));
        }

        if ($request->filled('size')) {

            $query->where('size', $request->string('size'));
        }

        if ($request->filled('certification')) {

            $query->where('certification', $request->string('certification'));
        }

        if ($request->filled('unit')) {

            $query->where('unit', $request->string('unit'));
        }



        $materials = $query->latest()->get();



        // Distinct lists for filters

        $categories = Material::query()->select('category')->whereNotNull('category')->distinct()->pluck('category');

        $locations = Material::query()->select('location')->whereNotNull('location')->distinct()->pluck('location');

        $grades = Material::query()->select('grade')->whereNotNull('grade')->distinct()->pluck('grade');

        $units = Material::query()->select('unit')->whereNotNull('unit')->distinct()->pluck('unit');



        return view('listing', [

            'materials' => $materials,

            'selectedCategory' => $request->input('category'),

            'categories' => $categories,

            'locations' => $locations,

            'grades' => $grades,

            'units' => $units,

            'filters' => $request->only(['q', 'category', 'location', 'price_min', 'price_max', 'grade', 'size', 'certification', 'unit']),

        ]);
    }



    public function listingDetails($id)

    {

        $material = Material::with(['supplier', 'manufacturer'])->findOrFail($id);

        return view('listing-details', compact('material'));
    }



    public function login()

    {

        return view('login');
    }



    public function signUp()

    {

        return view('sign-up');
    }



    public function singleBlog()

    {

        return view('single-blog');
    }



    public function subscription()

    {

        return view('subscription');
    }



    public function rawMaterialSupplier()

    {

        $suppliers = Supplier::get();

        return view('raw-material-supplier', compact('suppliers'));
    }

    public function subscriptionPlan()

    {

        $plans = \App\Models\SubscriptionPlan::where('status', 'active')->get();

        return view('plan', compact('plans'));
    }



    public function category()

    {

        $categories = \App\Models\Category::where('status', 'active')->get();

        return view('category', compact('categories'));
    }

    public function newsletter(Request $request)
    {
        // Validate email
        $request->validate([
            'email' => 'required|email',
        ]);

        // Check if email already exists
        $exists = Newsletter::where('email', $request->email)->exists();

        if ($exists) {
            return back()->with('success', 'You have already subscribed to our newsletter.');
        }

        // Create new subscription
        $newsletter = new Newsletter();
        $newsletter->email = $request->email;
        $newsletter->save();

        return back()->with('success', 'Newsletter subscription done successfully.');
    }

    public function contactUsStore(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'phone'    => 'required|digits_between:7,15',
            'find_us'  => 'nullable|string|max:100',
        ]);

        // Check if this email has already submitted the contact form
        $exists = Contact::where('email', $request->email)->exists();

        if ($exists) {
            return back()->with('success', 'You have already contacted us earlier. We will get back to you soon!');
        }

        // Create new contact record
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->find_us = $request->find_us;
        $contact->save();

         Mail::to($contact->email)->send(new ContactUsMail($contact));

        return back()->with('success', 'Thank you for reaching out! We will contact you shortly.');
    }
    
    public function termsCondition()
    {
        return view('terms-condition');
    }
    
    public function privacyPolicy()
    {
        return view('privacy-policy');
    }












    
    
}
