var map = L.map('map').setView([45.89860986946062, 6.12917203841142], 13);

var CartoDB_VoyagerLabelsUnder = L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager_labels_under/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
    subdomains: 'abcd',
    maxZoom: 20
});

CartoDB_VoyagerLabelsUnder.addTo(map)

var marker = L.marker([45.89856023085219, 6.117736246509577]).addTo(map);

var popup = L.popup();

function onMapClick(e) {
    popup
        .setLatLng(e.latlng)
        .setContent("Station Total Ouvert 24/24 ")
        .openOn(map);
}

map.on('click', onMapClick);
