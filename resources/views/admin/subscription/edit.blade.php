@include('admin.Include.header')

<div class="page-content subscription-edit-page">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="subscription-page-header">
            <div>
                <div class="subscription-breadcrumb">
                    <a href="{{ url('/admin/dashboard') }}">Dashboard</a>
                    <i class="ri-arrow-right-s-line"></i>
                    <a href="{{ route('admin.subscription.create') }}">Subscription Plans</a>
                    <i class="ri-arrow-right-s-line"></i>
                    <span>Edit Plan</span>
                </div>

                <h2>Edit Subscription Plan</h2>
                <p>Update pricing, features and availability for this plan.</p>
            </div>

            <a href="{{ route('admin.subscription.create') }}"
               class="subscription-back-btn">
                <i class="ri-arrow-left-line"></i>
                Back to Plans
            </a>
        </div>

        <!-- Form Card -->
        <div class="subscription-edit-card">

            <div class="subscription-card-heading">
                <div class="subscription-heading-icon">
                    <i class="ri-price-tag-3-line"></i>
                </div>
                <div>
                    <h4>Plan Information</h4>
                    <p>Manage the details of your subscription plan.</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="subscription-error-alert">
                    <i class="ri-error-warning-line"></i>
                    <div>
                        <strong>Please check the following:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.subscription.update', $plan->id) }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="subscription-form-section">
                    <h5>Basic Details</h5>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="plan_name" class="subscription-label">
                                Plan Name <span>*</span>
                            </label>
                            <input
                                type="text"
                                id="plan_name"
                                name="name"
                                class="form-control subscription-input"
                                value="{{ old('name', $plan->name) }}"
                                placeholder="e.g. Premium Plan"
                                required
                            >
                            @error('name')
                                <small class="subscription-field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="plan_duration" class="subscription-label">
                                Billing Duration <span>*</span>
                            </label>
                            <select
                                id="plan_duration"
                                name="duration"
                                class="form-select subscription-input"
                                required
                            >
                                <option value="monthly"
                                    {{ old('duration', $plan->duration) == 'monthly' ? 'selected' : '' }}>
                                    Monthly
                                </option>
                                <option value="yearly"
                                    {{ old('duration', $plan->duration) == 'yearly' ? 'selected' : '' }}>
                                    Yearly
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="subscription-form-section">
                    <h5>Pricing & Commission</h5>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="plan_price" class="subscription-label">
                                Plan Price <span>*</span>
                            </label>
                            <div class="subscription-input-group">
                                <span><i class="ri-money-dollar-circle-line"></i></span>
                                <input
                                    type="number"
                                    id="plan_price"
                                    name="price"
                                    class="form-control subscription-input"
                                    step="0.01"
                                    min="0"
                                    value="{{ old('price', $plan->price) }}"
                                    placeholder="0.00"
                                    required
                                >
                            </div>
                            @error('price')
                                <small class="subscription-field-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="plan_commission" class="subscription-label">
                                Commission
                            </label>
                            <input
                                type="text"
                                id="plan_commission"
                                name="commission"
                                class="form-control subscription-input"
                                value="{{ old('commission', $plan->commission) }}"
                                placeholder="e.g. 5% or 10"
                            >
                        </div>
                    </div>
                </div>

                <div class="subscription-form-section">
                    <h5>Plan Features</h5>

                    <div class="mb-3">
                        <label for="plan_features" class="subscription-label">
                            Features <span>*</span>
                        </label>
                        <textarea
                            id="plan_features"
                            name="features[]"
                            class="form-control subscription-input subscription-textarea"
                            rows="5"
                            placeholder="Enter one feature per line"
                            required
                        >{{ old('features.0', is_array($plan->features) ? implode("\n", $plan->features) : $plan->features) }}</textarea>

                        <div class="subscription-field-hint">
                            <i class="ri-information-line"></i>
                            Add each feature on a separate line.
                        </div>

                        @error('features')
                            <small class="subscription-field-error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="subscription-form-section subscription-status-section">
                    <div>
                        <h5>Plan Availability</h5>
                        <p>Choose whether this plan is available or inactive.</p>
                    </div>

                    <div class="subscription-status-control">
                        <label for="plan_status" class="subscription-label">
                            Status
                        </label>
                        <select
                            id="plan_status"
                            name="status"
                            class="form-select subscription-input"
                        >
                            <option value="active"
                                {{ old('status', $plan->status) == 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="inactive"
                                {{ old('status', $plan->status) == 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="subscription-form-actions">
                    <a href="{{ route('admin.subscription.create') }}"
                       class="subscription-cancel-btn">
                        Cancel
                    </a>

                    <button type="submit" class="subscription-save-btn">
                        <i class="ri-check-line"></i>
                        Update Plan
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>


@include('admin.Include.footer')