<!DOCTYPE html>
<html lang="en" class="home_page">
    <head>
        <meta charset="utf-8">
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

         
      <div class="topnav" id="navbar">
         <ul>
                         <li><a href="index.php">Home</a>
             <a href="transportation.php">Transportation Map</a>
            <a href="buses.html">Buses</a>
            <a href="trams.html">Trams</a>
            <a href="trolley_buses.html">Trolley buses</a>

                    </ul>
      </div>
      
         
        </header>



<table id="home-statuses">
                    <tr class="home">
                      <th  colspan="2" rowspan="2" id="map">Map</th>
                      <th  class="home" id="bus">Buses</th>
                      <th  class="home" id="tram">Trams</th>
                    </tr>
                    <tr class="home">
                      <td  class="home" id="pub-transport">All Public Transports</td>
                      <td  class="home" id="trolley-bus">Trolley Buses</td>
                    </tr>
                    
                 </table>

        <script>
            const pubTransport = document.getElementById('pub-transport');
            const bus = document.getElementById('bus');
            const tram = document.getElementById('tram');
            const trolleyBus = document.getElementById('trolley-bus');
            let map;
            let zoomState = 11;

            function initMap() {

                const tallinn = {lat: 59.4370, lng: 24.7536};

                map = new google.maps.Map(document.getElementById("map"), {
                    zoom: zoomState,
                    center: tallinn,
                });
            }

            async function getData (busState, tramState, trolleyBusState) {

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
                    vehicleObject.lineNumber = detail[1];
                    vehicleObject.latitude = Number(detail[2]);
                    vehicleObject.longitude = Number(detail[3]);
                    vehicleObject.speed = Number(detail[4]);
                    vehicleObject.label = Number(detail[5]);
                    vehicleObject.vehicleNumber = Number(detail[6]);
                    //bus: transportType - 2, green
                    if (vehicleObject.transportType === 2) {

                        const image = `./bus/${vehicleObject.lineNumber}.png`;

                        const marker = new google.maps.Marker({
                            position: new google.maps.LatLng(vehicleObject.longitude / 1000000, vehicleObject.latitude / 1000000),
                            map: map,
                            icon: image,
                            opacity: busState,
                        });
                    }

                    if (vehicleObject.transportType === 3) {

                        const image = `./tram/${vehicleObject.lineNumber}.png`;

                        const marker = new google.maps.Marker({
                            position: new google.maps.LatLng(vehicleObject.longitude / 1000000, vehicleObject.latitude / 1000000),
                            map: map,
                            icon: image,
                            opacity: tramState,
                        });
                    }

                    if (vehicleObject.transportType === 1) {

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

            let busInterval;
            let tramInterval;
            let trBusInterval;
            let allInterval;


            bus.addEventListener('click', function() {
                function getMapAndData () {
                    initMap()
                    getData(1, 0, 0);
                }
                getMapAndData();
                busInterval = setInterval(getMapAndData, 10000)
                clearInterval(tramInterval);
                clearInterval(trBusInterval);
                clearInterval(allInterval);
            })
            tram.addEventListener('click', function() {
                function getMapAndData () {
                    initMap()
                    getData(0, 1, 0);
                }
                getMapAndData();
                tramInterval = setInterval(getMapAndData, 10000)
                clearInterval(busInterval);
                clearInterval(trBusInterval);
                clearInterval(allInterval);
            })
            trolleyBus.addEventListener('click', function() {
                function getMapAndData () {
                    initMap()
                    getData(0, 0, 1);
                }
                getMapAndData();
                trBusInterval = setInterval(getMapAndData, 10000)
                clearInterval(tramInterval);
                clearInterval(busInterval);
                clearInterval(allInterval);
            })
            pubTransport.addEventListener('click', function() {
                function getMapAndData () {
                    initMap()
                    getData(1, 1, 1);
                }
                getMapAndData();
                allInterval = setInterval(getMapAndData, 10000)
                clearInterval(tramInterval);
                clearInterval(trBusInterval);
                clearInterval(busInterval);
            })
            // setInterval(initMap, 5000);

            window.initMap = initMap;

        </script>
        <!-- Footer section of the document
        <footer>
            <div class="footer-content">
                <h3>Authors of Website</h3>
                <p>
            Rashad Baghiyev and Farid Azizov</p>
            </div>
        </footer>-->
    </body>
</html>