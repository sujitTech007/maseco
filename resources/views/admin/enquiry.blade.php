@include('admin.Include.header')

<!-- Begin page -->



<div class="page-content enquiry-page">

    {{-- Page Heading --}}
    <div class="enquiry-page-header ps-3">
        <h3>Enquiry</h3>

        <div class="enquiry-breadcrumb">
            <a href="{{ url('/admin/dashboard') }}">Dashboard</a>
            <span class="breadcrumb-arrow">▶</span>
            <span class="current">Enquiry</span>
        </div>
    </div>

    <div class="enquiry-container page-container p-3">

        {{-- Enquiry Table Card --}}
        <div class="enquiry-card">

            {{-- Table Controls --}}
            <div class="enquiry-table-controls">

                <div class="enquiry-length">
                    <label for="dt-length-0">Show</label>

                    <select
                        aria-controls="textile-enquiry-table"
                        class="dt-input"
                        id="dt-length-0"
                    >
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>

                    <span>entries</span>
                </div>

                <div class="enquiry-search">
                    <label for="dt-search-0">Search</label>

                    <input
                        type="search"
                        class="dt-input"
                        id="dt-search-0"
                        placeholder="Search enquiries..."
                        aria-controls="textile-enquiry-table"
                    >
                </div>

            </div>

            {{-- Table --}}
            <div class="table-responsive enquiry-table-wrapper">

                <table
                    class="table table-custom table-centered table-hover mb-0 dataTable"
                    id="textile-enquiry-table"
                    style="width: 100%;"
                >

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Material</th>
                            <th>Quantity</th>
                            <th>Expected Price</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach(($enquiries ?? []) as $e)
                        <tr>

                            <td>
                                <span class="enquiry-id">
                                    {{ $e->id }}
                                </span>
                            </td>

                            <td>
                                <span class="enquiry-user">
                                    {{ optional($e->user)->name ?? 'User #'.$e->user_id }}
                                </span>
                            </td>

                            <td>
                                {{ optional(\App\Models\Material::find($e->material_id))->name ?? '-' }}
                            </td>

                            <td>
                                {{ $e->quantity ?? '-' }}
                            </td>

                            <td>
                                <span class="enquiry-price">
                                    ${{ number_format($e->expected_price ?? 0, 2) }}
                                </span>
                            </td>

                            <td>
                                @php
                                    $enquiryStatus = strtolower($e->status ?? 'pending');
                                @endphp

                                <span class="enquiry-status status-{{ $enquiryStatus }}">
                                    {{ ucfirst($enquiryStatus) }}
                                </span>
                            </td>

                            <td>
                                <span class="enquiry-date">
                                    {{ $e->created_at?->format('d M Y') ?? '-' }}
                                </span>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>

                @if(count($enquiries ?? []) === 0)
                    <div class="enquiry-empty">
                        No enquiries found.
                    </div>
                @endif

            </div>

            <!-- {{-- Footer: DataTables can populate its own information and pagination here --}}
            <div class="enquiry-table-footer">
                <div id="complex-header-datatable_info" class="dt-info"></div>
                <div class="dt-paging"></div>
            </div> -->

        </div>

    </div>

</div>

@include('admin.Include.footer')