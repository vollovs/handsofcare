<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Hands of Care | Physiotherapy</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="css/style.css" type="text/css" />

<script type="text/javascript"
	src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAnbg1JUHpahrGknIdpp3vgH54gKZVl25Q&sensor=false"></script>
	
<script type="text/javascript">
	var infoWindow;
	function initialize() {
		var myOptions = {
			center : new google.maps.LatLng(43.418449,-80.534971),
			zoom : 14,
			mapTypeId : google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map(document.getElementById("map_canvas"),
				myOptions);

		var marker = new google.maps.Marker({
			position : new google.maps.LatLng(43.418449,-80.534971),
			zoom : 14,
			title: 'Hands of Care Physiotherapy',
			map : map
		});
		
		google.maps.event.addListener(marker, 'mouseover', function() {
			infoWindow = new google.maps.InfoWindow({
				//content: '<div class="info-window">'+ 'Hands of Care, Unit 8C, 450 Westheights Dr Kichener ON N2N 1M2 ' + '<a title="Click to view our website" href="#"Our website</a></div>'
			});
			infowindow.open(map, marker);
		});
		
		google.maps.event.addListener(marker, 'mouseout', function() {
			if(typeof infowindow !="undefined")
			  infowindow.close();
		});
	}
</script>
</head>

<?php
if($this->_action=='contact') {
	echo '<body onload="initialize()">';
} else {
	echo '<body>';
}

?>

	<div class="wrapper text-normal">
		<div class="head-wrapper">
			<div class="content-left">
				<img alt="home" src="images/logo.gif" />
			</div>
			<div class="head-right-inner">
					<div class="text-title">Address: Unit 8C, 450 Westheights
						Drive Kichener, Ontario N2N 2B9</div>
					<div id="callus" class="text-title">
						<img class="content-left" alt="call us"
							src="images/callus-18.gif" />
						&nbsp;&nbsp;Call Us: (519)745-5067
					</div>
			</div>
		</div>

		<div id="main-menus">
			<ul>
				<li><a href="home">Home</a></li>
				<li><a
					href="motor-vehicle-accident">Motor Vehicle Accident</a></li>
				<li><a href="direction-and-office-hour">Direction and Office Hour</a></li>
			</ul>
		</div>