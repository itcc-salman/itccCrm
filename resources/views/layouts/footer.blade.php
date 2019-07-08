<!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2019 <a href="https://www.itconsultingcompany.com.au" target="_blank">ITCC</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- /.wrapper -->
    <!-- Start Core Plugins
    =====================================================================-->

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jQuery/jquery-1.12.4.min.js') }}" ></script>
    <!-- Bootstrap proper -->
    <script src="{{ asset('assets/bootstrap/js/popper.min.js') }}" ></script>
    <!-- lobicard ui min js -->
    <script src="{{ asset('assets/plugins/lobipanel/js/jquery-ui.min.js') }}" ></script>
    <!-- lobicard ui touch-punch-improved js -->
    <script src="{{ asset('assets/plugins/lobipanel/js/jquery.ui.touch-punch-improved.js') }}"></script>
    <!-- lobicard tether min js -->
    <script src="{{ asset('assets/plugins/lobipanel/js/tether.min.js') }}" ></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}" ></script>
    <!-- lobicard js -->
    <script src="{{ asset('assets/plugins/lobipanel/js/lobicard.js') }}" ></script>
    <!-- lobicard highlight js -->
    <script src="{{ asset('assets/plugins/lobipanel/js/highlight.js') }}" ></script>
    <!-- Pace js -->
    <script src="{{ asset('assets/plugins/pace/pace.min.js') }}" ></script>
    <!-- NIceScroll -->
    <script src="{{ asset('assets/plugins/slimScroll/jquery.nicescroll.min.js') }}" ></script>
    <!-- FastClick -->
    <script src="{{ asset('assets/plugins/fastclick/fastclick.min.js') }}" ></script>
    <!-- CRMadmin frame -->
    <script src="{{ asset('assets/dist/js/custom.js') }}" ></script>
    <!-- End Core Plugins
       =====================================================================-->
    <!-- Start Page Lavel Plugins
       =====================================================================-->
    <!-- ChartJs JavaScript -->
    <script src="{{ asset('assets/plugins/chartJs/Chart.min.js') }}" ></script>
    <!-- Counter js -->
    <script src="{{ asset('assets/plugins/counterup/waypoints.js') }}" ></script>
    <script src="{{ asset('assets/plugins/counterup/jquery.counterup.min.js') }}" ></script>
    <!-- Monthly js -->
    <script src="{{ asset('assets/plugins/monthly/monthly.js') }}" ></script>
    <script src="{{ asset('assets/plugins/toaster/jquery.toast.min.js') }}" ></script>
    <script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}" ></script>
    <!-- End Page Lavel Plugins
       =====================================================================-->
    <!-- Start Theme label Script
       =====================================================================-->
    <!-- Dashboard js -->
    <script src="{{ asset('assets/dist/js/dashboard.js') }}" ></script>
    @yield('scripts')
    <script type="text/javascript">
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31
                && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }

        function isNumberOrSpaceKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 32
                && (charCode < 48 || charCode > 57 ))
                return false;

            return true;
        }

        function notify(msg,type) {
            // _positionClasses : ['bottom-left', 'bottom-right', 'top-right', 'top-left', 'bottom-center', 'top-center', 'mid-center'],
            // _defaultIcons : ['success', 'error', 'info', 'warning'],
            let d = {
                heading: 'Error',
                icon: 'error',
                bgColor: '#E5343D',
            };
            if( type == 1 ) {
                // success
                d.heading = 'Success';
                d.icon = 'success';
                d.bgColor = '#50ab20';
            }
            $.toast({
                heading: d.heading,
                text: msg,
                icon: d.icon,
                hideAfter: 3000,
                stack: 2,
                position: 'top-right',
                loader: true,
                loaderBg: '#ced0d2',
                allowToastClose: true,
                bgColor: d.bgColor,
                textColor: '#fff',
            });
        }
        @if(Session::has('notify-success'))
            notify('{{ Session::get('notify-success') }}', 1);
        @endif
        @if(Session::has('notify-error'))
            notify('{{ Session::get('notify-error') }}', 0);
        @endif
    </script>
   </body>
</html>
