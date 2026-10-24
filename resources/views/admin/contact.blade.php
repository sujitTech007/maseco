@include('admin.Include.header')

<div class="page-content contact-page">

    {{-- Page Header --}}
    <!-- <div class="contact-page-header">
        <div>
            <h3>Contact Us List</h3>
            <div class="contact-breadcrumb">
                <a href="{{ url('/admin/dashboard') }}">Dashboard</a>
                <span>›</span>
                <span class="current">Contact Us List</span>
            </div>
        </div>
    </div> -->

    @if(session('success'))
        <div class="contact-alert">
            <i class="ri-checkbox-circle-line"></i>
            {{ session('success') }}
        </div>
    @endif

    @php
        $contactCollection = collect($contacts ?? []);
    @endphp

    <div class="contact-container">

        {{-- Summary --}}
        <div class="contact-summary">
            <div class="contact-stat bg-danger bg-opacity-10">
                <div class="contact-stat-icon bg-danger bg-opacity-10">
                    <i class="ri-contacts-line text-danger"></i>
                </div>
                <div>
                    <p>Total Contact Requests</p>
                    <h4>{{ $contactCollection->count() }}</h4>
                </div>
            </div>

            <div class="contact-stat bg-warning bg-opacity-10">
                <div class="contact-stat-icon email bg-warning bg-opacity-10">
                    <i class="ri-mail-line text-warning"></i>
                </div>
                <div>
                    <p>Email Contacts</p>
                    <h4>{{ $contactCollection->filter(fn($contact) => !empty($contact->email))->count() }}</h4>
                </div>
            </div>

            <div class="contact-stat bg-success bg-opacity-10">
                <div class="contact-stat-icon phone bg-success bg-opacity-10">
                    <i class="ri-phone-line text-success"></i>
                </div>
                <div>
                    <p>Phone Contacts</p>
                    <h4>{{ $contactCollection->filter(fn($contact) => !empty($contact->phone))->count() }}</h4>
                </div>
            </div>
        </div>
        
            <!-- Contact Submissions Header & Filters -->
<div class="contact-card-header d-flex flex-column flex-xl-row justify-content-between align-items-xl-center gap-3 card">

    <div>
        <h5>Contact Submissions</h5>
        <p>View contact details and how visitors found MASECO.</p>
    </div>

    <div class="d-flex flex-wrap align-items-center gap-2">

        <!-- Visitor Source -->
        <select class="form-select"
                id="contact-source-filter"
                aria-label="Filter by visitor source"
                style="width: 165px;">
            <option value="">All Sources</option>
            <option value="google">Google</option>
            <option value="social_media">Social Media</option>
            <option value="direct">Direct</option>
            <option value="referral">Referral</option>
            <option value="other">Other</option>
        </select>

        <!-- Start Date -->
        <input type="date"
               class="form-control"
               id="contact-start-date"
               aria-label="Start date"
               style="width: 155px;">

        <!-- End Date -->
        <input type="date"
               class="form-control"
               id="contact-end-date"
               aria-label="End date"
               style="width: 155px;">

        <!-- Filter Button -->
        <button type="button"
                class="btn btn-outline-success"
                id="contact-filter-btn">
            <i class="ri-filter-3-line me-1"></i> Filter
        </button>

        <!-- Record Count -->
        <span class="contact-record-count">
            {{ $contactCollection->count() }}
            {{ $contactCollection->count() === 1 ? 'record' : 'records' }}
        </span>

    </div>
</div>

        {{-- Contact Table --}}
        <div class="contact-card">


            {{-- Table Controls --}}
            <div class="contact-controls">

                <div class="contact-page-size">
                    <label for="contact-page-size">Show</label>
                    <select id="contact-page-size" class="contact-control">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="all">All</option>
                    </select>
                    <span>entries</span>
                </div>

                <div class="contact-search">
                    <i class="ri-search-line"></i>
                    <input
                        type="search"
                        id="contact-search-input"
                        class="contact-control"
                        placeholder="Search contacts..."
                        aria-label="Search contacts">
                </div>

            </div>

            <div class="table-responsive">

                <table class="table contact-table align-middle mb-0">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Contact Name</th>
                            <th>Email Address</th>
                            <th>Phone Number</th>
                            <th>Reference</th>
                        </tr>
                    </thead>

                    <tbody id="contact-table-body">

                        @forelse($contactCollection as $contact)
                            <tr class="contact-data-row" data-source="{{ strtolower((string) ($contact->find_us ?? $contact->find_id ?? '')) }}" data-date="{{ $contact->created_at?->format('Y-m-d') }}">

                                <td data-label="ID">
                                    <span class="contact-id">
                                        #{{ $contact->id }}
                                    </span>
                                </td>

                                <td data-label="Contact Name">
                                    <div class="contact-person">
                                        <span class="contact-avatar">
                                            {{ strtoupper(substr(trim($contact->name ?? '?'), 0, 1)) }}
                                        </span>
                                        <span class="contact-person-name">
                                            {{ $contact->name ?? '—' }}
                                        </span>
                                    </div>
                                </td>

                                <td data-label="Email Address">
                                    @if(!empty($contact->email))
                                        <a class="contact-email"
                                           href="mailto:{{ $contact->email }}">
                                            <i class="ri-mail-line"></i>
                                            {{ $contact->email }}
                                        </a>
                                    @else
                                        <span class="contact-muted">Not provided</span>
                                    @endif
                                </td>

                                <td data-label="Phone Number">
                                    @if(!empty($contact->phone))
                                        <a class="contact-phone"
                                           href="tel:{{ $contact->phone }}">
                                            <i class="ri-phone-line"></i>
                                            {{ $contact->phone }}
                                        </a>
                                    @else
                                        <span class="contact-muted">Not provided</span>
                                    @endif
                                </td>

                                <td data-label="Reference">
                                    @if(!empty($contact->find_us))
                                        <span class="contact-reference">
                                            {{ $contact->find_us }}
                                        </span>
                                    @else
                                        <span class="contact-muted">—</span>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="contact-empty">
                                        <i class="ri-contacts-line"></i>
                                        <h5>No contact submissions yet</h5>
                                        <p>Submitted contact forms will appear here.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

                <div class="contact-no-results" id="contact-no-results" hidden>
                    <i class="ri-search-line"></i>
                    <p>No contacts match your search.</p>
                </div>

            </div>

            {{-- Pagination --}}
            <div class="contact-table-footer">
                <span id="contact-table-info">Showing 0 entries</span>
                <div class="contact-pagination" id="contact-pagination"></div>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const page = document.querySelector('.contact-page');
    if (!page) return;

    const tbody = page.querySelector('#contact-table-body');
    const search = page.querySelector('#contact-search-input');
    const sizeSelect = page.querySelector('#contact-page-size');
    const filterControls = page.querySelectorAll('#contact-source-filter, #contact-start-date, #contact-end-date');
    const filterButton = page.querySelector('#contact-filter-btn');
    const info = page.querySelector('#contact-table-info');
    const pagination = page.querySelector('#contact-pagination');
    const noResults = page.querySelector('#contact-no-results');

    if (!tbody || !search || !sizeSelect || !info || !pagination) return;

    const rows = Array.from(tbody.querySelectorAll('.contact-data-row'));
    let currentPage = 1;

    function renderTable() {
        const query = search.value.trim().toLowerCase();

        const filteredRows = window.dashboardFilterRows
            ? window.dashboardFilterRows(page, rows)
            : rows.filter(function (row) { return row.textContent.toLowerCase().includes(query); });

        const pageSize = sizeSelect.value === 'all'
            ? Math.max(filteredRows.length, 1)
            : parseInt(sizeSelect.value, 10);

        const total = filteredRows.length;
        const totalPages = Math.max(1, Math.ceil(total / pageSize));

        currentPage = Math.min(currentPage, totalPages);

        const start = (currentPage - 1) * pageSize;
        const end = Math.min(start + pageSize, total);

        rows.forEach(function (row) {
            row.hidden = true;
        });

        filteredRows.slice(start, end).forEach(function (row) {
            row.hidden = false;
        });

        if (noResults) {
            noResults.hidden = total !== 0 || rows.length === 0;
        }

        info.textContent = total === 0
            ? 'Showing 0 entries'
            : 'Showing ' + (start + 1) + ' to ' + end + ' of ' + total + ' entries';

        pagination.replaceChildren();

        function addButton(label, targetPage, disabled, active) {
            const button = document.createElement('button');
            button.type = 'button';
            button.textContent = label;
            button.disabled = disabled;

            if (active) button.classList.add('active');

            button.addEventListener('click', function () {
                currentPage = targetPage;
                renderTable();
            });

            pagination.appendChild(button);
        }

        addButton('‹', Math.max(1, currentPage - 1), currentPage === 1, false);

        for (let number = 1; number <= totalPages; number++) {
            addButton(
                String(number),
                number,
                false,
                number === currentPage
            );
        }

        addButton(
            '›',
            Math.min(totalPages, currentPage + 1),
            currentPage === totalPages || total === 0,
            false
        );
    }

    search.addEventListener('input', function () {
        currentPage = 1;
        renderTable();
    });

    sizeSelect.addEventListener('change', function () {
        currentPage = 1;
        renderTable();
    });

    filterControls.forEach(function (control) {
        control.addEventListener('change', function () {
            currentPage = 1;
            renderTable();
        });
    });

    if (filterButton) filterButton.addEventListener('click', function () {
        currentPage = 1;
        renderTable();
    });

    renderTable();
});
</script>

@include('admin.Include.footer')
