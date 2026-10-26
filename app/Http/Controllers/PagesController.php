<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;
use App\Mail\ContactInquiryNotificationMail;
use App\Mail\NewsletterWelcomeMail;
use Illuminate\Support\Facades\Log;


use Illuminate\Http\Request;

use App\Models\Supplier;

use App\Models\Manufacturer;

use App\Models\Material;
use App\Models\Newsletter;
use App\Models\Contact;
use App\Support\PhoneNumber;

use App\Models\User;



class PagesController extends Controller

{

    public function index()

    {

        $plans = \App\Models\SubscriptionPlan::where('status', 'active')->get();

        $materials = Material::with(['supplier', 'manufacturer'])
            ->where('status', 'active')
            ->latest()
            ->get();

        $filterOptions = Material::where('status', 'active')
            ->get(['category', 'sub_category', 'location']);

        $categories = $filterOptions
            ->flatMap(fn ($material) => [$material->category, $material->sub_category])
            ->filter(fn ($value) => filled($value))
            ->unique()
            ->sort()
            ->values();

        $locations = $filterOptions
            ->pluck('location')
            ->filter(fn ($value) => filled($value))
            ->unique()
            ->sort()
            ->values();

        return view('index', compact('plans', 'materials', 'categories', 'locations'));
    }

    public function aboutUs()

    {

        return view('aboutUs');
    }



    public function blog()

    {

        return view('blog');
    }



    public function contactUs()

    {

        return view('contactUs');
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

            $search = (string) $request->input('q');

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")

                    ->orWhere('description', 'like', "%{$search}%");
            });
        }



        // Category (string) or sub_category

        if ($request->filled('category')) {

            $category = (string) $request->input('category');

            $query->where(function ($q) use ($category) {

                $q->where('category', $category)

                    ->orWhere('sub_category', $category);
            });
        }



        // Location

        if ($request->filled('location')) {

            $query->where('location', (string) $request->input('location'));
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

            $query->where('grade', (string) $request->input('grade'));
        }

        if ($request->filled('size')) {

            $query->where('size', (string) $request->input('size'));
        }

        if ($request->filled('certification')) {

            $query->where('certification', (string) $request->input('certification'));
        }

        if ($request->filled('unit')) {

            $query->where('unit', (string) $request->input('unit'));
        }



        $materials = $query->latest()->get();



        // Distinct lists for filters

        $categories = Material::query()->select('category')->whereNotNull('category')->distinct()->pluck('category');

        $locations = Material::query()->select('location')->whereNotNull('location')->distinct()->pluck('location');

        $grades = Material::query()->select('grade')->whereNotNull('grade')->distinct()->pluck('grade');

        $units = Material::query()->select('unit')->whereNotNull('unit')->distinct()->pluck('unit');



        $wishlistIds = auth()->check() ? auth()->user()->collectionMaterials('wishlist')->pluck('materials.id')->all() : [];
        $compareIds = auth()->check() ? auth()->user()->collectionMaterials('compare')->pluck('materials.id')->all() : [];

        return view('listing', [

            'materials' => $materials,

            'selectedCategory' => $request->input('category'),

            'categories' => $categories,

            'locations' => $locations,

            'grades' => $grades,

            'units' => $units,

            'filters' => $request->only(['q', 'category', 'location', 'price_min', 'price_max', 'grade', 'size', 'certification', 'unit']),
            'wishlistIds' => $wishlistIds,
            'compareIds' => $compareIds,

        ]);
    }



    public function listingDetails($id)

    {

        $material = Material::with(['supplier', 'manufacturer'])->findOrFail($id);

        $wishlistIds = auth()->check() ? auth()->user()->collectionMaterials('wishlist')->pluck('materials.id')->all() : [];
        $compareIds = auth()->check() ? auth()->user()->collectionMaterials('compare')->pluck('materials.id')->all() : [];

        return view('listing-details', compact('material', 'wishlistIds', 'compareIds'));
    }



    public function login()

    {

        return view('auth.login');
    }



    public function signUp()

    {

        return view('auth.sign-up');
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

        $activeSubscription = null;
        foreach (['web' => 'buyer', 'supplier' => 'supplier', 'manufacturer' => 'manufacturer'] as $guard => $type) {
            if (\Illuminate\Support\Facades\Auth::guard($guard)->check()) {
                $activeSubscription = \App\Support\SubscriptionAccess::current($type, (int) \Illuminate\Support\Facades\Auth::guard($guard)->id());
                break;
            }
        }

        return view('plan', compact('plans', 'activeSubscription'));
    }



    public function category()

    {

        $categories = \App\Models\Category::where('status', 'active')->get();

        return view('category', compact('categories'));
    }

    public function newsletter(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $email = strtolower(trim($validated['email']));
        $newsletter = Newsletter::firstOrCreate(['email' => $email]);

        try {
            Mail::to($newsletter->email)->send(new NewsletterWelcomeMail($newsletter));
        } catch (\Throwable $exception) {
            Log::error('Newsletter confirmation email could not be sent.', [
                'email' => $newsletter->email,
                'exception' => $exception->getMessage(),
            ]);

            return back()->with('error', 'Your subscription was saved, but we could not send the confirmation email. Please try again later.');
        }

        return back()->with('success', 'Newsletter subscription confirmed.');
    }

    public function contactUsStore(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'phone'    => ['required', 'string', 'max:30', 'regex:/^[0-9+().\s-]+$/'],
            'country_code' => ['required', 'string', 'max:10', 'regex:/^\+[0-9-]+$/'],
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
        $contact->phone = PhoneNumber::toE164($validated['country_code'], $validated['phone']);
        $contact->find_us = $request->find_us;
        $contact->save();

        try {
            Mail::to($contact->email)->send(new ContactUsMail($contact));
        } catch (\Throwable $exception) {
            Log::error('Contact confirmation email could not be sent.', [
                'contact_id' => $contact->id,
                'exception' => $exception->getMessage(),
            ]);
        }

        $notificationAddress = config('mail.contact_to', config('mail.from.address'));
        if ($notificationAddress && $notificationAddress !== $contact->email) {
            try {
                Mail::to($notificationAddress)->send(new ContactInquiryNotificationMail($contact));
            } catch (\Throwable $exception) {
                Log::error('Contact notification email could not be sent.', [
                    'contact_id' => $contact->id,
                    'exception' => $exception->getMessage(),
                ]);
            }
        }

        return back()->with('success', 'Thank you for reaching out! We will contact you shortly.');
    }

    public function termsCondition()
    {
        return view('termsCondition');
    }

    public function privacyPolicy()
    {
        return view('privacy-policy');
    }
}
