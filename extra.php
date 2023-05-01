

<!DOCTYPE html>
<html lang="en" class="home_page">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Bus Transportation System for Tallinn">
        <meta name = "author" content = "Farid Azizov and Rashad Baghiyev">
      <meta name="description" content="Bus, Transportation, System, Map">
      <link rel="stylesheet" href="style.css">
    
        <title>Bus Transportation</title>
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <script
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFwlNrF0dd_Z9hjKh33zRcrlE0hjGadvs&callback=initMap&v=weekly"
                defer
        ></script>
    </head>
    <body>

        <header>

         
      <div id="navbar">
         <ul">
             <li><a href="transportation.php">Transportation Map</a></li>
            <li><a href="buses.html">Buses</a></li>
            <li><a href="trams.html">Trams</a></li>
            <li><a href="trolley_buses.html">Trolley buses</a></li>

                    </ul>
      </div>
      
         
        </header>




      <table id="home-statuses">
                    <tr class="home">
                      <th  colspan="2" rowspan="2">
                          <div id="map"></div>
                      </th>
                      <th  class="home" id="bus">Buses</th>
                      <th  class="home" id="tram">Trams</th>
                    </tr>
                    <tr class="home">
                      <td  class="home" id="pub-transport">Public Transports</td>
                      <td  class="home" id="trolley-bus">Trolley Buses</td>
                    </tr>
                    
                 </table>
<!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
        <script>
            const pubTransport = document.getElementById('pub-transport');
            const bus = document.getElementById('bus');
            const tram = document.getElementById('tram');
            const trolleyBus = document.getElementById('trolley-bus');
            let busState = 0;
            let tramState = 0;
            let trolleyBusState = 0;

            function initMap() {
                // The location of Uluru
                const tallinn = { lat: 59.4370, lng: 24.7536 };
                // The map, centered at Uluru
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 11,
                    center: tallinn,
                });
                // The marker, positioned at Uluru


                async function getData () {

                    let allDataArray;
                    const url = 'data.php';
                    await fetch(
                        url, {
                            method: 'GET',
                            mode: 'no-cors',
                        }
                    )
                    .then(
                        function (response) {
                            return (
                                response.text()
                            );
                        }
                    )
                    .then(
                        function (data) {
                            allDataArray = data.split('\n');
                        }
                    )
                    .catch(function (error) {
                        console.error(error)
                    })

                    let vehicleObject = {};
                    allDataArray.map(vehicle => {
                        const detail = vehicle.split(',');

                        vehicleObject.transportType = Number(detail[0]);
                        vehicleObject.lineNumber = Number(detail[1]);
                        vehicleObject.latitude = Number(detail[2]);
                        vehicleObject.longitude = Number(detail[3]);
                        vehicleObject.speed = Number(detail[4]);
                        vehicleObject.label = Number(detail[5]);
                        vehicleObject.vehicleNumber = Number(detail[6]);

                        if (vehicleObject.transportType === 2) {

                            const vehiclePosition = {
                                lat: vehicleObject.latitude / 1000000, lng: vehicleObject.longitude / 1000000
                            };
                            console.log(vehiclePosition)
                            const image = `./bus/${vehicleObject.lineNumber}.png`;

                            const marker = new google.maps.Marker({
                                position: new google.maps.LatLng(vehicleObject.longitude / 1000000, vehicleObject.latitude / 1000000),
                                map: map,
                                icon: image,
                                opacity: busState,
                            });
                        }

                        if (vehicleObject.transportType === 3) {

                            const vehiclePosition = {
                                lat: vehicleObject.latitude / 1000000, lng: vehicleObject.longitude / 1000000
                            };
                            console.log(vehiclePosition)
                            const image = `./tram/${vehicleObject.lineNumber}.png`;

                            const marker = new google.maps.Marker({
                                position: new google.maps.LatLng(vehicleObject.longitude / 1000000, vehicleObject.latitude / 1000000),
                                map: map,
                                icon: image,
                                opacity: tramState,
                            });
                        }

                        if (vehicleObject.transportType === 1) {

                            const vehiclePosition = {
                                lat: vehicleObject.latitude / 1000000, lng: vehicleObject.longitude / 1000000
                            };
                            console.log(vehiclePosition)
                            const image = `./trolley-bus/${vehicleObject.lineNumber}.png`;

                            const marker = new google.maps.Marker({
                                position: new google.maps.LatLng(vehicleObject.longitude / 1000000, vehicleObject.latitude / 1000000),
                                map: map,
                                icon: image,
                                opacity: trolleyBusState,
                            });
                        }
                    })
                }

                pubTransport.addEventListener('click', function() {
                    busState = 1;
                    tramState = 1;
                    trolleyBusState = 1;
                    getData();
                })
                bus.addEventListener('click', function() {
                    busState = 1;
                    tramState = 0;
                    trolleyBusState = 0;
                    getData();
                })
                tram.addEventListener('click', function() {
                    busState = 0;
                    tramState = 1;
                    trolleyBusState = 0;
                    getData();
                })
                trolleyBus.addEventListener('click', function() {
                    busState = 0;
                    tramState = 0;
                    trolleyBusState = 1;
                    getData();
                })
            }

            window.initMap = initMap;

        </script>
     
            <div class="footer-content">
                <h3>Authors of Website</h3>
                <p>
            Rashad Baghiyev and Farid Azizov</p>
            </div>
            
      
    </body>
</html>