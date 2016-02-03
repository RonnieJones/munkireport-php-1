
	<h2 data-i18n="client.tab.location"></h2>
	
	<div id="location-msg" data-i18n="listing.loading" class="col-lg-12 text-center"></div>
	
	<div id="location-view" class="row hide">
		<div class="col-md-6">
			<table class="table table-striped">
				<tr>
					<th data-i18n="location.address"></th>
					<td id="location-address"></td>
				</tr>
				<tr>
					<th data-i18n="location.coordinates"></th>
					<td id="location-coordinates"></td>
				</tr>
				<tr>
					<th data-i18n="location.altitude"></th>
					<td id="location-altitude"></td>
				</tr>
				<tr>
					<th data-i18n="location.lastrun"></th>
					<td id="location-lastrun"></td>
				</tr>
				<tr>
					<th data-i18n="location.latitudeaccuracy"></th>
					<td id="location-latitudeaccuracy"></td>
				</tr>
				<tr>
					<th data-i18n="location.longitudeaccuracy"></th>
					<td id="location-longitudeaccuracy"></td>
				</tr>
			</table>
		</div>
		<div class="col-md-6">
			<div style="height: 512px" id="map-canvas"></div>
		</div>
	</div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script>
	
$(document).on('appReady', function(e, lang) {
	
	// Get ARD data
	$.getJSON( appUrl + '/module/location/get_data/' + serialNumber, function( data ) {
		if( ! data.lastrun){
			$('#location-msg').text(i18n.t('no_data'));
		}
		else{
			
			// Hide
			$('#location-msg').text('');
			$('#location-view').removeClass('hide');
			
			// Add strings
			$('#location-address').text(data.address);
			$('#location-coordinates').text(data.latitude + ', ' + data.longitude);
			$('#location-altitude').text(data.altitude + 'm');
			$('#location-latitudeaccuracy').text(data.latitudeaccuracy + 'm');
			$('#location-longitudeaccuracy').text(data.longitudeaccuracy + 'm');
			
			// Format date
			var mydate = moment(data.lastrun, "YYYY-MM-DD HH:mm:ss Z");
			$('#location-lastrun').append('<time title="'+mydate.format('LLLL')+'" >'+mydate.fromNow()+'</time>');
			$('#location-lastrun time').tooltip().css('cursor', 'pointer');
			
			// Create google maps instance
			var myLatlng = new google.maps.LatLng(data.latitude, data.longitude);
			var mapOptions = {
			  zoom: 15,
			  center: myLatlng
			}
			var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

			var marker = new google.maps.Marker({
				position: myLatlng,
				map: map,
				title: ''
			});
			
			var myLocation = new google.maps.Circle({
				center:myLatlng,
				radius:150,
				strokeColor:"#0000FF",
				strokeOpacity:0.2,
				strokeWeight:1,
				fillColor:"#0000FF",
				fillOpacity:0.2
			});

			myLocation.setMap(map);

		}

	});
	
});

</script>