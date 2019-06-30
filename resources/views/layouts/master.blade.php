<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

    <head>
        @include('partials.meta')
        @include('partials.css') @stack('css')
    </head>

    <body>
        @include('partials.header')
        <!-- slim-header -->
        @include('partials.navigation')
        <!-- slim-navbar -->
        <div class="slim-mainpanel">
            <div class="container">
                @include('partials.breadcrumb')
                @include('partials.flash_messages')
                <!-- section-wrapper -->
                @yield('content')
                <!-- section-wrapper -->
            </div>
            <!-- container -->
        </div>
        <!-- slim-mainpanel -->
        <!-- slim-footer -->
        @include('partials.footer')
        @include('partials.js') @stack('js')
    </body>

</html>
