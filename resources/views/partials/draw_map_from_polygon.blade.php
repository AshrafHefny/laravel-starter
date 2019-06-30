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
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=geometry,drawing&amp;ext=.js&key=AIzaSyDu76BJkxp3swOpvw4K6hXkLhK3CennBx4"></script>
    <script>
            // Define the LatLng coordinates for the polygon's path.
            var triangleCoords =  "{{ $data }}";

            triangleCoords = triangleCoords.trim();
            triangleCoords = triangleCoords.replace("(", "");
            triangleCoords = triangleCoords.replace(")", "");
            triangleCoords = triangleCoords.split(',');
            var triangleCoords2 = [];
            for (i=0; i< triangleCoords.length; i++) {
                var point = triangleCoords[i].split(' ');
                triangleCoords2.push({
                    lat: parseFloat(point[0]),
                    lng: parseFloat(point[1])
                });
            }
            var map;
            var mapOptions = {
                zoom: 14,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                center: {lat: 24.886, lng: -70.268}
            };
            map = new google.maps.Map(document.getElementById('{{$name}}'), mapOptions);
            var bermudaTriangle = new google.maps.Polygon({
                paths: triangleCoords2,
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0.35
            });
            bermudaTriangle.setMap(map);
            var centerLatitude = triangleCoords2[0].lat;
            var centerLongitude = triangleCoords2[0].lng;
            var geolocate = new google.maps.LatLng( centerLatitude, centerLongitude);
            map.setCenter(geolocate);
            
    </script>
@endpush
