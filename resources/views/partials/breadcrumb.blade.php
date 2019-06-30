<div class="slim-pageheader">
    <ol class="breadcrumb slim-breadcrumb">
        <li class="breadcrumb-item"><a href="{{App::make("url")->to('/')}}">{{ trans('app.Home') }}</a></li>
        @if(@$breadcrumb) 
        @foreach ($breadcrumb as $key=>$value)
        <li class="breadcrumb-item"><a href="{{ $value }}">{{ $key }}</a></li>
        @endforeach 
        @endif
        <li class="breadcrumb-item active" aria-current="page">{{ @$page_title }}</li>
    </ol>
    @yield('title')
</div>