


        </div>





    </div>



    <script src="{{ asset('public/assets/js/vendor.min.js') }}"></script>

    <script src="{{ asset('public/assets/js/app.js') }}"></script>

    <script src="{{ asset('public/assets/js/apexcharts.min.js') }}"></script>

    <script src="{{ asset('public/assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('public/assets/js/dashboard-auto-filters.js') }}"></script>
     <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@25.10.5/build/js/intlTelInput.min.js"></script>

    @if (Request::is('user/profile'))
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
