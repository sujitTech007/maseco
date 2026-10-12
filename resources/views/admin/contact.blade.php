@include('admin.Include.header')

<div class="page-content">

    <div class="container mt-0">

        <div class="flex-grow-1">

            <div class="breadcrumb-wrapper mb-3" style="font-size: 15px; font-weight: 500;">
                <h3 class="mb-1">Contact Us List</h3>

                <a href="https://maseco.ca/UAT/admin/dashboard" style="color:#555; text-decoration:none;">
                    Dashboard
                </a>

                <span style="padding:0 6px; color:#999; font-size:14px;">
                    ▶
                </span>

                <span style="color:#2DAC92;">
                    Contact Us List
                </span>

            </div>
            </h4>

        </div>
        @if(session('success'))

        <div class="alert alert-success">{{ session('success') }}</div>

        @endif

        <table class="table table-bordered" style="
    background: white;
    /* border-radius: 20px; */
    box-shadow: 0 0 2px rgba(0, 0, 0, 0.2);
">

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Name</th>

                    <th>Email</th>

                    <th>Phone</th>

                    <th>Refrence</th>

                </tr>

            </thead>

            <tbody>

                @foreach($contacts as $contacts)

                <tr>

                    <td>{{ $contacts->id }}</td>

                    <td>{{ $contacts->name }}</td>

                    <td>{{ $contacts->email }}</td>

                    <td>{{ $contacts->phone }}</td>

                    <td>{{ $contacts->find_us }}</td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@include('admin.Include.footer')