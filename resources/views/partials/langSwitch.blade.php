<div class="dropdown dropdown-c">
    <a href="#" class="logged-user" data-toggle="dropdown">
        <span>{{ucfirst(lang())}}</span>
        <i class="fa fa-angle-down"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
        <nav class="nav">
            @foreach(languages() as $key=>$lang)
            <a href="{{urlLang(url()->full(),lang(),$key)}}" class="nav-link">{{$lang}}</a>
            @endforeach
        </nav>
    </div>
    <!-- dropdown-menu -->
</div>