@include('admin.Include.header')
<div class="page-content newsletter-page">
<div class="page-container p-3">
    {{-- Page Header --}}
    <!-- <div class="newsletter-header">
        <div>
            <h3>Newsletter List</h3>

            <div class="newsletter-breadcrumb">
                <a href="{{ url('/admin/dashboard') }}">Dashboard</a>
                <span>›</span>
                <span class="current">Newsletter List</span>
            </div>
        </div>
    </div> -->

    @if(session('success'))
        <div class="newsletter-alert">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    @php
        $newsletterCollection = collect($newsletters ?? []);
    @endphp

    <div class="newsletter-container">

        {{-- Summary --}}
        <div class="newsletter-summary">
            <div class="newsletter-stat bg-danger bg-opacity-10">
                <div class="newsletter-stat-icon bg-danger bg-opacity-10">
                    <i class="fa-solid fa-envelope-open text-danger"></i>
                </div>

                <div>
                    <p>Total Subscribers</p>
                    <h4>{{ $newsletterCollection->count() }}</h4>
                </div>
            </div>

            <div class="newsletter-stat bg-warning bg-opacity-10">
                <div class="newsletter-stat-icon email bg-warning bg-opacity-10">
                    <i class="fa-solid fa-envelope text-warning"></i>
                </div>

                <div>
                    <p>Email Addresses</p>
                    <h4>{{ $newsletterCollection->filter(fn($item) => !empty($item->email))->count() }}</h4>
                </div>
            </div>
        </div>

        {{-- Newsletter Table --}}
        <div class="newsletter-card">

            <div class="newsletter-card-header">
                <div>
                    <h5>Newsletter Subscribers</h5>
                    <p>View and manage your newsletter subscriber list.</p>
                </div>

                <span class="newsletter-count">
                    {{ $newsletterCollection->count() }}
                    {{ $newsletterCollection->count() === 1 ? 'subscriber' : 'subscribers' }}
                </span>
            </div>

            {{-- Search and Page Size --}}
            <div class="newsletter-controls">

                <div class="newsletter-length">
                    <label for="newsletter-page-size">Show</label>

                    <select id="newsletter-page-size"
                            class="newsletter-input">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="all">All</option>
                    </select>

                    <span>entries</span>
                </div>

                <div class="newsletter-search">
                    <i class="fa-solid fa-magnifying-glass"></i>

                    <input type="search"
                           id="newsletter-search-input"
                           class="newsletter-input"
                           placeholder="Search by email or ID..."
                           aria-label="Search newsletter subscribers">
                </div>

            </div>

            {{-- Table --}}
            <div class="table-responsive">

                <table class="table newsletter-table align-middle mb-0">

                    <thead>
                        <tr>
                            <th>Subscriber ID</th>
                            <th>Email Address</th>
                            <th>Subscription</th>
                        </tr>
                    </thead>

                    <tbody id="newsletter-table-body">

                        @forelse($newsletterCollection as $newsletter)

                            <tr class="newsletter-data-row">

                                <td data-label="Subscriber ID">
                                    <span class="newsletter-id">
                                        #{{ $newsletter->id }}
                                    </span>
                                </td>

                                <td data-label="Email Address">
                                    <div class="newsletter-email-cell">
                                        <span class="newsletter-avatar">
                                            <i class="fa-solid fa-envelope"></i>
                                        </span>

                                        <a href="mailto:{{ $newsletter->email }}"
                                           class="newsletter-email">
                                            {{ $newsletter->email }}
                                        </a>
                                    </div>
                                </td>

                                <td data-label="Subscription">
                                    <span class="newsletter-status">
                                        <span class="newsletter-status-dot"></span>
                                        Subscriber
                                    </span>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="3">
                                    <div class="newsletter-empty">
                                        <i class="fa-solid fa-envelope-open"></i>
                                        <h5>No subscribers yet</h5>
                                        <p>New newsletter email addresses will appear here.</p>
                                    </div>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

                <div class="newsletter-no-results"
                     id="newsletter-no-results"
                     hidden>
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <p>No subscribers match your search.</p>
                </div>

            </div>

            {{-- Footer --}}
            <div class="newsletter-footer">
                <span id="newsletter-table-info">Showing 0 entries</span>

                <div class="newsletter-pagination"
                     id="newsletter-pagination"></div>
            </div>

        </div>
    </div>
    </div>
</div>




<script>
document.addEventListener('DOMContentLoaded', function () {
    const page = document.querySelector('.newsletter-page');
    if (!page) return;

    const tbody = page.querySelector('#newsletter-table-body');
    const search = page.querySelector('#newsletter-search-input');
    const sizeSelect = page.querySelector('#newsletter-page-size');
    const info = page.querySelector('#newsletter-table-info');
    const pagination = page.querySelector('#newsletter-pagination');
    const noResults = page.querySelector('#newsletter-no-results');

    if (!tbody || !search || !sizeSelect || !info || !pagination) return;

    const rows = Array.from(tbody.querySelectorAll('.newsletter-data-row'));
    let currentPage = 1;

    function renderTable() {
        const query = search.value.trim().toLowerCase();

        const filteredRows = rows.filter(function (row) {
            return row.textContent.toLowerCase().includes(query);
        });

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
            addButton(String(number), number, false, number === currentPage);
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

    renderTable();
});
</script>
@include('admin.Include.footer')