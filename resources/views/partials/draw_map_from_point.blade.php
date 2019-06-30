<div class="row mg-t-20">
    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <div class="tool">
            <div id="{{$name}}" style="border: 2px solid #3872ac;"></div>
        </div>
    </div>
</div>

@push('css')
    <style>
        .tool{
            width:100%;
            display:inline-flex;
        }
        #{{$name}} {
            height: 300px;
            width: 100%;
            margin-right: 10px;
            padding: 0px;
        }
    </style>
@endpush
@push('js')
    <script>
        function initMap() {
            var myLatLng = {lat: {{ $lat }}, lng: {{ $lng }}};

            var map = new google.maps.Map(document.getElementById('{{ $name }}'), {
              zoom: 17,
              center: myLatLng
            });

            var marker = new google.maps.Marker({
              position: myLatLng,
              map: map,
            });
          }
    </script>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDu76BJkxp3swOpvw4K6hXkLhK3CennBx4&callback=initMap">
    </script>
@endpush
