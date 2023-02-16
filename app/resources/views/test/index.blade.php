<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Maps Test</title>

        <style>
            body, html { margin: 0; padding: 0; }
            #map-div { width: 50vw; height: 50vh; }
        </style>

        <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps.css'>    
    </head>
    <body onload="initGeolocation()">

        <div id="map-div"></div>
        <input id="longitude" type="text" name="long">
        <input id="latitude" type="text" name="lat">
        <input id="address" type="text" name="address">

        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/services/services-web.min.js"></script>
        <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps-web.min.js"></script>
        <script>

        /**
         * TODO - Add ability to add multiple points                        | X
         * TODO - Saved to db after page is done                            | X
         * TODO - after placing a place modal to add name and description   | X
         * TODO - after saving pressing the marker shows popup of details   | 
         * TODO - searchbox                                                 | 
         *
        */
        function initGeolocation()
        {
            if( navigator.geolocation )
            {
            // Call getCurrentPosition with success and failure callbacks
                navigator.geolocation.getCurrentPosition( success, fail );
            }
            else
            {
            alert("Sorry, your browser does not support geolocation services.");
            }
        }

        function success(position)
        {
            const API_KEY = 'I41nd6wTmdLl6RohMqAf7lsesO9W05rE';
            const APPLICATION_NAME = 'My Application';
            const APPLICATION_VERSION = '1.0';
            const CURRENT_LOCATION = {lng: position.coords.longitude, lat: position.coords.latitude}
            var marker;

            tt.setProductInfo(APPLICATION_NAME, APPLICATION_VERSION);

            var map = tt.map({
                key: API_KEY,
                container: 'map-div',
                center: CURRENT_LOCATION,
                zoom: 12,
                language: 'english'
            });

            map.getLanguage();
            map.addControl(new tt.FullscreenControl());
            map.addControl(new tt.NavigationControl());

            function updateLngLat(lnglat) {
                document.getElementById("longitude").value = lnglat.lng;
                document.getElementById("latitude").value = lnglat.lat;

                tt.services.reverseGeocode({
                    key: API_KEY,
                    position: lnglat,
                    language: 'en-US'
                }).then(callbackFn);
            }

            function callbackFn(response)
            {
                document.getElementById("address").value = response.addresses[0].address.freeformAddress;
            }

            function onDragEnd(e) {
                var lnglat = e.target.getLngLat();
                updateLngLat(lnglat)
            }

            function onclick(e) {
                if (true) {
                    marker = new tt.Marker()
                    .setLngLat(e.lngLat)
                    .setDraggable([shouldBeDraggable=true])
                    .addTo(map)
                    .on('dragend', onDragEnd);
                } else {
                    marker.setLngLat(e.lngLat)
                }

                updateLngLat(e.lngLat)
            }
            map.on('click', onclick);
        }

        function fail()
        {
            alert('failed')
        }

        </script>
    </body>
</html>
