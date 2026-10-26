@include($type === 'supplier' ? 'seller.Include.header' : 'manufacturer.Include.header')

<style>
  .samples-page {
    max-width: 1450px;
    margin: 0 auto;
    padding: 28px 24px;
    color: #243044;
  }

  .samples-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
    margin-bottom: 24px;
  }

  .samples-heading h3 {
    font-size: 25px;
    font-weight: 700;
    margin-bottom: 5px;
  }

  .samples-heading p {
    color: #788397;
    margin: 0;
    font-size: 14px;
  }

  .samples-panel {
    background: #fff;
    border: 1px solid #e8edf3;
    border-radius: 12px;
    box-shadow: 0 4px 18px rgba(25, 42, 70, .04);
    overflow: hidden;
  }

  .samples-panel-header {
    padding: 18px 22px;
    border-bottom: 1px solid #edf0f5;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
  }

  .samples-panel-header h5 {
    margin: 0;
    font-size: 17px;
    font-weight: 700;
  }

  .samples-count {
    background: #edf8f1;
    color: #198754;
    padding: 5px 11px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
  }

  .samples-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
  }

  .samples-table thead th {
    background: #f8fafc;
    color: #778196;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .45px;
    padding: 15px 18px;
    border-bottom: 1px solid #edf0f5;
    white-space: nowrap;
  }

  .samples-table tbody td {
    padding: 18px;
    border-bottom: 1px solid #edf0f5;
    vertical-align: middle;
    font-size: 13px;
  }

  .samples-table tbody tr:last-child td {
    border-bottom: 0;
  }

  .samples-table tbody tr:hover {
    background: #fbfcfe;
  }

  .sample-product {
    display: flex;
    align-items: center;
    gap: 12px;
    min-width: 230px;
  }

  .sample-image {
    width: 62px;
    height: 62px;
    object-fit: cover;
    border-radius: 9px;
    border: 1px solid #edf0f5;
    flex-shrink: 0;
  }

  .sample-image-placeholder {
    width: 62px;
    height: 62px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    background: #f1f5f9;
    color: #94a3b8;
    flex-shrink: 0;
  }

  .sample-name {
    font-weight: 700;
    color: #243044;
    font-size: 14px;
    margin-bottom: 5px;
    overflow-wrap: anywhere;
  }

  .sample-category {
    color: #8490a2;
    font-size: 12px;
  }

  .sample-price {
    font-weight: 700;
    font-size: 14px;
    color: #243044;
    white-space: nowrap;
  }

  .sample-shipping {
    font-size: 12px;
    color: #8792a4;
    margin-top: 5px;
    white-space: nowrap;
  }

  .sample-status {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
  }

  .sample-status.active {
    background: #e8f7ee;
    color: #198754;
  }

  .sample-status.inactive {
    background: #fff0f0;
    color: #dc3545;
  }

  .sample-stock {
    font-weight: 600;
    white-space: nowrap;
  }

  .sample-actions {
    display: flex;
    justify-content: flex-end;
    gap: 7px;
    flex-wrap: wrap;
    min-width: 125px;
  }

  .sample-actions .btn {
    font-size: 12px;
    font-weight: 600;
    border-radius: 7px;
    padding: 7px 11px;
  }

  .sample-details-row td {
    background: #fbfcfe;
    padding: 22px !important;
  }

  .sample-edit-box {
    border: 1px solid #e8edf3;
    background: #fff;
    border-radius: 10px;
    padding: 20px;
  }

  .sample-edit-box h6 {
    font-weight: 700;
    margin-bottom: 18px;
  }

  .sample-edit-box label {
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 6px;
    color: #566176;
  }

  .sample-edit-box .form-control,
  .sample-edit-box .form-select {
    font-size: 13px;
    border-color: #dfe5ed;
    border-radius: 7px;
    min-height: 40px;
  }

  .sample-edit-box textarea.form-control {
    min-height: 80px;
  }

  .sample-documents {
    border-top: 1px solid #edf0f5;
    margin-top: 20px;
    padding-top: 18px;
  }

  .sample-documents h6 {
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 12px;
  }

  .sample-document-link {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    padding: 9px 0;
    border-bottom: 1px solid #f0f2f6;
    overflow-wrap: anywhere;
  }

  .sample-document-link a {
    text-decoration: none;
    font-size: 12px;
  }

  .sample-upload-form {
    margin-top: 14px;
    padding: 14px;
    border: 1px dashed #d7dee8;
    border-radius: 9px;
    background: #fafbfd;
  }

  .sample-upload-form .form-control {
    font-size: 12px;
  }

  .samples-empty {
    padding: 55px 20px;
    text-align: center;
  }

  .samples-empty h5 {
    font-size: 17px;
    font-weight: 700;
    margin: 12px 0 6px;
  }

  .samples-empty p {
    color: #8490a2;
    font-size: 13px;
    margin: 0;
  }

  .samples-pagination {
    padding: 18px 22px;
    border-top: 1px solid #edf0f5;
  }

  .samples-pagination nav {
    display: flex;
    justify-content: flex-end;
  }

  .samples-pagination p {
    margin-bottom: 8px;
    font-size: 12px;
    color: #8490a2;
  }

  @media (max-width: 767px) {
    .samples-page {
      padding: 20px 12px;
    }

    .samples-heading h3 {
      font-size: 21px;
    }

    .samples-panel-header {
      padding: 15px;
    }

    .samples-table thead th,
    .samples-table tbody td {
      padding: 13px;
    }

    .sample-details-row td {
      padding: 12px !important;
    }

    .sample-edit-box {
      padding: 14px;
    }

    .samples-pagination {
      padding: 15px;
      overflow-x: auto;
    }
  }
</style>

<div class="page-content p-4">

  <div class="samples-heading">
    <div>
      <h3>Manage Samples</h3>
      <p>Manage your sample listings, pricing, stock and supporting documents.</p>
    </div>
    <div class="d-flex align-items-center gap-2">
      <span class="samples-count">
        {{ $samples->total() }} Total Samples
      </span>
    </div>
  </div>

  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  @if($errors->any())
  <div class="alert alert-danger">
    <strong>Please correct the following:</strong>
    <ul class="mb-0 mt-2">
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <div class="samples-panel">

    <div class="samples-panel-header">
      <h5>Sample Listings</h5>
      <span class="text-muted small">
        Showing {{ $samples->count() }} of {{ $samples->total() }} listings
      </span>
    </div>

    @if($samples->count())

    <div class="table-responsive">
      <table class="samples-table">
        <thead>
          <tr>
            <th>Sample / Product</th>
            <th>Price &amp; Shipping</th>
            <th>Stock</th>
            <th>Status</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>

        <tbody>
          @foreach($samples as $sample)

          <tr>
            <td>
              <div class="sample-product">
                @if($sample->image_path)
                <img
                  src="{{ asset('storage/'.$sample->image_path) }}"
                  alt="{{ $sample->name }}"
                  class="sample-image">
                @else
                <div class="sample-image-placeholder">
                  <span>No image</span>
                </div>
                @endif

                <div>
                  <div class="sample-name">
                    {{ $sample->name }}
                  </div>
                  <div class="sample-category">
                    {{ $sample->material->name ?? 'Product' }}
                  </div>
                  <div class="sample-category mt-1">
                    Sample #{{ $sample->id }}
                  </div>
                </div>
              </div>
            </td>

            <td>
              <div class="sample-price">
                {{ number_format((float) $sample->price, 2) }}
              </div>
              <div class="sample-shipping">
                + {{ number_format((float) $sample->shipping_fee, 2) }} shipping
              </div>
            </td>

            <td>
              <span class="sample-stock">
                {{ $sample->stock_quantity }}
              </span>
              <div class="sample-category">Available units</div>
            </td>

            <td>
              <span class="sample-status {{ $sample->status === 'active' ? 'active' : 'inactive' }}">
                {{ ucfirst($sample->status ?? 'inactive') }}
              </span>
            </td>

            <td>
              <div class="sample-actions">
                <button
                  type="button"
                  class="btn btn-outline-success"
                  data-bs-toggle="collapse"
                  data-bs-target="#sampleDetails{{ $sample->id }}"
                  aria-expanded="false"
                  aria-controls="sampleDetails{{ $sample->id }}">
                  <i class="fas fa-edit me-1"></i> Manage
                </button>
              </div>
            </td>
          </tr>

          <tr class="sample-details-row">
            <td colspan="5" class="p-0 border-0">
              <div class="collapse" id="sampleDetails{{ $sample->id }}">
                <div class="sample-edit-box">

                  <h6>Edit Sample Listing</h6>

                  <form
                    method="POST"
                    action="{{ route($type.'.samples.update', $sample) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input
                      type="hidden"
                      name="material_id"
                      value="{{ $sample->material_id }}">

                    <div class="row g-3">

                      <div class="col-12">
                        <label>Sample Name</label>
                        <input
                          class="form-control"
                          name="name"
                          value="{{ $sample->name }}"
                          required
                          maxlength="255">
                      </div>

                      <div class="col-12 col-md-6">
                        <label>Price</label>
                        <input
                          class="form-control"
                          type="number"
                          name="price"
                          step="0.01"
                          min="0"
                          value="{{ $sample->price }}"
                          required>
                      </div>

                      <div class="col-12 col-md-6">
                        <label>Shipping Fee</label>
                        <input
                          class="form-control"
                          type="number"
                          name="shipping_fee"
                          step="0.01"
                          min="0"
                          value="{{ $sample->shipping_fee }}"
                          required>
                      </div>

                      <div class="col-12 col-md-4">
                        <label>Stock Quantity</label>
                        <input
                          class="form-control"
                          type="number"
                          name="stock_quantity"
                          min="0"
                          value="{{ $sample->stock_quantity }}"
                          required>
                      </div>

                      <div class="col-12 col-md-4">
                        <label>Processing Days</label>
                        <input
                          class="form-control"
                          type="number"
                          name="processing_days"
                          min="0"
                          value="{{ $sample->processing_days }}"
                          required>
                      </div>

                      <div class="col-12 col-md-4">
                        <label>Availability</label>
                        <select name="status" class="form-select" required>
                          <option value="active" @selected($sample->status === 'active')>
                            Active
                          </option>
                          <option value="inactive" @selected($sample->status === 'inactive')>
                            Inactive
                          </option>
                        </select>
                      </div>

                      <div class="col-12">
                        <label>Description</label>
                        <textarea
                          class="form-control"
                          name="description"
                          rows="3">{{ $sample->description }}</textarea>
                      </div>

                      <div class="col-12">
                        <label>Specifications</label>
                        <textarea
                          class="form-control"
                          name="specifications"
                          rows="3">{{ $sample->specifications }}</textarea>
                      </div>

                      <div class="col-12">
                        <label>Replace Sample Image (Optional)</label>
                        <input
                          class="form-control"
                          type="file"
                          name="image"
                          accept=".jpg,.jpeg,.png,.webp">
                        <small class="text-muted">
                          Leave empty to keep the current image.
                        </small>
                      </div>

                      <div class="col-12 d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-success">
                          <i class="fas fa-save me-1"></i> Save Changes
                        </button>

                        <button
                          type="button"
                          class="btn btn-light border"
                          data-bs-toggle="collapse"
                          data-bs-target="#sampleDetails{{ $sample->id }}">
                          Cancel
                        </button>
                      </div>

                    </div>
                  </form>

                  <div class="sample-documents">

                    <h6>Private Supporting Documents</h6>

                    @forelse($sample->files as $doc)
                    <div class="sample-document-link">
                      <div>
                        <i class="far fa-file-alt text-muted me-2"></i>
                        <a href="{{ route('sharing.files.download', $doc) }}">
                          {{ $doc->title }}
                        </a>
                        <div class="sample-category ms-4">
                          {{ $doc->original_filename }}
                        </div>
                      </div>
                    </div>
                    @empty
                    <p class="text-muted small">
                      No supporting documents uploaded.
                    </p>
                    @endforelse

                    <form
                      method="POST"
                      action="{{ route($type.'.samples.documents.store', $sample) }}"
                      enctype="multipart/form-data"
                      class="sample-upload-form">
                      @csrf

                      <div class="row g-2 align-items-end">
                        <div class="col-12 col-md-4">
                          <label>Document Title</label>
                          <input
                            class="form-control"
                            name="title"
                            placeholder="Enter document title"
                            required
                            maxlength="255">
                        </div>

                        <div class="col-12 col-md-5">
                          <label>Select Document</label>
                          <input
                            class="form-control"
                            type="file"
                            name="file"
                            accept=".pdf,.png,.jpg,.jpeg,.webp,.doc,.docx,.xls,.xlsx,.csv,.txt"
                            required>
                        </div>

                        <div class="col-12 col-md-3">
                          <button
                            type="submit"
                            class="btn btn-outline-primary w-100">
                            <i class="fas fa-upload me-1"></i>
                            Upload Document
                          </button>
                        </div>
                      </div>
                    </form>

                  </div>

                </div>
              </div>
            </td>
          </tr>

          @endforeach
        </tbody>
      </table>
    </div>

    <div class="samples-pagination">
      {{ $samples->links() }}
    </div>

    @else

    <div class="samples-empty">
      <div class="text-muted">
        <i class="fas fa-box-open fa-2x"></i>
      </div>
      <h5>No Sample Listings Yet</h5>
      <p>Your sample listings will appear here once you create them.</p>
    </div>

    @endif

  </div>

</div>

@include($type === 'supplier' ? 'seller.Include.footer' : 'manufacturer.Include.footer')