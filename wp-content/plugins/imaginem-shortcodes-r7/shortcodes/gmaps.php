<?php
function mtheme_googlemapme($attr) {

	// default atts
	$attr = shortcode_atts(array(	
		'lat'   => '0', 
		'lon'    => '0',
		'id' => 'map',
		'z' => '1',
		'h' => '300',
		'maptype' => 'ROADMAP',
		'address' => '',
		'kml' => '',
		'kmlautofit' => 'yes',
		'marker' => '',
		'markerimage' => '',
		'traffic' => 'no',
		'bike' => 'no',
		'fusion' => '',
		'start' => '',
		'end' => '',
		'infowindow' => '',
		'infowindowdefault' => 'yes',
		'directions' => '',
		'hidecontrols' => 'false',
		'scale' => 'false',
		'scrollwheel' => 'true'
		
		), $attr);
									
	$attr['id']= 'map'.uniqid();
	$returnme = '
    <div class="googlemaps" id="' .$attr['id'] . '" style="height: '.$attr["h"].'px;"></div>
	';
	
	//directions panel
	if($attr['start'] != '' && $attr['end'] != '') 
	{
		$panelwidth = $attr['w']-20;
		$returnme .= '
		<div id="directionsPanel" style="width:100%;height:' . $attr['h'] . 'px;border:1px solid gray;padding:10px;overflow:auto;"></div><br>
		';
	}


	$returnme .= '
    
    <script type="text/javascript">
	jQuery(document).ready(function(){
		var latlng = new google.maps.LatLng(' . $attr['lat'] . ', ' . $attr['lon'] . ');
		var isDraggable = jQuery(document).width() > 480 ? true : false;
		var myOptions = {
			zoom: ' . $attr['z'] . ',
			center: latlng,
			draggable: isDraggable,
			scrollwheel: ' . $attr['scrollwheel'] .',
			scaleControl: ' . $attr['scale'] .',
			disableDefaultUI: ' . $attr['hidecontrols'] .',
			mapTypeId: google.maps.MapTypeId.' . $attr['maptype'] . ',
			// This is where you would paste any style found on Snazzy Maps.
            styles: [
    {
        "featureType": "landscape",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 65
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 51
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 30
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road.local",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 40
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "transit",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "administrative.province",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "lightness": -25
            },
            {
                "saturation": -100
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#ffff00"
            },
            {
                "lightness": -25
            },
            {
                "saturation": -97
            }
        ]
    }
]
        };
		var ' . $attr['id'] . ' = new google.maps.Map(document.getElementById("' . $attr['id'] . '"),
		myOptions);
		';
				
		//kml
		if($attr['kml'] != '') 
		{
			if($attr['kmlautofit'] == 'no') 
			{
				$returnme .= '
				var kmlLayerOptions = {preserveViewport:true};
				';
			}
			else
			{
				$returnme .= '
				var kmlLayerOptions = {preserveViewport:false};
				';
			}
			$returnme .= '
			var kmllayer = new google.maps.KmlLayer(\'' . html_entity_decode($attr['kml']) . '\',kmlLayerOptions);
			kmllayer.setMap(' . $attr['id'] . ');
			';
		}

		//directions
		if($attr['start'] != '' && $attr['end'] != '') 
		{
			$returnme .= '
			var directionDisplay;
			var directionsService = new google.maps.DirectionsService();
		    directionsDisplay = new google.maps.DirectionsRenderer();
		    directionsDisplay.setMap(' . $attr['id'] . ');
    		directionsDisplay.setPanel(document.getElementById("directionsPanel"));

				var start = \'' . $attr['start'] . '\';
				var end = \'' . $attr['end'] . '\';
				var request = {
					origin:start, 
					destination:end,
					travelMode: google.maps.DirectionsTravelMode.DRIVING
				};
				directionsService.route(request, function(response, status) {
					if (status == google.maps.DirectionsStatus.OK) {
						directionsDisplay.setDirections(response);
					}
				});


			';
		}
		
		//traffic
		if($attr['traffic'] == 'yes')
		{
			$returnme .= '
			var trafficLayer = new google.maps.TrafficLayer();
			trafficLayer.setMap(' . $attr['id'] . ');
			';
		}
	
		//bike
		if($attr['bike'] == 'yes')
		{
			$returnme .= '			
			var bikeLayer = new google.maps.BicyclingLayer();
			bikeLayer.setMap(' . $attr['id'] . ');
			';
		}
		
		//fusion tables
		if($attr['fusion'] != '')
		{
			$returnme .= '			
			var fusionLayer = new google.maps.FusionTablesLayer(' . $attr['fusion'] . ');
			fusionLayer.setMap(' . $attr['id'] . ');
			';
		}
	
		//address
		if($attr['address'] != '')
		{
			$returnme .= '
		    var geocoder_' . $attr['id'] . ' = new google.maps.Geocoder();
			var address = \'' . $attr['address'] . '\';
			geocoder_' . $attr['id'] . '.geocode( { \'address\': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					' . $attr['id'] . '.setCenter(results[0].geometry.location);
					';
					
					if ($attr['marker'] !='')
					{
						//add custom image
						if ($attr['markerimage'] !='')
						{
							$returnme .= 'var image = "'. $attr['markerimage'] .'";';
						}
						$returnme .= '
						var marker = new google.maps.Marker({
							map: ' . $attr['id'] . ',
							';
							if ($attr['markerimage'] !='')
							{
								$returnme .= 'icon: image,';
							}
						$returnme .= '
							position: ' . $attr['id'] . '.getCenter()
						});
jQuery(window).bind("resize", function () { 
	map.panTo(marker.getPosition());
});';

						//infowindow
						if($attr['infowindow'] != '') 
						{
							//first convert and decode html chars
							$thiscontent = htmlspecialchars_decode($attr['infowindow']);
							$returnme .= '
							var contentString = \'' . $thiscontent . '\';
							var infowindow = new google.maps.InfoWindow({
								content: contentString
							});
										
							google.maps.event.addListener(marker, \'click\', function() {
							  infowindow.open(' . $attr['id'] . ',marker);
							});
							';

							//infowindow default
							if ($attr['infowindowdefault'] == 'yes')
							{
								$returnme .= '
									infowindow.open(' . $attr['id'] . ',marker);
								';
							}
						}
					}
			$returnme .= '
				} else {
				alert("Geocode was not successful for the following reason: " + status);
			}
			});
			';
		}

		//marker: show if address is not specified
		if ($attr['marker'] != '' && $attr['address'] == '')
		{
			//add custom image
			if ($attr['markerimage'] !='')
			{
				$returnme .= 'var image = "'. $attr['markerimage'] .'";';
			}

			$returnme .= '
				var marker = new google.maps.Marker({
				map: ' . $attr['id'] . ', 
				';
				if ($attr['markerimage'] !='')
				{
					$returnme .= 'icon: image,';
				}
			$returnme .= '
				position: ' . $attr['id'] . '.getCenter()
			});
			';

			//infowindow
			if($attr['infowindow'] != '') 
			{
				$returnme .= '
				var contentString = \'' . $attr['infowindow'] . '\';
				var infowindow = new google.maps.InfoWindow({
					content: contentString
				});
							
				google.maps.event.addListener(marker, \'click\', function() {
				  infowindow.open(' . $attr['id'] . ',marker);
				});
				';
				//infowindow default
				if ($attr['infowindowdefault'] == 'yes')
				{
					$returnme .= '
						infowindow.open(' . $attr['id'] . ',marker);
					';
				}				
			}
		}
		$returnme .= '});';
		$returnme .= '</script>';
		return $returnme;
	?>
    

	<?php
}
add_shortcode('map', 'mtheme_googlemapme');
?>