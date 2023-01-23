<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!-- End Required meta tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Begin SEO tag -->
    <title>{{ $title . ' - ' . config('app.name', 'Sistem Marketing Audit') }}</title>
    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="144x144" href="{{ asset('admin/smarkicon.png') }}">
    <link rel="icon" href="{{ asset('admin/favicon.ico') }}">
    <meta name="theme-color" content="#35817F">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet"><!-- End Google font -->
    <!-- BEGIN PLUGINS STYLES -->
    <link rel="stylesheet" href="{{ asset('admin/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <!-- END PLUGINS STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" href="{{ asset('admin/stylesheets/theme.min.css') }}" data-skin="default">
    <link rel="stylesheet" href="{{ asset('admin/stylesheets/theme-dark.min.css') }}" data-skin="dark">
    <link rel="stylesheet" href="{{ asset('admin/stylesheets/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendor/loader/waitMe.css') }}">
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootprompt/bootprompt.min.js') }}"></script>
    <script>
        var skin = localStorage.getItem('skin') || 'default';
        var disabledSkinStylesheet = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');
        // Disable unused skin immediately
        disabledSkinStylesheet.setAttribute('rel', '');
        disabledSkinStylesheet.setAttribute('disabled', true);
        // add loading class to html immediately
    </script><!-- END THEME STYLES -->
</head>
