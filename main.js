var map = L.map('map').setView([45.89860986946062, 6.12917203841142], 13);

var CartoDB_VoyagerLabelsUnder = L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager_labels_under/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
    subdomains: 'abcd',
    maxZoom: 20
}).addTo(map);

coords = [[45.89856023085219, 6.117736246509577], [45.90706560732963, 6.113352659053238] , [45.91763558459165, 6.128630520636682]];
rent = ['Station', 'Station' , 'Station'];
//areas
noms = ["Prix carburant" , "Prix carburant", "Prix carburant" ]
// rooms
prix = ["1.25" , "2.89" , "5"]
//outside


let l = coords.length;

for (let i = 0; i < l; i++){
    //popus
    var pop = L.popup({
        closeOnClick: true
    }).setContent /* affiche ce mot ('Station essence');*/('<h2>nom : ' + noms[i] + ' prix: ' + prix[i]);
    //marqueur

    var marker = L.marker(coords[i]).addTo(map).bindPopup(pop);

    //labels
    var toollip = L.tooltip({
        permanent: true
    }).setContent(rent[i]);

    marker.bindTooltip(toollip);
}



/* MODE DARK
var Stadia_AlidadeSmoothDark = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png', {
    maxZoom: 20,
    attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
});
Stadia_AlidadeSmoothDark.addTo(map)*/

/* ping
var marker = L.marker([45.89856023085219, 6.117736246509577]).addTo(map);

var popup = L.popup();
*/

/* Message a afficher
function onMapClick(e) {
    popup
        .setLatLng(e.latlng)
        .setContent("Station Total Ouvert 24/24 ")
        .openOn(map);
}

map.on('click', onMapClick);
*/
