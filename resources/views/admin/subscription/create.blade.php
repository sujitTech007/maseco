@include('admin.Include.header')


<div class="page-content maseco-subscription-create">
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="subscription-page-header mb-4">
            <div>
                <span class="subscription-eyebrow">PLAN MANAGEMENT</span>
                <h3 class="subscription-page-title">Add Subscription Plan</h3>
                <p class="subscription-page-subtitle">
                    Create a plan and define its pricing, features and availability.
                </p>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="subscription-back-link">
                <i class="ri-arrow-left-line"></i>
                <span>Back to Dashboard</span>
            </a>
        </div>

        <!-- Breadcrumb -->
        <!-- <div class="subscription-breadcrumb mb-4">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <i class="ri-arrow-right-s-line"></i>
            <span>Add Subscription Plan</span>
        </div> -->

        <form action="{{ route('admin.subscription.store') }}" method="POST">
            @csrf

            <div class="row g-4">

                <!-- Main Form -->
                <div class="col-lg-8">
                    <div class="subscription-form-card">

                        <div class="subscription-card-heading">
                            <div class="subscription-heading-icon">
                                <i class="ri-price-tag-3-line"></i>
                            </div>
                            <div>
                                <h5>Plan Information</h5>
                                <p>Enter the basic details of your subscription plan.</p>
                            </div>
                        </div>

                        <div class="subscription-form-body">
                            <div class="mb-4">
                                <label for="name" class="form-label">
                                    Plan Name <span class="required-star">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-control subscription-input"
                                    placeholder="e.g. Premium Plan"
                                    value="{{ old('name') }}"
                                    required
                                >
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="price" class="form-label">
                                        Price <span class="required-star">*</span>
                                    </label>
                                    <div class="subscription-input-group">
                                        <span class="input-prefix">$</span>
                                        <input
                                            type="number"
                                            id="price"
                                            name="price"
                                            class="form-control subscription-input"
                                            placeholder="0.00"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('price') }}"
                                            required
                                        >
                                    </div>
                                    @error('price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="duration" class="form-label">
                                        Billing Duration
                                    </label>
                                    <select
                                        id="duration"
                                        name="duration"
                                        class="form-select subscription-input"
                                    >
                                        <option value="monthly" {{ old('duration', 'monthly') == 'monthly' ? 'selected' : '' }}>
                                            Monthly
                                        </option>
                                        <option value="yearly" {{ old('duration') == 'yearly' ? 'selected' : '' }}>
                                            Yearly
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="subscription-divider"></div>

                            <div class="mb-4">
                                <label for="features" class="form-label">
                                    Plan Features <span class="required-star">*</span>
                                </label>
                                <textarea
                                    id="features"
                                    name="features[]"
                                    class="form-control subscription-input subscription-textarea"
                                    rows="5"
                                    placeholder="Enter one feature per line&#10;Example:&#10;Access to marketplace&#10;Priority support&#10;Supplier comparison"
                                    required
                                >{{ old('features.0') }}</textarea>
                                <div class="field-help">
                                    <i class="ri-information-line"></i>
                                    Enter each feature on a separate line.
                                </div>
                                @error('features')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <label for="commission" class="form-label">
                                    Commission
                                </label>
                                <input
                                    type="text"
                                    id="commission"
                                    name="commission"
                                    class="form-control subscription-input"
                                    placeholder="e.g. 5% or 5"
                                    value="{{ old('commission') }}"
                                >
                                <div class="field-help">
                                    Enter the commission using the format your application expects.
                                </div>
                                @error('commission')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Settings Sidebar -->
                <div class="col-lg-4">
                    <div class="subscription-form-card subscription-settings-card">

                        <div class="subscription-card-heading">
                            <div class="subscription-heading-icon">
                                <i class="ri-settings-3-line"></i>
                            </div>
                            <div>
                                <h5>Plan Settings</h5>
                                <p>Control the plan's availability.</p>
                            </div>
                        </div>

                        <div class="subscription-form-body">
                            <label for="status" class="form-label">Plan Status</label>

                            <select
                                id="status"
                                name="status"
                                class="form-select subscription-input"
                            >
                                <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                                    Active
                                </option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>

                            <div class="subscription-status-note">
                                <i class="ri-checkbox-circle-line"></i>
                                <div>
                                    <strong>Active</strong>
                                    <p>Use the status field to control whether the plan is active in your application.</p>
                                </div>
                            </div>

                            <div class="subscription-preview">
                                <span class="preview-label">PLAN OVERVIEW</span>
                                <h6 id="planPreviewName">Your Plan Name</h6>
                                <div class="preview-price">
                                    <span id="planPreviewPrice">$0.00</span>
                                    <small id="planPreviewDuration">/ month</small>
                                </div>
                                <span class="preview-status" id="planPreviewStatus">
                                    Active
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="subscription-form-actions">
                        <button type="submit" class="btn subscription-submit-btn">
                            <i class="ri-check-line"></i>
                            Create Subscription Plan
                        </button>

                        <a href="{{ url()->previous() }}" class="subscription-cancel-btn">
                            Cancel
                        </a>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const nameInput = document.getElementById('name');
    const priceInput = document.getElementById('price');
    const durationInput = document.getElementById('duration');
    const statusInput = document.getElementById('status');

    const previewName = document.getElementById('planPreviewName');
    const previewPrice = document.getElementById('planPreviewPrice');
    const previewDuration = document.getElementById('planPreviewDuration');
    const previewStatus = document.getElementById('planPreviewStatus');

    function updatePlanPreview() {
        previewName.textContent = nameInput.value.trim() || 'Your Plan Name';

        const price = priceInput.value;
        previewPrice.textContent = price !== '' && Number.isFinite(Number(price))
            ? '$' + Number(price).toFixed(2)
            : '$0.00';

        previewDuration.textContent =
            durationInput.value === 'yearly' ? '/ year' : '/ month';

        previewStatus.textContent =
            statusInput.value === 'active' ? 'Active' : 'Inactive';

        previewStatus.classList.toggle(
            'is-inactive',
            statusInput.value === 'inactive'
        );
    }

    [nameInput, priceInput, durationInput, statusInput].forEach(function (input) {
        input.addEventListener('input', updatePlanPreview);
        input.addEventListener('change', updatePlanPreview);
    });

    updatePlanPreview();
});
</script>


@include('admin.Include.footer')