@include('admin.Include.header')

 <div class="page-content">

<div class="container mt-4">

    <h2>Newsletter List</h2>

    @if(session('success'))

        <div class="alert alert-success">{{ session('success') }}</div>

    @endif

    <table class="table table-bordered">

        <thead>

            <tr>

                <th>ID</th>

                <th>Email</th>

            </tr>

        </thead>

        <tbody>

            @foreach($newsletters as $newsletter)

            <tr>

                <td>{{ $newsletter->id }}</td>

                <td>{{ $newsletter->email }}</td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

</div>

@include('admin.Include.footer')

