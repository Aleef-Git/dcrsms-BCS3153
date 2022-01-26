<x-app-layout>
    <link href="{{ asset('css/googlemap.css') }}" rel="stylesheet">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pick Up') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-x-auto">
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form action="{{ route('pick_up.store') }}" method="POST">
                            @csrf
                            <input type="text" name="service_request_id" placeholder="Service Request ID" class="input input-bordered" value="{{ $service_request->id }}" hidden>
                            <label class="label" for="device_description">Pick Up Address</label>
                            <textarea class="textarea textarea-bordered min-w-full" name="address" style="min-height:100px" placeholder="Input Address">{{ $service_request->customer->address }}</textarea>
                            <div id="map"></div>
                            <br><input class="btn mt-3" type="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGisoxiNZ91vjXTY8qeT7cpmUt59KgVMY&callback=initMap&v=weekly&channel=2"
      async
    ></script>
    <script>
    function initMap() {
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 8,
    center: { lat: 40.731, lng: -73.997 },
  });
    const marker = new google.maps.Marker({
    position: { lat: 40.731, lng: -73.997 },
    map: map,
    draggable:true,
  });
  const geocoder = new google.maps.Geocoder();
  const infowindow = new google.maps.InfoWindow();

  google.maps.event.addListener(marker, 'dragend', function() {
    geocodePosition(marker.getPosition());
    });
}

function geocodePosition(pos)
{
   geocoder = new google.maps.Geocoder();
   const output = document.getElementById("address");
   geocoder.geocode
    ({
        latLng: pos
    },
        function(results, status)
        {
            if (status == google.maps.GeocoderStatus.OK)
            {
            	//window.alert(results[0].formatted_address);
            	output.value = results[0].formatted_address;
            }
            else
            {
                window.alert("No results found");
            }
        }
    );
}
    </script>
