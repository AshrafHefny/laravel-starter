<div class="row mg-t-20">
    <label class="col-sm-4 form-control-label text-wrap ">{{ @$attributes['label'] }} <span class="tx-danger">{{ (@$attributes['required'])?'*':'' }}</span></label>
    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <div class="tool">
            <input id="{{$name}}-pac-input" class="controls form-control" style="width: 40%" type="text" placeholder="Search Box">
            <div id="{{$name}}" style="border: 2px solid #3872ac;"></div>
        </div>
        @if($editable)
            <span id="resetMap" class="btn btn-primary btn-sm">{{trans('app.reset')}}</span>
        @else
            <span>{{trans("app.polygons with children can not be editable (delete children to edit it)")}}</span>
        @endif
        {!! Form::hidden($name,(@$row->$name)?:(@$value) , ['id' => $name .'_info'])!!}
        @if(@$errors)
            @foreach($errors->get($name) as $message)
                <span class='help-inline text-danger'>{{ $message }}</span>
            @endforeach
        @endif
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
        #{{$name}}-pac-input{
            margin-top: 10px;
            margin-right: 10px;
        }
    </style>
@endpush
@push('js')
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places,geometry,drawing&amp;ext=.js&key=AIzaSyDu76BJkxp3swOpvw4K6hXkLhK3CennBx4"></script>
    <script>
        if(!!navigator.geolocation) {
            // Define the LatLng coordinates for the polygon's path.
            var triangleCoords = {!! json_encode($row->$data_name ?? []) !!};

            var oldTriangle = '{{$value ?? ""}}';

            var triangleCoords2 = [];
            for (i=0; i< triangleCoords.length; i++) {
                var point = triangleCoords[i].split(' ');
                triangleCoords2.push({
                    lat: parseFloat(point[0]),
                    lng: parseFloat(point[1])
                });
            }

            //define parent entity polygon
            var parentCoords = {!! json_encode($parent_boundaries ?? []) !!};

            var map;
            var geocoder;
            var polygonArray =  [];
            var mapOptions = {
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                center: {lat: 30.0444191, lng: 31.2335056}
            };
            map = new google.maps.Map(document.getElementById('{{$name}}'), mapOptions);
            var input = document.getElementById('{{$name}}-pac-input');

            var searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);
            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());
            });


            var markers = [];

            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                markers.forEach(function(marker) {
                    marker.setMap(null);
                });
                markers = [];

                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function(place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    var icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };

                    // Create a marker for each place.
                    markers.push(new google.maps.Marker({
                        map: map,
                        icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    }));

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });


            navigator.geolocation.getCurrentPosition(function(position) {
                if(parentCoords[0]){
                    var centerLatitude = parentCoords[0].lat;
                    var centerLongitude = parentCoords[0].lng;
                }else{
                    var centerLatitude = position.coords.latitude;
                    var centerLongitude = position.coords.longitude;
                }
                var geolocate = new google.maps.LatLng( centerLatitude, centerLongitude);
                map.setCenter(geolocate);
            });
        }
        else{
            document.getElementById('{{$name}}').innerHTML = 'No Geolocation Support.';
        }


        //draw parent entity polygon
        var parentTriangle = new google.maps.Polygon({
            paths: parentCoords,
            strokeColor: '#000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#fffd53',
            fillOpacity: 0.35,
            labelInBackground: true,
            text: 'this is a test title'
        });
        parentTriangle.setMap(map);

        // draw all cities polygons
        var allCitiesCoords = {!! json_encode($all_boundaries ?? []) !!};
        var drawingManager;
        polygons = [];
        allCitiesCoords.forEach(function (item) {
            polygons.push(new google.maps.Polygon({
                paths: item,
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0.5
            }));
            polygons[polygons.length-1].setMap(map);
        });



        // draw current polygon
        console.log('current triangleCoords2 ',triangleCoords2);
        var bermudaTriangle = new google.maps.Polygon({
            paths: triangleCoords2,
            strokeColor: '#83F52C',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#83F52C',
            fillOpacity: 0.5,
            title: 'this is a test title'
        });
        bermudaTriangle.setMap(map);

        @if($editable)
            function initializeDrawer() {
                drawingManager = new google.maps.drawing.DrawingManager({
                    drawingMode: google.maps.drawing.OverlayType.POLYGON,
                    drawingControl: true,
                    drawingControlOptions: {
                        position: google.maps.ControlPosition.TOP_CENTER,
                        drawingModes: [
                            google.maps.drawing.OverlayType.POLYGON
                        ]
                    },
                    markerOptions: {
                        icon: 'images/car-icon.png'
                    },
                    circleOptions: {
                        fillColor: '#ffff00',
                        fillOpacity: 1,
                        strokeWeight: 5,
                        clickable: false,
                        editable: true,
                        zIndex: 1
                    },
                    polygonOptions: {
                        fillColor: '#BCDCF9',
                        fillOpacity: 0.5,
                        strokeWeight: 2,
                        strokeColor: '#57ACF9',
                        clickable: false,
                        editable: false,
                        zIndex: 1
                    }
                });
                console.log('drawingManager', drawingManager);
                if(drawingManager){
                    drawingManager.setMap(map);
                }


                google.maps.event.addListener(drawingManager, 'polygoncomplete', function (polygon) {
                    document.getElementById('{{$name}}_info').value = "(";
                    for (var i = 0; i < polygon.getPath().getLength(); i++) {
                        document.getElementById('{{$name}}_info').value += polygon.getPath().getAt(i).toUrlValue(6).replace(',' , ' ');
                        if(i != (polygon.getPath().getLength() - 1) ){
                            document.getElementById('{{$name}}_info').value += ','
                        }
                    }
                    document.getElementById('{{$name}}_info').value += ")";
                    polygonArray.push(polygon);
                    // console.log(polygonArray.length);
                    drawingManager.setDrawingMode(null);
                    drawingManager.setMap(null);
                });
            }
            // Initialize the drawer tool
            google.maps.event.addDomListener(window, "load", initializeDrawer);


            $("#resetMap").click(reset);
            function reset() {
                if(polygonArray.length > 0 ) {
                    document.getElementById('{{$name}}_info').value = oldTriangle;
                    for (i=0; i< polygonArray.length; i++) {
                        polygonArray[i].setMap(null);
                    }
                    drawingManager.setMap(map);
                }
            }
        @endif
    </script>
@endpush
