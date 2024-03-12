<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}" dir="{{ backpack_theme_config('html_direction') }}">

<head>
    @include(backpack_view('inc.head'))

</head>

<body class="{{ backpack_theme_config('classes.body') }}">

@include(backpack_view('inc.sidebar'))

<div class="wrapper d-flex flex-column min-vh-100 bg-light">

    @include(backpack_view('inc.main_header'))

    @if (\Illuminate\Support\Facades\Route::is('backpack.dashboard'))
        <style>
            .test {
                background-image: url('https://s3-ap-southeast-1.amazonaws.com/blog-edukasyon/wp-content/uploads/2019/04/25140359/PSU-1024x684.jpg');
                opacity: 0.8;
                background-size: cover;
            }
        </style>
        <div class="app-body test flex-grow-1 px-2">
    @else
        <div class="app-body flex-grow-1 px-2">
    @endif

        <main class="main">

            @yield('before_breadcrumbs_widgets')

            @includeWhen(isset($breadcrumbs), backpack_view('inc.breadcrumbs'))

            @yield('after_breadcrumbs_widgets')

            @yield('header')

            <div class="container-fluid animated fadeIn">

                @yield('before_content_widgets')

                @yield('content')

                @yield('after_content_widgets')

            </div>

        </main>

    </div>{{-- ./app-body --}}

    <footer class="{{ backpack_theme_config('classes.footer') }}">
        @include(backpack_view('inc.footer'))
    </footer>
</div>

@yield('before_scripts')
@stack('before_scripts')

@include(backpack_view('inc.scripts'))
@include(backpack_view('inc.theme_scripts'))

@yield('after_scripts')
@stack('after_scripts')
</body>
</html>
