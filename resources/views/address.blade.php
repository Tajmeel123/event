<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>

</head>

<body>
    <div class="container mt-3">
        <div class="card">
            <div class="card card-body">
                <form id="address-form" method="" action="">
                    @csrf
                    {{-- <input id="autocomplete" class="form-control m-2" placeholder="Enter your address" type="text" /> --}}
                    <input type="text" id="street_address" class="form-control m-2" placeholder="Street Address">
                    <input type="text" id="house_building" class="form-control m-2" placeholder="House or Building">
                    <input type="text" id="apartment_no" class="form-control m-2" placeholder="Apartment No.">
                    <input type="text" id="area_zone" class="form-control m-2" placeholder="Area/Zone">
                    <input type="text" id="state" class="form-control m-2" placeholder="State">
                    <input type="text" id="country" class="form-control m-2" placeholder="Country">
                </form>
            </div>
        </div>
    </div>
    <script>
        function initAutocomplete() {
            // Initialize the autocomplete object on the street_address input field
            var autocomplete = new google.maps.places.Autocomplete(document.getElementById('street_address'), {
                types: ['address'] // You can also use 'geocode' or other types based on your requirements
            });

            // Specify the fields to return when a place is selected
            autocomplete.setFields(['address_component']);

            // When the user selects an address from the dropdown, populate the address fields
            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                var components = {
                    street_number: '',
                    route: '',
                    locality: '',
                    administrative_area_level_1: '',
                    country: '',
                    postal_code: ''
                };

                // Extract the address components
                place.address_components.forEach(function(component) {
                    var addressType = component.types[0];
                    if (components[addressType] !== undefined) {
                        components[addressType] = component.long_name;
                    }
                });

                // Fill the address fields
                document.getElementById('street_address').value = components.street_number + ' ' + components.route;
                document.getElementById('house_building').value = components.street_number;
                document.getElementById('apartment_no').value = ''; // This can be filled manually
                document.getElementById('area_zone').value = components.locality;
                document.getElementById('state').value = components.administrative_area_level_1;
                document.getElementById('country').value = components.country;
            });
        }

        // Initialize the Autocomplete when the window loads
        google.maps.event.addDomListener(window, 'load', initAutocomplete);
    </script>

</body>

</html>
