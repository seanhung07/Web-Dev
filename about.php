<div id="mapcontainer">
  <div id="map"></div>
  <div class="info"><strong>Location: </strong>n/a</div>
  <div class="info"><strong>Phone: </strong>0987654321</div>
  <div class="info"><strong>Open: </strong>9:00am</div>
  <div class="info"><strong>Close: </strong>12:00pm</div>

</div>

<script>
  function getLocation() {
      if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(showPosition, showError);
      }
  }
  function showPosition(position) {
    var LatLng = {lat: position.coords.latitude, lng: position.coords.longitude};
    var mapOptions = {
        center: LatLng,
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(document.getElementById("map"), mapOptions);
    var marker = new google.maps.Marker({
      position: LatLng,
      map: map,
      title: 'pizza'
    });
  }
  function showError(){

  }

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAa6Ly7B_jOG4p6r9uK1Aw4je5BWnoqPtY&callback=getLocation"></script>
