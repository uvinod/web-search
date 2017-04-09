$(document).ready(function(){

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showLocation);
    } else { 
        //Geolocation is not supported by this browser;
    }
});

function showLocation(position) {

    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;            

    $('#lat').val(latitude);
    $('#long').val(longitude);
}