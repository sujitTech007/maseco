@include('Include.header')

<main>
<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
            <div><h3 class="fw-bold mb-2"><i class="fa-solid fa-scale-balanced text-success me-2"></i>Compare Materials</h3><p class="text-muted mb-0">Compare prices, quality, specifications and suppliers before making a decision.</p></div>
            <a href="{{ route('listing') }}" class="btn btn-outline-success"><i class="fa-solid fa-arrow-left me-2"></i>Browse Materials</a>
        </div>

        @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

        @php
            $supplierCount = $materials->map(fn($m) => $m->supplier_id ?: 'manufacturer-'.$m->manufacturer_id)->filter()->unique()->count();
            $lowest = $materials->filter(fn($m) => $m->price !== null)->sortBy('price')->first();
        @endphp
        <div class="row g-3 mb-4">
            <div class="col-md-4"><div class="card border-0 shadow-sm h-100"><div class="card-body d-flex align-items-center gap-3"><div class="bg-success-subtle text-success rounded-3 p-3"><i class="fa-solid fa-boxes-stacked fa-xl"></i></div><div><p class="text-muted mb-1">Materials Compared</p><h4 class="fw-bold mb-0">{{ $materials->count() }} / 3</h4></div></div></div></div>
            <div class="col-md-4"><div class="card border-0 shadow-sm h-100"><div class="card-body d-flex align-items-center gap-3"><div class="bg-primary-subtle text-primary rounded-3 p-3"><i class="fa-solid fa-building fa-xl"></i></div><div><p class="text-muted mb-1">Suppliers</p><h4 class="fw-bold mb-0">{{ $supplierCount }}</h4></div></div></div></div>
            <div class="col-md-4"><div class="card border-0 shadow-sm h-100"><div class="card-body d-flex align-items-center gap-3"><div class="bg-warning-subtle text-warning rounded-3 p-3"><i class="fa-solid fa-tags fa-xl"></i></div><div><p class="text-muted mb-1">Lowest Listed Price</p><h4 class="fw-bold mb-0">{{ $lowest ? '$'.number_format((float)$lowest->price, 2).' / '.($lowest->unit ?: 'unit') : '—' }}</h4></div></div></div></div>
        </div>

        @if($materials->isEmpty())
            <div class="card border-0 shadow-sm text-center py-5"><div class="card-body"><i class="fa-solid fa-scale-balanced fa-3x text-muted mb-3"></i><h5 class="fw-bold">No materials selected</h5><p class="text-muted">Choose up to three materials using the compare control while browsing.</p><a href="{{ route('listing') }}" class="btn theme-btn">Browse Materials</a></div></div>
        @else
            <div class="alert alert-success border-0 d-flex align-items-center gap-3 mb-4"><i class="fa-solid fa-circle-info fa-xl"></i><div><strong>Make an informed choice</strong><p class="mb-0">Review material specifications and listed prices side by side.</p></div></div>
            <div class="card border-0 shadow-sm mb-4"><div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center gap-2"><h5 class="fw-bold mb-0 fs-5">Material Comparison</h5><span class="badge bg-success-subtle text-success"><i class="fa-solid fa-check-circle me-1"></i>{{ $materials->count() }} {{ \Illuminate\Support\Str::plural('Material', $materials->count()) }} Selected</span></div>
                <div class="card-body p-0"><div class="table-responsive"><table class="table table-bordered table-compare align-middle text-center mb-0">
                    <thead class="table-light"><tr><th class="text-start p-3" style="min-width:170px">Specifications</th>@foreach($materials as $material)<th class="p-3" style="min-width:230px"><div class="d-flex flex-column align-items-center gap-2"><img src="{{ asset('public/' . $material->image) }}" alt="{{ $material->name }}" class="img-fluid rounded" style="height:120px;width:160px;object-fit:cover">@if($material->is_certified)<div class="certified-badge"><img src="{{ asset('public/assets/images/certified-badge.png') }}" alt="Certified Listing" class="h-100 w-auto"></div>@endif<h6 class="fw-bold mb-0">{{ $material->name }}</h6><a href="{{ route('listing.details', $material->id) }}" class="small text-success">View details</a><form method="POST" action="{{ route('user.collection.toggle', ['collection'=>'compare','material'=>$material->id]) }}">@csrf<button class="btn btn-sm btn-outline-danger" type="submit"><i class="fa-solid fa-xmark me-1"></i>Remove</button></form></div></th>@endforeach</tr></thead>
                    <tbody>
                        @php
                            $rows = [
                                'Price' => fn($m) => '$'.number_format((float)$m->price, 2).' / '.($m->unit ?: '—'),
                                'Supplier' => fn($m) => optional($m->getRelation('supplier'))->company_name ?: (optional($m->getRelation('supplier'))->business_name ?: (optional($m->getRelation('supplier'))->name ?: ($m->supplier ?: (optional($m->getRelation('manufacturer'))->company_name ?: (optional($m->getRelation('manufacturer'))->name ?: '—'))))),
                                'Location' => fn($m) => $m->location ?: '—',
                                'Category' => fn($m) => $m->category ?: '—',
                                'Subcategory' => fn($m) => $m->sub_category ?: '—',
                                'Grade' => fn($m) => $m->grade ?: '—',
                                'Size / Thickness' => fn($m) => $m->size ?: '—',
                                'Weight' => fn($m) => $m->weight ?: '—',
                                'Minimum Order Quantity' => fn($m) => $m->moq ?: '—',
                                'Stock' => fn($m) => $m->stock ?: '—',
                                'Lead Time' => fn($m) => $m->lead_time ?: '—',
                                'Certification' => fn($m) => $m->certification ?: '—',
                            ];
                        @endphp
                        @foreach($rows as $label => $value)<tr><th class="text-start p-3">{{ $label }}</th>@foreach($materials as $material)<td>{{ $value($material) }}</td>@endforeach</tr>@endforeach
                    </tbody>
                </table></div></div>
            </div>
        @endif

        <section class="mt-5">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                <div><h4 class="fw-bold mb-1">More materials to compare</h4><p class="text-muted mb-0">{{ $materials->count() < 3 ? 'Add up to '.(3 - $materials->count()).' more '.\Illuminate\Support\Str::plural('material', 3 - $materials->count()).' to your comparison.' : 'Remove a material from your comparison to add another.' }}</p></div>
                <a href="{{ route('listing') }}" class="btn btn-outline-success">Browse all materials</a>
            </div>
            <div class="row g-3">
                @forelse($suggestedMaterials as $suggestion)
                    @php
                        $suggestionSupplier = $suggestion->getRelation('supplier');
                        $suggestionManufacturer = $suggestion->getRelation('manufacturer');
                        $suggestionOwner = optional($suggestionSupplier)->company_name ?: (optional($suggestionSupplier)->business_name ?: (optional($suggestionSupplier)->name ?: ($suggestion->supplier ?: (optional($suggestionManufacturer)->company_name ?: (optional($suggestionManufacturer)->name ?: 'Supplier')))));
                    @endphp
                    <div class="col-xl-4 col-md-6">
                        <div class="card material-card h-100 border-0 shadow-sm">
                            <a href="{{ route('listing.details', $suggestion->id) }}"><img src="{{ asset('public/' . $suggestion->image) }}" class="card-img-top" alt="{{ $suggestion->name }}" style="height:190px;object-fit:cover" onerror="this.style.display='none'"></a>
                            <div class="card-body p-3 d-flex flex-column">
                                @if($suggestion->is_certified)<div class="certified-badge mb-2"><img src="{{ asset('public/assets/images/certified-badge.png') }}" alt="Certified Listing" class="h-100 w-auto"></div>@endif
                                <h5 class="fw-bold mb-2"><a class="text-dark text-decoration-none" href="{{ route('listing.details', $suggestion->id) }}">{{ $suggestion->name }}</a></h5>
                                <h5 class="text_color_primary fw-bold">${{ number_format((float)$suggestion->price, 2) }} <small class="text-muted fw-normal">/ {{ $suggestion->unit ?: 'unit' }}</small></h5>
                                <p class="text-muted mb-3"><i class="fa-solid fa-building text_color_primary me-2"></i>{{ $suggestionOwner }}</p>
                                <div class="mt-auto">
                                    @if($materials->count() < 3)
                                        <a href="{{ route('compare.add', $suggestion->id) }}" class="btn btn-outline-success w-100"><i class="fa-solid fa-scale-balanced me-1"></i>Add to Compare</a>
                                    @else
                                        <button type="button" class="btn btn-outline-secondary w-100" disabled>Remove an item to add more</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12"><p class="text-muted">There are no other active materials to show right now.</p></div>
                @endforelse
            </div>
        </section>
    </div>
</section>
</main>

@include('Include.footer')
