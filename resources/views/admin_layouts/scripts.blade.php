{{-- Javascript Libraries --}}
<script src="{{ asset('backend/assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- apps -->
<!-- apps -->
<script src="{{ asset('backend/dist/js/app-style-switcher.js') }}"></script>
<script src="{{ asset('backend/dist/js/feather.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/extra-libs/sparkline/sparkline.js') }}"></script>
<script src="{{ asset('backend/dist/js/sidebarmenu.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('backend/dist/js/custom.min.js') }}"></script>
<!--This page JavaScript -->
<script src="{{ asset('backend/assets/extra-libs/c3/d3.min.js') }}"></script>
<script src="{{ asset('backend/assets/extra-libs/c3/c3.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/chartist/dist/chartist.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
{{-- <script src="{{ asset('backend/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js') }}"></script> --}}
{{-- <script src="{{ asset('backend/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js') }}"></script> --}}
{{-- <script src="{{ asset('backend/dist/js/pages/dashboards/dashboard1.min.js') }}"></script> --}}
<script src="{{ asset('backend/jquery.validate.min.js') }}"></script>   
<script src="{{ asset('backend/sweetalert/sweet-alert.js') }}"></script>
<script src="{{ asset('backend/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('backend/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/responsive.dataTables.min.js') }}"></script>
<script>
    $('body').on('click', '#logout-link', function(){
        $('#logout-form').submit();
    });

    $('.datepicker').datepicker();

    $('#zero_config').DataTable({
        responsive: true,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ]
    });

    window.addEventListener('load', function(){
        let greeting;
        let time =  new Date().getHours();
        
        if(time < 12){
            greeting = 'Good Morning';
        }else if(time < 18){
            greeting = 'Good Afternoon';
        }else{
            greeting = 'Good Evening';
        }

        $('#greeting').html(greeting);
    });
</script>