<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

    <head>
        @include('partials.meta')
        @include('partials.css') @stack('css')
    </head>

    <body>
        <div class="slim-mainpanel mg-t-40">
            <div class="container">
             
                @yield('content')
                <!-- section-wrapper -->

            </div>
            <!-- container -->
        </div>
        <!-- slim-mainpanel -->


        <!-- slim-footer -->
        @include('partials.js') @stack('js')
    </body>

</html>
