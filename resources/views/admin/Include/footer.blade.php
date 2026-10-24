
            <!-- Footer Start -->
            

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

 
  

    <!-- App js -->
    <script src="assets/js/app.js.download"></script>

    <!-- Apex Chart js -->
    <script src="assets/js/apexcharts.min.js.download"></script>

    <!-- Projects Analytics Dashboard App js -->
    <script src="assets/js/dashboard.js.download"></script>
    <script src="{{ asset('public/assets/js/dashboard-auto-filters.js') }}"></script>

    @if (Request::is('admin/profile'))
        <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/bootstrap-select.min.js') }}"></script>
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



</body></html>
