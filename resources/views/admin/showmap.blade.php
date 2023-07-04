<style>
    #map {
        height: 250px;
    }
</style>

<div id="map"></div>

<script>
    var tkp = '{{ $hasil->lok_in }}'
    lokasi = tkp.split(',')
    longitude = lokasi[1]
    latitude = lokasi[0]

    // lokasi.value = posisi.coords.latitude + "," + posisi.coords.longitude;
    var map = L.map('map').setView([latitude, longitude], 16);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    var marker = L.marker([latitude, longitude]).addTo(map);
    var circle = L.circle(['-6.807998796939659', '110.84244817055384'], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 75
    }).addTo(map);
</script>
