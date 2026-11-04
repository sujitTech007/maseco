
            <!-- Footer Start -->
            

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

 
  

    <!-- App js -->
      <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/assets/admin/js/app.js') }}"></script>

    <!-- Apex Chart js -->
    <script src="{{ asset('public/assets/admin/js/apexcharts.min.js') }}"></script>

    <!-- Projects Analytics Dashboard App js -->
    <script src="{{ asset('public/assets/admin/js/dashboard.js') }}"></script>
    <script src="{{ asset('public/assets/js/dashboard-auto-filters.js') }}"></script>

    @if (Request::is('admin/profile'))
        <script src="{{ asset('public/assets/admin/js/jquery.min.js') }}"></script>
        <script src="{{ asset('public/assets/admin/js/bootstrap-select.min.js') }}"></script>
        <script>
            jQuery(function ($) {
                $('.selectpicker').each(function () {
                    const selectedCode = $(this).attr('data-selected-country-code');
                    if (selectedCode) $(this).val(selectedCode);
                    $(this).selectpicker();
                });
            });
        </script>
    @endif



<script src="{{ asset('public/assets/js/required-field-validation.js') }}"></script>
</body></html>
