 <style>
    #createSampleModal .modal-content {
    max-height: calc(100vh - 1rem);
}

#createSampleModal .modal-body {
    overflow-y: auto;
}
 </style>  
   
   
   
   <div class="card border-0 shadow-sm rounded-4 mt-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
            <div>
                <h4 class="mb-1">Samples</h4>
                <p class="small text-muted mb-0">Samples linked to your materials.</p>
            </div>
            <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#createSampleModal"><i class="fa-solid fa-plus me-1"></i> Add Sample</button>
        </div>
        @if($errors->any())<div class="alert alert-danger">{{ $errors->first() }}</div>@endif
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Sample</th>
                        <th>Material</th>
                        <th>Price</th>
                        <th>Shipping</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($samples as $sample)
                    <tr>
                        <td class="fw-semibold">{{ $sample->name }}</td>
                        <td>{{ $sample->material->name ?? 'Material #'.$sample->material_id }}</td>
                        <td>{{ number_format($sample->price,2) }}</td>
                        <td>{{ number_format($sample->shipping_fee,2) }}</td>
                        <td>{{ $sample->stock_quantity }}</td>
                        <td><span class="badge {{ $sample->status==='active'?'bg-success-subtle text-success':'bg-secondary-subtle text-secondary' }}">{{ ucfirst($sample->status) }}</span></td>
                        <td class="text-nowrap">
                            <button class="btn btn-sm btn-outline-success" type="button" title="View" data-bs-toggle="modal" data-bs-target="#viewSample{{ $sample->id }}"><i class="fa-solid fa-eye"></i></button>
                            <button class="btn btn-sm btn-outline-warning" type="button" title="Edit" data-bs-toggle="modal" data-bs-target="#editSample{{ $sample->id }}"><i class="fa-solid fa-pen-to-square"></i></button>
                            <form class="d-inline" method="POST" action="{{ route($rolePrefix.'.samples.destroy',$sample) }}" onsubmit="return confirm('Delete this sample? Samples with purchase history cannot be deleted.')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" title="Delete"><i class="fa-solid fa-trash"></i></button></form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">No samples added yet. Use Add Sample to create the first listing.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="createSampleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" action="{{ route($rolePrefix.'.samples.store') }}" enctype="multipart/form-data">@csrf<div class="modal-header">
                    <h5 class="modal-title">Add Sample</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">Material</label><select name="material_id" class="form-select" required>
                                <option value="">Select material</option>@foreach($materials as $material)<option value="{{ $material->id }}">{{ $material->name }}</option>@endforeach
                            </select></div>
                        <div class="col-md-6"><label class="form-label">Sample name</label><input name="name" class="form-control" maxlength="255" required></div>
                        <div class="col-md-6"><label class="form-label">Price</label><input name="price" type="number" min="0.01" step="0.01" class="form-control" required></div>
                        <div class="col-md-6"><label class="form-label">Shipping fee</label><input name="shipping_fee" type="number" min="0" step="0.01" value="0" class="form-control" required></div>
                        <div class="col-md-4"><label class="form-label">Stock</label><input name="stock_quantity" type="number" min="0" value="0" class="form-control" required></div>
                        <div class="col-md-4"><label class="form-label">Processing days</label><input name="processing_days" type="number" min="0" value="0" class="form-control" required></div>
                        <div class="col-md-4"><label class="form-label">Status</label><select name="status" class="form-select">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select></div>
                        <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="2"></textarea></div>
                        <div class="col-12"><label class="form-label">Specifications</label><textarea name="specifications" class="form-control" rows="2"></textarea></div>
                        <div class="col-12"><label class="form-label">Sample image</label><input name="image" type="file" accept="image/*" class="form-control"></div>
                    </div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button><button type="submit" class="btn btn-success">Save Sample</button></div>
            </form>
        </div>
    </div>
</div>

@foreach($samples as $sample)
<div class="modal fade" id="viewSample{{ $sample->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $sample->name }}</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($sample->image_path)<img src="{{ asset('storage/'.$sample->image_path) }}" alt="{{ $sample->name }}" class="img-fluid rounded mb-3" style="max-height:280px">@endif
                <p><strong>Material:</strong> {{ $sample->material->name ?? '—' }}</p>
                <p><strong>Description:</strong> {{ $sample->description ?: '—' }}</p>
                <p><strong>Specifications:</strong> {{ $sample->specifications ?: '—' }}</p>
                <p><strong>Price:</strong> {{ number_format($sample->price,2) }} · <strong>Shipping:</strong> {{ number_format($sample->shipping_fee,2) }}</p>
                <p><strong>Stock:</strong> {{ $sample->stock_quantity }} · <strong>Processing:</strong> {{ $sample->processing_days }} days · <strong>Status:</strong> {{ ucfirst($sample->status) }}</p>
                @foreach($sample->files as $file)<div><a href="{{ route('sharing.files.download',$file) }}">{{ $file->title }} — {{ $file->original_filename }}</a></div>@endforeach
            </div>
            <div class="modal-footer"><button class="btn btn-light" data-bs-dismiss="modal">Close</button></div>
        </div>
    </div>
</div>


<div class="modal fade" id="createSampleModal" tabindex="-1"
     aria-labelledby="createSampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">

            <form method="POST"
                  action="{{ route($rolePrefix.'.samples.store') }}"
                  enctype="multipart/form-data">

                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="createSampleModalLabel">
                        Add New Sample
                    </h5>

                    <button type="button" class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Material</label>
                            <select name="material_id" class="form-select" required>
                                <option value="">Select Material</option>
                                @foreach($materials as $material)
                                    <option value="{{ $material->id }}">
                                        {{ $material->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Sample Name</label>
                            <input type="text" name="name"
                                   class="form-control"
                                   placeholder="Enter sample name"
                                   maxlength="255" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Price</label>
                            <input type="number" name="price"
                                   class="form-control"
                                   placeholder="Enter price"
                                   min="0.01" step="0.01" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Shipping Fee</label>
                            <input type="number" name="shipping_fee"
                                   class="form-control"
                                   placeholder="Enter shipping fee"
                                   min="0" step="0.01" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Stock Quantity</label>
                            <input type="number" name="stock_quantity"
                                   class="form-control"
                                   placeholder="Enter stock"
                                   min="0" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Processing Days</label>
                            <input type="number" name="processing_days"
                                   class="form-control"
                                   placeholder="Days"
                                   min="0" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description"
                                      class="form-control" rows="3"
                                      placeholder="Enter sample description"></textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Specifications</label>
                            <textarea name="specifications"
                                      class="form-control" rows="3"
                                      placeholder="Enter sample specifications"></textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Sample Image</label>
                            <input type="file" name="image"
                                   class="form-control"
                                   accept="image/*">
                            <small class="text-muted">
                                Upload an image for this sample (optional).
                            </small>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-success">
                        Save Sample
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endforeach