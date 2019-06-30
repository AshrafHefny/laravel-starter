<div class="row mg-t-20">
    <label class="col-sm-4 form-control-label text-wrap ">{{ @$attributes['label'] }} <span class="tx-danger">{{ (@$attributes['required'])?'*':'' }}</span></label>
    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
        <div class="tool">
            <input id="{{$name}}-pac-input" class="controls form-control" style="width: 60%" type="text" placeholder="Search Box">
            <div id="{{$name}}" style="border: 2px solid #3872ac;"></div>
        </div>
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
        #{{ $name }} {
        height: 300px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
      }

      #infowindow-content .title {
        font-weight: bold;
      }

      #infowindow-content {
        display: none;
      }

      #map #infowindow-content {
        display: inline;
      }

      .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      #target {
        width: 345px;
      }

       #{{$name}}-pac-input{
           margin-top: 10px;
       }
    </style>
@endpush

@push('js')
    <script>
    // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById("{{ $name }}"), {
          center: {lat: 30.0444191, lng: 31.2335056},
          zoom: 15,
          mapTypeId: 'roadmap'
        });

        var  marker = new google.maps.Marker({
                map: map
            });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('{{$name}}-pac-input');
        var requestInput = $('#{{ $name }}_info');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);


          // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });

        if (requestInput.val() != ''){
          console.log(requestInput.val());
          var position = requestInput.val().split(" ");
          var positionObject = {lat: parseFloat(position[0]), lng: parseFloat(position[1])};
          console.log(positionObject);
          map.setCenter(positionObject);
          marker.setPosition(positionObject);
        }

        map.addListener( 'click' , function(e) {
                console.log(e.latLng.lat() + " " + e.latLng.lng());
                marker.setPosition({lat: e.latLng.lat() , lng: e.latLng.lng()});
                requestInput.val(e.latLng.lat() + " " + e.latLng.lng());
            });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
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
      }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDu76BJkxp3swOpvw4K6hXkLhK3CennBx4&libraries=places&callback=initAutocomplete"
         async defer></script>
@endpush
