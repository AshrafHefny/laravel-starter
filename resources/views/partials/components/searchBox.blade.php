<div class="card">
  <div class="card-header tx-gray-800" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree" role="tab" id="headingThree">
    <a class="transition collapsed">
      {{ $header }} <i class="fa fa-search"></i>
    </a>
  </div>
  <div id="collapseThree" class="collapse show" role="tabpanel" aria-labelledby="headingThree" style="">
    <div class="card-body tx-gray-800">
      <form action="">
        
        {{ $slot }}

        <div class="mg-t-30">
              
            <button class="btn btn-primary bd-0">{{ trans('app.Filter') }}</button>
            <a class="btn btn-secondary mg-l-30" href="{{ $url }}">{{ trans('app.Reset') }}</a>

        </div>
      </form>
    </div>
  </div><!-- collapse -->
</div>

<br>
