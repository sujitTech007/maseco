@include('admin.Include.header')

<div class="page-content p-4">

  <div class="breadcrumb-wrapper mb-1" style="font-size: 15px; font-weight: 500;">
    <h3 class="mb-1"> Material Detail</h3>

    <a href="https://maseco.ca/UAT/admin/dashboard" style="color:#555; text-decoration:none;">
      Dashboard
    </a>

    <span style="padding:0 6px; color:#999; font-size:14px;">
      ▶
    </span>

    <span style="color:#2DAC92;">
      Material Detail
    </span>

  </div>
  <div class="card mt-3">

    <div class="card-body">

      <dl class="row">

        <dt class="col-sm-3">Name</dt>

        <dd class="col-sm-9">{{ $material->name }}</dd>
        <dt class="col-sm-3">Certified Listing</dt>
        <dd class="col-sm-9">
            @if($material->is_certified)
                <img src="{{ asset('public/assets/images/certified-badge.png') }}" alt="Certified Listing" style="height:25px;width:auto;max-width:100%;">
            @else
                Not Certified
            @endif
        </dd>

        <dt class="col-sm-3">Description</dt>

        <dd class="col-sm-9">{{ $material->description }}</dd>

        <dt class="col-sm-3">Unit</dt>

        <dd class="col-sm-9">{{ $material->unit }}</dd>

        <dt class="col-sm-3">Price</dt>

        <dd class="col-sm-9">{{ $material->price }}</dd>

        <dt class="col-sm-3">Status</dt>

        <dd class="col-sm-9">

          <span class="badge {{ $material->status ? 'bg-success' : 'bg-secondary' }}">

            {{ $material->status ? 'Active' : 'Inactive' }}

          </span>

        </dd>

      </dl>

      <a href="{{ route('admin.material.edit', $material->id) }}" class="btn btn-warning mtrlbtn">Edit</a>

      <a href="{{ route('admin.material') }}" class="btn btn-secondary mtrlbtn">Back to List</a>

    </div>

  </div>

</div>

@include('admin.Include.footer')
