<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
        }

        #map {
            height: 500px;
            width: 100%;
        }
    </style>
</head>

<body>

    <div id="map"></div>

    <script>
        function initMap() {
            // Initialize the Geocoder object
            var geocoder = new google.maps.Geocoder();

            // Define the place you want to convert
            var address = "Barangay 4, San Francisco Agusan del Sur";

            // Make the geocoding request
            geocoder.geocode({ address: address }, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    // Get the latitude and longitude
                    var lat = results[0].geometry.location.lat();
                    var lng = results[0].geometry.location.lng();

                    // Use the obtained coordinates for the map
                    var location = {
                        lat: lat,
                        lng: lng
                    };

                    // Create the map
                    var map = new google.maps.Map(document.getElementById("map"), {
                        zoom: 15,
                        center: location
                    });

                    // Place a marker on the map
                    var marker = new google.maps.Marker({
                        position: location,
                        map: map
                    });
                } else {
                    console.error("Geocoding failed:", status);
                }
            });
        }
    </script>

    <!-- Replace 'YOUR_API_KEY' with your actual Google Maps API key -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDa4XcET7iAKYphr-Z6_39eaRBzRg1u7NY&callback=initMap"></script>
</body>

</html>
