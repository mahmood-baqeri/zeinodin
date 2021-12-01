<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="fontiran.com:license" content="Y68A9">
    <link rel="icon" href="{{url('admin//build/images/favicon.ico')}}" type="image/ico"/>
    <title>بنیاد شیخ زین الدین</title>
    <!-- Bootstrap -->
    <link href="<?=url('/admin/bootstrap/dist/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=url('/admin/bootstrap-rtl/dist/css/bootstrap-rtl.min.css')?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=url('/admin/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?=url('/admin/nprogress/nprogress.css')?>" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?=url('/admin/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')?>" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?=url('/admin/iCheck/skins/flat/green.css')?>" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?=url('/admin/bootstrap-daterangepicker/daterangepicker.css')?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?=url('/admin/build/css/custom.min.css')?>" rel="stylesheet">

    <!-- Datatables -->
    <link href="<?=url('/admin/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=url('/admin/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=url('/admin/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=url('/admin/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')?>" rel="stylesheet">
    <link href="{{ url('admin/myfile.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="<?=url('/date/js-persian-cal.css')?>">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <!-- Custom Theme Style -->
</head>
<!-- /header content -->
<body class="nav-md .">
    <div class="container body">
        <div class="main_container">
            <!-- top navigation -->
            @include('layouts.admin.header')
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                @yield('content_admin')
            </div>
            <!-- /page content -->

            <!-- footer content -->
            @include('layouts.admin.footer')
            <!-- /footer content -->
        </div>
    </div>
    <div id="lock_screen">
        <table>
            <tr>
                <td>
                    <div class="clock"></div>
                    <span class="unlock">
                        <span class="fa-stack fa-5x">
                          <i class="fa fa-square-o fa-stack-2x fa-inverse"></i>
                          <i id="icon_lock" class="fa fa-lock fa-stack-1x fa-inverse"></i>
                        </span>
                    </span>
                </td>
            </tr>
        </table>
    </div>
<!-- jQuery -->
    <script src="<?=url('/js/dropzone.js')?>"></script>
    <!-- jQuery -->
    <script src="<?=url('/admin/jquery/dist/jquery.min.js')?>"></script>
    <!-- Bootstrap -->
    <script src="<?=url('/admin/bootstrap/dist/js/bootstrap.min.js')?>"></script>
    <!-- FastClick -->
    <script src="<?=url('/admin/fastclick/lib/fastclick.js')?>"></script>
    <!-- NProgress -->
    <script src="<?=url('/admin/nprogress/nprogress.js')?>"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?=url('/admin/bootstrap-progressbar/bootstrap-progressbar.min.js')?>"></script>
    <!-- iCheck -->
    <script src="<?=url('/admin/iCheck/icheck.min.js')?>"></script>

    <!-- bootstrap-daterangepicker -->
    <script src="<?=url('/admin/moment/min/moment.min.js')?>"></script>

    <script src="<?=url('/admin/bootstrap-daterangepicker/daterangepicker.js')?>"></script>

    <!-- Chart.js -->
    <script src="<?=url('/admin/Chart.js/dist/Chart.min.js')?>"></script>
    <!-- jQuery Sparklines -->
    <script src="<?=url('/admin/jquery-sparkline/dist/jquery.sparkline.min.js')?>"></script>
    <!-- gauge.js -->
    <script src="<?=url('/admin/gauge.js/dist/gauge.min.js')?>"></script>
    <!-- Skycons -->
    <script src="<?=url('/admin/skycons/skycons.js')?>"></script>
    <!-- Flot -->
    <script src="<?=url('/admin/Flot/jquery.flot.js')?>"></script>
    <script src="<?=url('/admin/Flot/jquery.flot.pie.js')?>"></script>
    <script src="<?=url('/admin/Flot/jquery.flot.time.js')?>"></script>
    <script src="<?=url('/admin/Flot/jquery.flot.stack.js')?>"></script>
    <script src="<?=url('/admin/Flot/jquery.flot.resize.js')?>"></script>
    <!-- Flot plugins -->
    <script src="<?=url('/admin/flot.orderbars/js/jquery.flot.orderBars.js')?>"></script>
    <script src="<?=url('/admin/flot-spline/js/jquery.flot.spline.min.js')?>"></script>
    <script src="<?=url('/admin/flot.curvedlines/curvedLines.js')?>"></script>
    <!-- DateJS -->
    <script src="<?=url('/admin/DateJS/build/production/date.min.js')?>"></script>
    <!-- JQVMap -->
    <script src="<?=url('/admin/jqvmap/dist/jquery.vmap.js')?>"></script>
    <script src="<?=url('/admin/jqvmap/dist/maps/jquery.vmap.world.js')?>"></script>
    <script src="<?=url('/admin/jqvmap/examples/js/jquery.vmap.sampledata.js')?>"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?=url('/admin/build/js/custom.min.js')?>"></script>
    <!-- /bootstrap-daterangepicker -->

    <!-- Datatables -->
    <script src="<?=url('/admin/datatables.net/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?=url('/admin/datatables.net-bs/js/dataTables.bootstrap.min.js')?>"></script>
    <script src="<?=url('/admin/datatables.net-buttons/js/dataTables.buttons.min.js')?>"></script>
    <script src="<?=url('/admin/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')?>"></script>
    <script src="<?=url('/admin/datatables.net-buttons/js/buttons.flash.min.js')?>"></script>
    <script src="<?=url('/admin/datatables.net-buttons/js/buttons.html5.min.js')?>"></script>
    <script src="<?=url('/admin/datatables.net-buttons/js/buttons.print.min.js')?>"></script>
    <script src="<?=url('/admin/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')?>"></script>
    <script src="<?=url('/admin/datatables.net-keytable/js/dataTables.keyTable.min.js')?>"></script>
    <script src="<?=url('/admin/datatables.net-responsive/js/dataTables.responsive.min.js')?>"></script>
    <script src="<?=url('/admin/datatables.net-responsive-bs/js/responsive.bootstrap.js')?>"></script>
    <script src="<?=url('/admin/datatables.net-scroller/js/dataTables.scroller.min.js')?>"></script>
    <script src="<?=url('/admin/jszip/dist/jszip.min.js')?>"></script>
    <script src="<?=url('/admin/pdfmake/build/pdfmake.min.js')?>"></script>
    <script src="<?=url('/admin/pdfmake/build/vfs_fonts.js')?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>

    <script type="text/javascript" src="{{ url('admin/myfile.js') }}"></script>

    <!-- validator -->
    <script type="text/javascript" src="<?=url('/date/js-persian-cal.min.js')?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
{{--    <script type="text/javascript" src="<?=url('ckeditor/ckeditor.js')?>"></script>--}}
    <script>
        var birthday = new AMIB.persianCalendar( 'birthday' );
        // var date_insert = new AMIB.persianCalendar( 'date_insert' );
    </script>

    <script src="{{asset('ckeditor5/ckeditor.js')}}"></script>
    <script>
        $(function () {
            //CKEDITOR.replace("description");
            CKEDITOR.replace(document.querySelector('.ckeditor'));
        });
    </script>


    <script>
    var date_insert = new AMIB.persianCalendar( 'date_insert' ,
        { extraInputID: "date_insert", extraInputFormat: "yyyy/mm/dd" });
</script>
<script>
    // var date= new AMIB.persianCalendar( 'date' ,
    //     { extraInputID: "date", extraInputFormat: "yyyy/mm/dd" });

    var date= new AMIB.persianCalendar( 'start_date' ,
        { extraInputID: "start_date", extraInputFormat: "yyyy/mm/dd" });

    var date= new AMIB.persianCalendar( 'end_date' ,
        { extraInputID: "end_date", extraInputFormat: "yyyy/mm/dd" });



</script>
    @yield('ajax')
</body>
</html>
