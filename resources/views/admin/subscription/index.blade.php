@include('admin.Include.header')

<div class="page-content">



    <div class="container mt-0">

        <div class="breadcrumb-wrapper mb-3" style="font-size: 15px; font-weight: 500;">
            <h3 class="mb-1">Subscription Plans</h3>

            <a href="https://maseco.ca/UAT/admin/dashboard" style="color:#555; text-decoration:none;">
                Dashboard
            </a>

            <span style="padding:0 6px; color:#999; font-size:14px;">
                ▶
            </span>

            <span style="color:#2DAC92;">
                Subscripton Plans
            </span>

        </div>
        <a href="{{ route('admin.subscription.create') }}" class="btn btn-primary mb-3 addpln">Add Plan</a>

        @if(session('success'))

        <div class="alert alert-success">{{ session('success') }}</div>

        @endif

        <table class="table table-bordered" style="
    background: white;
    
 box-shadow: 0 0 2px rgba(0, 0, 0, 0.2);">

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Name</th>

                    <th>Price</th>

                    <th>Duration</th>

                    <th>Features</th>

                    <th>Commission</th>

                    <th>Status</th>

                    <th>Actions</th>

                </tr>

            </thead>

            <tbody>

                @foreach($plans as $plan)

                <tr>

                    <td>{{ $plan->id }}</td>

                    <td>{{ $plan->name }}</td>

                    <td>${{ $plan->price }}</td>

                    <td>{{ ucfirst($plan->duration) }}</td>

                    <td>

                        <ul>

                            @foreach($plan->features as $feature)

                            <li>{{ $feature }}</li>

                            @endforeach

                        </ul>

                    </td>

                    <td>{{ $plan->commission }}</td>

                    <td>{{ ucfirst($plan->status) }}</td>

                    <td>
                        <div class="d-flex justify-content-center align-items-center gap-2">

                        <a href="{{ route('admin.subscription.edit', $plan->id) }}" class="btn btn-sm btn-warning"> <i class="fas fa-edit"></i></a>

                        <form action="{{ route('admin.subscription.destroy', $plan->id) }}" method="POST" class="formplan mb-0">

                            @csrf

                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-danger"  onclick="return confirm('Delete this plan?')"  > <i class="fas fa-trash-alt"></i></button>

                        </form>
                        </div>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@include('admin.Include.footer')