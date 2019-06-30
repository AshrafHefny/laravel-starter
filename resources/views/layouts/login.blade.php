<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

    <head>
        @include('partials.meta')
        @include('partials.css')
        @stack('css')
    </head>
    
    <body>
        <div class="d-md-flex flex-row-reverse">
            @include('partials.flash_messages')
            @yield('content')
        </div>
        <!-- d-flex -->
        <!-- signin-wrapper -->
        @include('partials.js') @stack('js')
    </body>

</html>
