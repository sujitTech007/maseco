@include('admin.Include.header')

<div class="page-content">



    <div class="container mt-0">

        <div class="breadcrumb-wrapper mb-3" style="font-size: 15px; font-weight: 500;">
            <h3 class="mb-1">Add Subscription Plans</h3>

            <a href="https://maseco.ca/UAT/admin/dashboard" style="color:#555; text-decoration:none;">
                Dashboard
            </a>

            <span style="padding:0 6px; color:#999; font-size:14px;">
                ▶
            </span>

            <span style="color:#2DAC92;">
                Add Subscripton Plans
            </span>

        </div>
        <form action="{{ route('admin.subscription.store') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label for="name" class="form-label">Name</label>

                <input type="text" name="name" class="form-control" required>

            </div>

            <div class="mb-3">

                <label for="price" class="form-label">Price</label>

                <input type="number" name="price" class="form-control" step="0.01" required>

            </div>

            <div class="mb-3">

                <label for="duration" class="form-label">Duration</label>

                <select name="duration" class="form-control">

                    <option value="monthly">Monthly</option>

                    <option value="yearly">Yearly</option>

                </select>

            </div>

            <div class="mb-3">

                <label for="features" class="form-label">Features (one per line)</label>

                <textarea name="features[]" class="form-control" rows="4" required></textarea>

            </div>

            <div class="mb-3">

                <label for="commission" class="form-label">Commission</label>

                <input type="text" name="commission" class="form-control">

            </div>

            <div class="mb-3">

                <label for="status" class="form-label">Status</label>

                <select name="status" class="form-control">

                    <option value="active">Active</option>

                    <option value="inactive">Inactive</option>

                </select>

            </div>

            <button type="submit" class="btn btn-primary addpln">Add</button>

        </form>

    </div>

</div>

@include('admin.Include.footer')