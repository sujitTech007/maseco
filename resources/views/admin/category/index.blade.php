@include('admin.Include.header')

<div class="page-content">



    <div class="container mt-0">

        <div class="breadcrumb-wrapper mb-3" style="font-size: 15px; font-weight: 500;">
            <h3 class="mb-1">Category</h3>

            <a href="https://maseco.ca/UAT/admin/dashboard" style="color:#555; text-decoration:none;">
                Dashboard
            </a>

            <span style="padding:0 6px; color:#999; font-size:14px;">
                ▶
            </span>

            <span style="color:#2DAC92;">
                Category
            </span>

        </div>
        <a href="{{ route('admin.category.create') }}" class="btn btn-primary mb-3">Add Category</a>

        @if(session('success'))

        <div class="alert alert-success">{{ session('success') }}</div>

        @endif

        <div class="table-responsive" style="    box-shadow: 0 0 2px rgba(0, 0, 0, 0.2);
    padding: 20px;
    background: white;
    border-radius: 20px;">

            <table class="table table-custom table-centered table-sm table-nowrap table-hover mb-0 dataTable" style="width: 100%;">



                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Name</th>

                        <th>Image</th>

                        <th>Status</th>

                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($categories as $category)

                    <tr>

                        <td>{{ $category->id }}</td>

                        <td>{{ $category->name }}</td>

                        <td>

                            @if($category->image)

                            <img src="{{ asset('public/' . $category->image) }}" style="width: 60px; height: 50px; object-fit: cover;">

                            @endif

                        </td>

                        <td>{{ ucfirst($category->status) }}</td>

                        <td>

                            <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST" style="display:inline-block;">

                                @csrf

                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?')">Delete</button>

                            </form>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@include('admin.Include.footer')