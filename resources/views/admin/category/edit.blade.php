@include('admin.Include.header')

 <div class="page-content">
    <div class="breadcrumb-wrapper mb-1" style="font-size: 15px; font-weight: 500;">
        <h3 class="mb-1">Edit Category</h3>

        <a href="https://maseco.ca/UAT/admin/dashboard" style="color:#555; text-decoration:none;">
          Dashboard
        </a>

        <span style="padding:0 6px; color:#999; font-size:14px;">
          ▶
        </span>

        <span style="color:#2DAC92;">
          Edit Category
        </span>

      </div>


<div class="container mt-4">


    <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">

        @csrf

        @method('PUT')

        <div class="mb-3">

            <label for="name" class="form-label">Name</label>

            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>

        </div>

        <div class="mb-3">

            <label for="image" class="form-label">Image</label>

            <input type="file" name="image" class="form-control">

            @if($category->image)

                <img src="{{ asset('public/' . $category->image) }}" class="mt-2" style=" height:50px; width:100px; ">

            @endif

        </div>

        <div class="mb-3">

            <label for="status" class="form-label">Status</label>

            <select name="status" class="form-control">

                <option value="active" @if($category->status=='active') selected @endif>Active</option>

                <option value="inactive" @if($category->status=='inactive') selected @endif>Inactive</option>

            </select>

        </div>

        <button type="submit" class="btn btn-primary update">Update</button>

    </form>

</div>

</div>

@include('admin.Include.footer')