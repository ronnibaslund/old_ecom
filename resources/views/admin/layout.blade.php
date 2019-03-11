<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $page_title or "BabyGoEasy Admin Dashboard" }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset("/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")}} ">

    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/daterangepicker/daterangepicker-bs3.css")}} ">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/iCheck/all.css")}} ">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/colorpicker/bootstrap-colorpicker.min.css")}} ">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css")}} ">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/select2/select2.min.css")}} ">
    <!-- tokenfield -->
    <link rel="stylesheet" href="{{ asset("/assets/libs/tokenfield/css/bootstrap-tokenfield.min.css")}} ">
    <link rel="stylesheet" href="{{ asset("/assets/libs/tokenfield/css/tokenfield-typeahead.min.css")}} ">


    <link rel="stylesheet" href="{{ asset ("/assets/libs/dropzone/dist/dropzone.css") }} ">
    <link rel="stylesheet" href="{{ asset ("/assets/libs/dropzone/dist/basic.css") }} ">

    <!-- Theme style -->
    <link href="{{ asset("/bower_components/AdminLTE/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("/bower_components/AdminLTE/dist/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset ("/assets/css/style.css") }} ">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    @yield('head_scripts')

</head>
<body class="skin-blue">
<div class="wrapper">

    <!-- Header -->
    @include('admin.header')

    <!-- Sidebar -->
    @include('admin.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $page_title or "Page Title" }}
                <small>{{ $page_description or null }}</small>
            </h1>
            <!-- You can dynamically generate breadcrumbs here -->
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            @yield('content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Footer -->
    {{--@include('admin.footer')--}}
    <div class="modal fade" id="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Default Modal</h4>
                </div>
                <div class="modal-body">
                    <p>One fine body…</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</div><!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.3 -->
<script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset ("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset ("/bower_components/AdminLTE/dist/js/app.min.js") }}" type="text/javascript"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience -->

<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset ("/bower_components/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}"></script>

<!-- Select2 -->
<script src="{{ asset ("/bower_components/AdminLTE/plugins/select2/select2.full.min.js") }}"></script>
<!-- InputMask -->
<script src="{{ asset ("/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.js") }}"></script>
<script src="{{ asset ("/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js") }}"></script>
<script src="{{ asset ("/bower_components/AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js") }}"></script>

<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{ asset ("/bower_components/AdminLTE/plugins/daterangepicker/daterangepicker.js") }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset ("/bower_components/AdminLTE/plugins/colorpicker/bootstrap-colorpicker.min.js") }}"></script>
<!-- bootstrap time picker -->
<script src="{{ asset ("/bower_components/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js") }}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{ asset ("/bower_components/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js") }}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{ asset ("/bower_components/AdminLTE/plugins/iCheck/icheck.min.js") }}"></script>
<!-- FastClick -->
<script src="{{ asset ("/bower_components/AdminLTE/plugins/fastclick/fastclick.min.js") }}"></script>
<script src="{{ asset ("/assets/libs/dropzone/dist/dropzone.js") }}"></script>

<script src="{{ asset ("/assets/libs/tokenfield/bootstrap-tokenfield.min.js") }}"></script>

<script src="{{ asset ("/bower_components/numeral/min/numeral.min.js") }}"></script>
<script src="{{ asset ("/bower_components/numeral/min/languages.min.js") }}"></script>

@yield('footer_scripts')


<script>

    function Delete(_self) {
        event.preventDefault();

        var choice = confirm(_self.getAttribute('data-confirm'));

        if (choice) {
            window.location.href = _self.getAttribute('href');
        }
    }

    $(function () {
        // Remove the model content after close
        $('body').on('hidden.bs.modal', '.modal', function () {
            $(this).removeData('bs.modal');
        });
    });

    // Set default language for numeral / currency
    numeral.language('da-dk');
</script>

</body>
</html>