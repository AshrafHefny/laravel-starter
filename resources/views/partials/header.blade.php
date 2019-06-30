<div class="slim-header">
    <div class="container">
        <div class="slim-header-left">
            @include('partials.logo')
            {!! Form::open(['url'=>'search','method' => 'get','name'=>'search'] ) !!}
            <!-- <div class="search-box">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('app.Search') }}" value="{{request('q')}}">
                <button class="btn btn-primary"><i class="fa fa-search"></i></button>
            </div> -->
            {!! Form::close() !!}
            <!-- search-box -->
        </div>
        <!-- slim-header-left -->
        <div class="slim-header-right">
            @include('partials.right_header')
        </div>
        <!-- header-right -->
    </div>
    <!-- container -->
</div>