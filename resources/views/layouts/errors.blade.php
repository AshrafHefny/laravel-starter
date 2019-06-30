<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

    <head>
        @include('partials.meta')
        @include('partials.css') @stack('css')
    </head>

    <body>
     
    <div class="page-error-wrapper">
      <div>
      
          @yield('content')
        <p class="mg-b-50"><a href="javascript:history.go(-1)" class="btn btn-error">{{ trans('app.Back To Home')}}</a></p>
        <p class="error-footer">
        <p>{{ trans('app.Copyright') }} {{ date('Y') }} &copy; {{ trans('app.All Rights Reserved') }}. {{ env('APP_NAME') }}</p>
        <p>{{ trans('app.Developed by') }}:{{appName()}}</p>
      </div>
    
    </div><!-- page-error-wrapper -->

   

        <!-- slim-footer -->
        @include('partials.js') @stack('js')
    </body>

</html>
