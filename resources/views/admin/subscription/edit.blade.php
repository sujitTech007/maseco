@include('admin.Include.header')
 <div class="page-content">

<div class="container mt-4">
    <h2>Edit Subscription Plan</h2>
    <form action="{{ route('admin.subscription.update', $plan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $plan->name }}" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" class="form-control" step="0.01" value="{{ $plan->price }}" required>
        </div>
        <div class="mb-3">
            <label for="duration" class="form-label">Duration</label>
            <select name="duration" class="form-control">
                <option value="monthly" @if($plan->duration=='monthly') selected @endif>Monthly</option>
                <option value="yearly" @if($plan->duration=='yearly') selected @endif>Yearly</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="features" class="form-label">Features (one per line)</label>
            <textarea name="features[]" class="form-control" rows="4" required>{{ is_array($plan->features) ? implode("\n", $plan->features) : $plan->features }}</textarea>
        </div>
        <div class="mb-3">
            <label for="commission" class="form-label">Commission</label>
            <input type="text" name="commission" class="form-control" value="{{ $plan->commission }}">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="active" @if($plan->status=='active') selected @endif>Active</option>
                <option value="inactive" @if($plan->status=='inactive') selected @endif>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
</div>

@include('admin.Include.footer')