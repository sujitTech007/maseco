@include('admin.Include.header')



<div class="page-content p-4 maseco-material-view">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h3 class="material-page-title mb-2">Material Details</h3>

            <div class="material-breadcrumb">
                <a href="https://maseco.ca/UAT/admin/dashboard">Dashboard</a>
                <i class="ri-arrow-right-s-line"></i>
                <a href="raw-material-listing.php">Materials</a>
                <i class="ri-arrow-right-s-line"></i>
                <span>Material Details</span>
            </div>
        </div>

        <a href="raw-material-listing.php" class="material-back-btn">
            <i class="ri-arrow-left-line"></i>
            Back to Materials
        </a>
    </div>

    <!-- Material Overview -->
    <div class="material-overview card mb-4">
        <div class="card-body">
            <div class="row g-4 align-items-center">

                <!-- Material Image -->
                <div class="col-lg-4 col-md-5">
                    <div class="material-image-wrap">
                        <img
                            src="assets/images/material1.jpg"
                            alt="Organic Cotton Fabric"
                            class="material-main-image"
                        >
                    </div>
                </div>

                <!-- Material Summary -->
                <div class="col-lg-8 col-md-7">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
                        <span class="material-category-tag">
                            <i class="ri-leaf-line"></i>
                            Fabric / Organic
                        </span>

                        <span class="material-status">
                            <span class="status-dot"></span>
                            Active
                        </span>
                    </div>

                    <h4 class="material-name">Cotton Fabric (Organic)</h4>

                    <p class="material-description">
                        High-quality organic cotton fabric suitable for garments
                        and sustainable textile applications.
                    </p>

                    <div class="material-price-block mb-3">
                        <span class="material-price">$50</span>
                        <span class="material-price-unit">/ Meter</span>
                    </div>

                    <div class="material-summary-grid">
                        <div>
                            <span>Material SKU</span>
                            <strong>COT123</strong>
                        </div>

                        <div>
                            <span>Minimum Order</span>
                            <strong>100 Meter</strong>
                        </div>

                        <div>
                            <span>Available Stock</span>
                            <strong>1,000 Meter</strong>
                        </div>

                        <div>
                            <span>Lead Time</span>
                            <strong>7 Days</strong>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <a href="uploads/cotton-fabric-brochure.pdf"
                           target="_blank"
                           rel="noopener"
                           class="material-action-btn material-outline-btn">
                            <i class="ri-file-pdf-line"></i>
                            View Brochure
                        </a>

                        <a href="add-new-material.php?id=COT123"
                           class="material-action-btn material-primary-btn">
                            <i class="ri-edit-line"></i>
                            Edit Material
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Material Specifications -->
    <div class="card material-spec-card">
        <div class="card-body p-4">

            <div class="material-section-heading mb-4">
                <h5>Material Specifications</h5>
                <p>Technical information and sourcing details for this material.</p>
            </div>

            <div class="material-spec-grid">

                <div class="material-spec-item">
                    <span>Category</span>
                    <strong>Fabric</strong>
                </div>

                <div class="material-spec-item">
                    <span>Sub-Category</span>
                    <strong>Organic</strong>
                </div>

                <div class="material-spec-item">
                    <span>Grade / Quality</span>
                    <strong>High</strong>
                </div>

                <div class="material-spec-item">
                    <span>Strength / Durability</span>
                    <strong>120 GSM</strong>
                </div>

                <div class="material-spec-item">
                    <span>Size / Dimensions</span>
                    <strong>100m × 1.5m</strong>
                </div>

                <div class="material-spec-item">
                    <span>Weight / Unit</span>
                    <strong>Meter</strong>
                </div>

                <div class="material-spec-item">
                    <span>Supplier</span>
                    <strong>ABC Suppliers</strong>
                </div>

                <div class="material-spec-item">
                    <span>Location</span>
                    <strong>Delhi, India</strong>
                </div>

                <div class="material-spec-item">
                    <span>Certification</span>
                    <strong>ISO 9001</strong>
                </div>

                <div class="material-spec-item">
                    <span>Last Updated</span>
                    <strong>12 Sep 2025</strong>
                </div>

            </div>

            <div class="material-handling mt-4">
                <div class="material-handling-icon">
                    <i class="ri-shield-check-line"></i>
                </div>

                <div>
                    <h6>Safety & Handling Instructions</h6>
                    <p class="mb-0">
                        Keep in a dry place and avoid direct sunlight.
                    </p>
                </div>
            </div>

        </div>
    </div>

</div>



@include('admin.Include.footer')