<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
@if (backpack_theme_config('meta_robots_content'))
    <meta name="robots" content="{{ backpack_theme_config('meta_robots_content', 'noindex, nofollow') }}"> @endif

<meta name="csrf-token" content="{{ csrf_token() }}"/> {{-- Encrypted CSRF token for Laravel, in order for Ajax requests to work --}}
<title>{{ isset($title) ? $title.' :: '.backpack_theme_config('project_name') : backpack_theme_config('project_name') }}</title>

<style>
    .bg-cyan {
        background-color: #003366 !important;
    }

    .bg-darker {
        background-color: #004C99 !important;
    }
</style>

@yield('before_styles')
@stack('before_styles')

@include(backpack_view('inc.theme_styles'))
@include(backpack_view('inc.styles'))

@yield('after_styles')
@stack('after_styles')

{{-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --}}
{{-- WARNING: Respond.js doesn't work if you view the page via file:// --}}
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
