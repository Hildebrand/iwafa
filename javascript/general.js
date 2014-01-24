var myLocationMarker;
var map;
var currentZoom;
var zoomBoundLevel = 8;
var venues;
var markers = new Array();
var backup;
var greenPinColor = "198633";
var bluePinColor = "1a3385";
var yellowPinColor = "ffdd21";
var greenPinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + greenPinColor,
	new google.maps.Size(21, 34),
	new google.maps.Point(0,0),
	new google.maps.Point(10, 34));
var bluePinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + bluePinColor,
	new google.maps.Size(21, 34),
	new google.maps.Point(0,0),
	new google.maps.Point(10, 34));
var yellowPinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + yellowPinColor,
	new google.maps.Size(21, 34),
	new google.maps.Point(0,0),
	new google.maps.Point(10, 34));
var pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
	new google.maps.Size(40, 37),
	new google.maps.Point(0, 0),
	new google.maps.Point(12, 35));

var ahpref = 'PREFIX ah: <http://purl.org/artsholland/1.0/>\n';
	ahpref += 'PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>\n';
	ahpref += 'PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>\n';
	ahpref += 'PREFIX owl: <http://www.w3.org/2002/07/owl#>\n';
	ahpref += 'PREFIX dc: <http://purl.org/dc/terms/>\n';
	ahpref += 'PREFIX foaf: <http://xmlns.com/foaf/0.1/>\n';
	ahpref += 'PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>\n';
	ahpref += 'PREFIX time: <http://www.w3.org/2006/time#>\n';
	ahpref += 'PREFIX geo: <http://www.w3.org/2003/01/geo/wgs84_pos#>\n';
	ahpref += 'PREFIX vcard: <http://www.w3.org/2006/vcard/ns#>\n';
	ahpref += 'PREFIX osgeo: <http://rdf.opensahara.com/type/geo/>\n';
	ahpref += 'PREFIX bd: <http://www.bigdata.com/rdf/search#>\n';
	ahpref += 'PREFIX search: <http://rdf.opensahara.com/search#>\n';
	ahpref += 'PREFIX fn: <http://www.w3.org/2005/xpath-functions#>\n';
	ahpref += 'PREFIX gr: <http://purl.org/goodrelations/v1#>\n';
	ahpref += 'PREFIX gn: <http://www.geonames.org/ontology#>\n';

$(document).ready(function() {
	hideRows();
	initializeMap();
	placeRestaurantMarkers();
	if(!$.cookie("lat")) {
		getLocation(null);
	} else {
		getPositionProperties($.cookie("lat"), $.cookie("lon"));
	}

	// bind geo autocomplete to input field
	$(".posContainer").geocomplete()
	.bind("geocode:result", function(event, result) {
		$.cookie("lat", result.geometry.location.lat());
		$.cookie("lon", result.geometry.location.lng());
		clearMap();
		drawMarkers();
	});

	// make active navigation tab highlighted
	$($(".nav li")[0]).addClass('active');
	$("#legendlink").popover();
	backup = JSON.parse(JSON.stringify(restaurants));
});

function drawMarkers() {
	placeRestaurantMarkers();
	placeVenueMarkers();
	createGreenMarker(new google.maps.LatLng($.cookie('lat'), $.cookie('lon')), 'My location');
}

function placeVenueMarkers() {
	if(typeof venues !== 'undefined' && venues.results.bindings.length > 0) {
		for(var i=0; i<venues.results.bindings.length; i++) {
			var ven = venues.results.bindings[i];
			createBlueMarker(new google.maps.LatLng(ven.lat.value, ven.long.value), ven.title.value, ven);
		}
	}
}

function placeRestaurantMarkers () {
	for(var i=0; i<restaurants.results.bindings.length; i++) {
		var res = restaurants.results.bindings[i];
		var lat = res.lat.value;
		var lon = res.lon.value;
		var title = res.title.value;
		var url = res.res.value;
		var yellow = res.active;
		
		createMarker(new google.maps.LatLng(lat, lon), title, url, yellow);
	}
}

function inBackup(restaurant) {
	for(var i=0; i<backup.results.bindings.length; i++) {
		var backres = backup.results.bindings[i];
		if(backres.res.value == restaurant.res.value) {
			return true;
		}
	}
	return false;
}

function cleanupRestaurants(bounds) {
	for(var i=restaurants.results.bindings.length-1; i>=0; i--) {
		var res = restaurants.results.bindings[i];
		if(res.lat.value < bounds.getSouthWest().lat() || res.lat.value > bounds.getNorthEast().lat() || res.lon.value < bounds.getSouthWest().lng() || res.lon.value > bounds.getNorthEast().lng()) {
			if(!inBackup(res)) {
				restaurants.results.bindings.splice(i, 1);
			}
		}
	}
}

function errorCallback(error) {
	var errorString;
	if(error.code == 1) {
		errorString = 'Permission denied';
	} else if(error.code == 2) {
		errorString = 'Position unavailable';
	} else {
		errorString = 'Timeout';
	}
	showWarning("There was a problem getting your location; enter a position to search in its vicinity.<br />Error: "+error.code+" ("+errorString+")");
	checkGeoAnswer();
}

function getLocation(event) { // get lat/long via javascript api
	if(event != null) {
		event.preventDefault();
	}
	var alertContainer = $(".alert-warning");

	if (navigator.geolocation) {
		runWithTimeout(checkGeoAnswer);
		navigator.geolocation.getCurrentPosition(convertPosition, errorCallback, {timeout:10000});
	} else {
		showWarning("Geolocation is not supported by this browser.");
	}
}

function convertPosition(position) {
	$.cookie("lat", position.coords.latitude);
	$.cookie("lon", position.coords.longitude);

	getPositionProperties(position.coords.latitude, position.coords.longitude);
}

function formatDate (date) {
	var dateString;
	dateString = date.getFullYear() + '-' +
		('0' + (date.getMonth()+1)).slice(-2) + '-' +
		('0' + date.getDate()).slice(-2);
	console.log(dateString);
	return dateString;
}

function createBlueMarker (pos, t, ven) {
	var marker = new google.maps.Marker({
		position: pos, 
		map: map,  // google.maps.Map 
		title: t,
		icon: bluePinImage,
		shadow: pinShadow
	});
	google.maps.event.addListener(marker, 'click', function() {
		var content = '<tr><td>Title: </td><td>'+ven.title.value+'</td></tr>';
		if(typeof ven.street !== 'undefined') {
			content += '<tr><td>Address: </td><td>'+ven.street.value+'</td></tr>';
		}
		if(typeof ven.sdesc !== 'undefined') {
			content += '<tr><td>Description: </td><td>'+ven.sdesc.value+'</td></tr>';
		}
		$("#venuedetailtable").html(content);
		$("#introbox").insertAfter($("#eventbox"));

		var now = new Date();
		var weekAgo = new Date(); var nextWeek = new Date();
		weekAgo.setDate(now.getDate()-7);
		nextWeek.setDate(now.getDate()+21);
	var	ahquery = ahpref+'SELECT ?ev ?beg ?end ?desc ?title ?genrelab';
		ahquery += ' WHERE {';
			ahquery += '?ev a <http://purl.org/artsholland/1.0/Event>; ah:venue <'+ven.v.value+'>; time:hasBeginning ?beg; time:hasEnd ?end; dc:description ?desc; ah:production ?prod.';
			ahquery += '?prod dc:title ?title; ah:genre ?genre.';
			ahquery += '?genre rdfs:label ?genrelab.';
			ahquery += 'FILTER (?beg > "'+formatDate(weekAgo)+'T10:20:00Z"^^xsd:dateTime && ?beg < "'+formatDate(nextWeek)+'T10:20:00Z"^^xsd:dateTime)';
			ahquery += 'FILTER (?end > "'+formatDate(now)+'T10:20:00Z"^^xsd:dateTime)';
		ahquery += '} LIMIT 10';

		$.ajax({
			url: 'http://pwnshop.nl/ahsparql',
			type: 'post',
			data: { query: ahquery, api_key: '9cbce178ed121b61a0797500d62cd440' },
			headers: { Accept: 'application/sparql-results+json' },
			dataType: 'json',
			success: function(data) {
				var nr_events = data.results.bindings.length;
				var i;
				var string = '';
				for(i = 0; i<nr_events; i++) {
					var eve = data.results.bindings[i];
					
					string += '<tr><td style="min-width: 120px; vertical-align: top;">Title: </td><td>'+eve.title.value+'</td></tr>';
					string += '<tr><td style="vertical-align: top;">Genre: </td><td>'+eve.genrelab.value+'</td></tr>';
					string += '<tr><td style="vertical-align: top;">Starts: </td><td>'+eve.beg.value+'</td></tr>';
					string += '<tr><td style="vertical-align: top;">Ends: </td><td>'+eve.end.value+'</td></tr>';
					string += '<tr style="border-bottom: 1px solid #e3e3e3;"><td style="vertical-align: top;">Description: </td><td>'+eve.desc.value+'</td></tr>';
					// with last: border-bottom: 1px solid #e3e3e3
				}
				$("#eventtable").html(string);
			}
		});
		
	});
	marker.setZIndex(google.maps.Marker.MAX_ZINDEX + 1);
	markers.push(marker);
	return marker;
}

function createGreenMarker (pos, t) {
	var marker = new google.maps.Marker({
		position: pos, 
		map: map,  // google.maps.Map 
		title: t,
		icon: greenPinImage,
		shadow: pinShadow
	});
	marker.setZIndex(google.maps.Marker.MAX_ZINDEX + 1);
	markers.push(marker);
	return marker;
}

function highLight(highres) {
	for(var i=0; i<restaurants.results.bindings.length; i++) {
		var res = restaurants.results.bindings[i];
		if(res.active) {
			res.active = false;
		}
		if(res.res.value == highres) {
			res.active = true;
		}
	}
}

function createMarker(pos, t, url, yellow) {
	var marker = new google.maps.Marker({
		position: pos, 
		map: map,  // google.maps.Map 
		title: t
	});
	if(yellow) {
		marker.setIcon(yellowPinImage);
	}
	google.maps.event.addListener(marker, 'click', function() {
		$("#restitle").html('<a href="'+url+'">'+marker.title+'</a>');
		highLight(url);
		var query = 'PREFIX :<http://example.com/iwa/>';
			query += 'PREFIX dbpedia-owl:<http://dbpedia.org/ontology/>';
			query += 'PREFIX dc:<http://purl.org/dc/terms/>';
			query += 'PREFIX geo:<http://www.w3.org/2003/01/geo/wgs84_pos#>';
			query += 'PREFIX xsd:<http://www.w3.org/2001/XMLSchema#>';
			query += 'PREFIX rdf:<http://www.w3.org/1999/02/22-rdf-syntax-ns#>';
			query += 'PREFIX foaf:<http://xmlns.com/foaf/0.1/>';
			query += 'PREFIX vcard:<http://www.w3.org/2006/vcard/ns#>';
			query += 'PREFIX dbpedia-res:<http://dbpedia.org/resource/>';
			query += 'PREFIX dbpprop:<http://dbpedia.org/property/>';
			query += 'PREFIX iwa:<http://example.com/iwa/>';

		query += 'SELECT ?title ?add ?lat ?lon ?phone ?id ?website ?ratingFood ?ratingService ?ratingInterior ?kitchenType ?kitchenFacilities ?menuTypes ?openHours ?averageMenuPrice ?minimumMenuPrice ?houseWineBottlePrice ?houseWineGlassPrice ?childMenuPrice ?paymentOptions ?chef ?maitre ?sommelier ?facilities ?parkingPossibilities ?groupPossibilities ?privateRoomPossibilities ?typeRestaurant ?exteriorDiningOptions ?childFeatures ?accessibility ?monday ?tuesday ?wednesday ?thursday ?friday ?saturday ?sunday ?photo ?gr WHERE {';
			query += '<'+url+'> a dbpedia-owl:Restaurant ;';
			query += '	dc:title ?title ;';
			query += '	iwa:id ?id .';
			query += '	OPTIONAL { <'+url+'> foaf:phone ?phone } .';
			query += '	OPTIONAL { <'+url+'> foaf:homepage ?website } .';
			query += '	OPTIONAL { <'+url+'> vcard:email ?email } .';
			query += '	OPTIONAL { <'+url+'> iwa:ratingFood ?ratingFood } .';
			query += '	OPTIONAL { <'+url+'> iwa:ratingService ?ratingService } .';
			query += '	OPTIONAL { <'+url+'> iwa:ratingInterior ?ratingInterior } .';
			query += '	OPTIONAL { <'+url+'> iwa:kitchenType ?kitchenType } .';
			query += '	OPTIONAL { <'+url+'> iwa:kitchenFacilities ?kitchenFacilities } .';
			query += '	OPTIONAL { <'+url+'> iwa:menuTypes ?menuTypes } .';
			query += '	OPTIONAL { <'+url+'> iwa:averageMenuPrice ?averageMenuPrice } .';
			query += '	OPTIONAL { <'+url+'> iwa:minimumMenuPrice ?minimumMenuPrice } .';
			query += '	OPTIONAL { <'+url+'> iwa:houseWineBottlePrice ?houseWineBottlePrice } .';
			query += '	OPTIONAL { <'+url+'> iwa:houseWineGlassPrice ?houseWineGlassPrice } .';
			query += '	OPTIONAL { <'+url+'> iwa:childMenuPrice ?childMenuPrice } .';
			query += '	OPTIONAL { <'+url+'> iwa:paymentOptions ?paymentOptions } .';
			query += '	OPTIONAL { <'+url+'> iwa:chef ?chef } .';
			query += '	OPTIONAL { <'+url+'> iwa:maitre ?maitre } .';
			query += '	OPTIONAL { <'+url+'> iwa:sommelier ?sommelier } .';
			query += '	OPTIONAL { <'+url+'> iwa:facilities ?facilities } .';
			query += '	OPTIONAL { <'+url+'> iwa:parkingPossibilities ?parkingPossibilities } .';
			query += '	OPTIONAL { <'+url+'> iwa:groupPossibilities ?groupPossibilities } .';
			query += '	OPTIONAL { <'+url+'> iwa:privateRoomPossibilities ?privateRoomPossibilities } .';
			query += '	OPTIONAL { <'+url+'> iwa:typeRestaurant ?typeRestaurant } .';
			query += '	OPTIONAL { <'+url+'> iwa:exeriorDiningOptions ?exteriorDiningOptions } .';
			query += '	OPTIONAL { <'+url+'> iwa:childFeatures ?childFeatures } .';
			query += '	OPTIONAL { <'+url+'> iwa:accessibility ?accessibility } .';
			query += '	OPTIONAL { <'+url+'> iwa:google-rating ?gr } .';
			query += '	OPTIONAL { <'+url+'> iwa:openHours ?openHours ';
			query += '		OPTIONAL { ?openHours iwa:openHoursMonday ?monday }';
			query += '		OPTIONAL { ?openHours iwa:openHoursTuesday ?tuesday }';
			query += '		OPTIONAL { ?openHours iwa:openHoursWednesday ?wednesday }';
			query += '		OPTIONAL { ?openHours iwa:openHoursThursday ?thursday }';
			query += '		OPTIONAL { ?openHours iwa:openHoursFriday ?friday }';
			query += '		OPTIONAL { ?openHours iwa:openHoursSaturday ?saturday }';
			query += '		OPTIONAL { ?openHours iwa:openHoursSunday ?sunday }}';
			query += '	OPTIONAL { <'+url+'> dbpprop:hasPhotoCollection ?coll ';
			query += '		OPTIONAL { ?coll dbpedia-res:Photograph ?photo }}';
			query += '	OPTIONAL { <'+url+'> dbpedia-owl:location ?loc ';
			query += '		OPTIONAL { ?loc dbpedia-owl:address ?add }';
			query += '		OPTIONAL { ?loc geo:latitude ?lat }';
			query += '		OPTIONAL { ?loc geo:longitude ?lon }}';
			query += '}';

		$.ajax({
			url: 'http://pwnshop.nl/sparql',
			type: 'get',
			data: { query: query },
			headers: { Accept: 'application/sparql-results+json' },
			dataType: 'json',
			success: function(data) {
				var res = data.results.bindings[0];
				hideRows();
				if(typeof res.add !== 'undefined') {
					$("#resaddress").html(res.add.value);
					$("#addrrow").show();
				}
				if(typeof res.phone !== 'undefined') {
					$("#resphone").html(res.phone.value);
					$("#phonerow").show();
				}
				if(typeof res.homepage !== 'undefined') {
					$("#reshomepage").html(res.homepage.value);
					$("#homepagerow").show();
				}
				if(typeof res.email !== 'undefined') {
					$("#resemail").html(res.email.value);
					$("#emailrow").show();
				}
				if(typeof res.ratingFood !== 'undefined') {
					$("#resratingfood").html(res.ratingFood.value);
					$("#ratingfoodrow").show();
				}
				if(typeof res.ratingService !== 'undefined') {
					$("#resratingservice").html(res.ratingService.value);
					$("#ratingservicerow").show();
				}
				if(typeof res.ratingInterior !== 'undefined') {
					$("#resratinginterior").html(res.ratingInterior.value);
					$("#ratinginteriorrow").show();
				}
				if(typeof res.kitchenType !== 'undefined') {
					$("#reskitchentype").html(res.kitchenType.value);
					$("#kitchentyperow").show();
				}
				if(typeof res.menuTypes !== 'undefined') {
					$("#resmenutypes").html(res.menuTypes.value);
					$("#menutypesrow").show();
				}
				if(typeof res.averageMenuPrice !== 'undefined') {
					$("#resaveragemenuprice").html(res.averageMenuPrice.value);
					$("#averagemenupricerow").show();
				}
				if(typeof res.minimumMenuPrice !== 'undefined') {
					$("#resminimummenuprice").html(res.minimumMenuPrice.value);
					$("#minimummenupricerow").show();
				}
				if(typeof res.houseWineBottlePrice !== 'undefined') {
					$("#reshousewinebottleprice").html(res.houseWineBottlePrice.value);
					$("#housewinebottlepricerow").show();
				}
				if(typeof res.houseWineGlassPrice !== 'undefined') {
					$("#reshousewineglassprice").html(res.houseWineGlassPrice.value);
					$("#housewineglasspricerow").show();
				}
				if(typeof res.childMenuPrice !== 'undefined') {
					$("#reschildmenuprice").html(res.childMenuPrice.value);
					$("#childmenupricerow").show();
				}
				if(typeof res.paymentOptions !== 'undefined') {
					$("#respaymentoptions").html(res.paymentOptions.value);
					$("#paymentoptionsrow").show();
				}
				if(typeof res.chef !== 'undefined') {
					$("#reschef").html(res.chef.value);
					$("#chefrow").show();
				}
				if(typeof res.maitre !== 'undefined') {
					$("#resmaitre").html(res.maitre.value);
					$("#maitrerow").show();
				}
				if(typeof res.sommelier !== 'undefined') {
					$("#ressommelier").html(res.sommelier.value);
					$("#sommelierrow").show();
				}
				if(typeof res.facilities !== 'undefined') {
					$("#resfacilities").html(res.facilities.value);
					$("#facilitiesrow").show();
				}
				if(typeof res.parkingPossibilities !== 'undefined') {
					$("#resparkingpossibilities").html(res.parkingPossibilities.value);
					$("#parkingpossibilitiesrow").show();
				}
				if(typeof res.groupPossibilities !== 'undefined') {
					$("#resgrouppossibilities").html(res.groupPossibilities.value);
					$("#grouppossibilitiesrow").show();
				}
				if(typeof res.privateRoomPossibilities !== 'undefined') {
					$("#resprivateroompossibilities").html(res.privateRoomPossibilities.value);
					$("#privateroompossibilitiesrow").show();
				}
				if(typeof res.typeRestaurant !== 'undefined') {
					$("#restyperestaurant").html(res.typeRestaurant.value);
					$("#typerestaurantrow").show();
				}
				if(typeof res.exteriorDiningOptions !== 'undefined') {
					$("#resexteriordiningoptions").html(res.exteriorDiningOptions.value);
					$("#exteriordiningoptionsrow").show();
				}
				if(typeof res.childFeatures !== 'undefined') {
					$("#reschildfeatures").html(res.childFeatures.value);
					$("#childfeaturesrow").show();
				}
				if(typeof res.accessibility !== 'undefined') {
					$("#resaccessibility").html(res.accessibility.value);
					$("#accessibilityrow").show();
				}
				var openHoursString = '';
				if(typeof res.monday !== 'undefined') {
					openHoursString += 'Monday: '+res.monday.value+'<br />';
					$("#openhoursrow").show();
				}
				if(typeof res.tuesday !== 'undefined') {
					openHoursString += 'Tuesday: '+res.tuesday.value+'<br />';
					$("#openhoursrow").show();
				}
				if(typeof res.wednesday !== 'undefined') {
					openHoursString += 'Wednesday '+res.wednesday.value+'<br />';
					$("#openhoursrow").show();
				}
				if(typeof res.thursday !== 'undefined') {
					openHoursString += 'Thursday: '+res.thursday.value+'<br />';
					$("#openhoursrow").show();
				}
				if(typeof res.friday !== 'undefined') {
					openHoursString += 'Friday: '+res.friday.value+'<br />';
					$("#openhoursrow").show();
				}
				if(typeof res.saturday !== 'undefined') {
					openHoursString += 'Saturday: '+res.saturday.value+'<br />';
					$("#openhoursrow").show();
				}
				if(typeof res.sunday !== 'undefined') {
					openHoursString += 'Sunday: '+res.sunday.value+'<br />';
					$("#openhoursrow").show();
				}
				if(typeof res.openHours !== 'undefined' && res.openHours.value.substring(0,4) != 'node') {
					openHoursString = res.openHours.value;
				}
				$("#resopenhours").html(openHoursString);
				if(typeof res.photo !== 'undefined') {
					$("#resimage").attr('src', res.photo.value);
					$("#resimage").show();
				} else {
					$("#resimage").hide();
				}
				if(typeof res.gr !== 'undefined') {
					$("#resgooglerating").html(parseFloat(res.gr.value) * 2);
					$("#googleratingrow").show();
				}
			}
		});
		
	var	ahquery = ahpref+'SELECT ?v ?lat ?long ?title ?sdesc ?desc ?street ?city ?pcode';
		ahquery += ' WHERE {';
			ahquery += '?v a ah:Venue; geo:lat ?lat; geo:long ?long; dc:title ?title;';
			ahquery += 'OPTIONAL { ?v dc:description ?desc }';
			ahquery += 'OPTIONAL { ?v ah:shortDescription ?sdesc }';
			ahquery += 'OPTIONAL { ?v ah:locationAddress ?addr. ?addr vcard:locality ?city; vcard:street-address ?street; vcard:postal-code ?pcode }';
			ahquery += 'FILTER (?lat < '+pos.lat()+' + 1/111 && ?lat > '+pos.lat()+' - 1/111 && ?long < '+pos.lng()+' + 1/68 && ?long > '+pos.lng()+' - 1/68)';
			ahquery += 'FILTER(langMatches(lang(?title), \'EN\'))';
			ahquery += 'FILTER(langMatches(lang(?desc), \'EN\') || !BOUND(?desc))';
			ahquery += 'FILTER(langMatches(lang(?sdesc), \'EN\') || !BOUND(?sdesc))';
		ahquery += '}';
		ahquery += 'ORDER BY ((?lat - '+pos.lat()+')*(?lat - '+pos.lat()+')*111*111 + (?long - '+pos.lng()+')*(?long - '+pos.lng()+')*68*68)\n';
		ahquery += 'LIMIT 10';

		$.ajax({
			url: 'http://pwnshop.nl/ahsparql',
			type: 'post',
			data: { query: ahquery, api_key: '9cbce178ed121b61a0797500d62cd440' },
			headers: { Accept: 'application/sparql-results+json' },
			dataType: 'json',
			success: function(data) {
				venues = data;
				var nr_vens = data.results.bindings.length;
				$("#venuecounter").html(nr_vens);
				var i;
				var string = '';
				for(i = 0; i<nr_vens; i++) {
					var ven = data.results.bindings[i];
					
					string += '<tr><td style="min-width: 180px; vertical-align: top;">Name: </td><td>'+ven.title.value+'</td></tr>';
					var dist = getDistance(pos.lat(), pos.lng(), ven.lat.value, ven.long.value);
					string += '<tr><td style="padding-left: 15px">Distance from restaurant: </td><td>'+dist+'km.</td></tr>';
				}
				$("#venuetable").html(string);
				console.log(data);
				clearMap();
				drawMarkers();
			}
		});

	});
	markers.push(marker);
	return marker;
}

function getDistance(lat1, lon1, lat2, lon2) {
	return Math.round(Math.sqrt(Math.pow(lat1-lat2, 2)*Math.pow(111, 2) + Math.pow(lon1-lon2, 2)*Math.pow(68, 2))*100)/100;
}

function clearMap () {
	var i;
	for(i = 0; i<markers.length; i++) {
		markers[i].setMap(null);
	}
	markers.length = 0;
}

function getPositionProperties (lat, lon) {
	myLocationMarker = createGreenMarker(new google.maps.LatLng(lat, lon), 'My location');

	var reqString = "http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20geo.placefinder%20where%20text%3D%22"+lat+"%2C"+lon+"%22%20and%20gflags%3D%22R%22&format=json";
	
	var request = $.ajax({
		url: reqString,
		type: "GET",
		accepts: 'application/json',
		dataType: "jsonp"
		});
	request.done(function(data) {
			showPosition(data);
		});
	request.fail(function(jqXHR, textStatus) {
			showError(textStatus);
		});
}

function initializeMap() {
	var mapOptions = {
		center: new google.maps.LatLng(52.132633, 5.2912659),
		zoom: 7,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	map = new google.maps.Map(document.getElementById("map_canvas"),
			mapOptions);

	google.maps.event.addListener(map, 'idle', function() {
		currentZoom = map.getZoom();

		var printString = 'current zoomlevel: '+currentZoom;
		if (currentZoom >= zoomBoundLevel) {
			printString += ', zoomlevel >= 13';
			console.log('maps idle, '+map.getBounds());
			cleanupRestaurants(map.getBounds());
			getRestaurantsFromBounds(map.getBounds());
		}
		console.log(printString);
	});
}

function getRestaurantsFromBounds(bounds) {
	var query = 'PREFIX :<http://example.com/iwa/>';
		query += 'PREFIX dbpedia-owl:<http://dbpedia.org/ontology/>';
		query += 'PREFIX dc:<http://purl.org/dc/terms/>';
		query += 'PREFIX geo:<http://www.w3.org/2003/01/geo/wgs84_pos#>';
		query += 'PREFIX xsd:<http://www.w3.org/2001/XMLSchema#>';
		query += 'PREFIX rdf:<http://www.w3.org/1999/02/22-rdf-syntax-ns#>';
		query += 'PREFIX iwa:<http://example.com/iwa/>';

	query += 'SELECT ?res ?title ?add ?lat ?lon WHERE {';
		query += '?res a dbpedia-owl:Restaurant ;';
		query += '	dc:title ?title ;';
		query += '	iwa:google-rating ?gr ;';
		query += '	dbpedia-owl:location ?loc .';
			
		query += '?loc dbpedia-owl:address ?add ;';
		query += '	geo:latitude ?lat ;';
		query += '	geo:longitude ?lon .';
		query += 'FILTER ((xsd:float(?lon) - '+bounds.getSouthWest().lng()+') >= 0 && ('+bounds.getNorthEast().lng()+' - xsd:float(?lon)) >= 0 && ('+bounds.getNorthEast().lat()+' - xsd:float(?lat)) >= 0 && (xsd:float(?lat) - '+bounds.getSouthWest().lat()+') >= 0)';
		query += 'FILTER NOT EXISTS { ?res iwa:id ?id1;	iwa:id ?id2. FILTER(?id1 != ?id2) }';
		query += 'FILTER regex(STR(?res), "^http://w.+", "i")';
		query += '}';
		query += 'LIMIT 100';

	$.ajax({
		url: 'http://pwnshop.nl/sparql',
		type: 'get',
		data: { query: query },
		headers: { Accept: 'application/sparql-results+json' },
		dataType: 'json',
		success: function(data) {
			console.log(data);
			var i;
			for(i=0; i<data.results.bindings.length; i++) {
				var res = data.results.bindings[i];
				if(!restaurantExists(res.res.value)) {
					restaurants.results.bindings.push(res);
				}
			}
			clearMap();
			drawMarkers();
		}
	});
}

function restaurantExists (iens_url) {
	var i;
	for(i=0; i<restaurants.results.bindings.length; i++) {
		var initRes = restaurants.results.bindings[i];
		if(initRes.res.value == iens_url) {
			return true;
		}
	}
	return false;
}

function showPosition (data) {
	// shows city  name (retrieved from yahoo from lat/long) in search bar
	var posContainer = $(".posContainer"); 
	posContainer.val(data.query.results.Result.city);
}

function checkGeoAnswer () { // replace placeholder text after timeout
	var posContainer = $(".posContainer"); 
	if(posContainer.val() == '') {
		posContainer.attr('placeholder', 'location');
	}
}

function runWithTimeout(func) {
	setTimeout(func, 12000);
}

function showWarning(message) {
	var alertContainer = $(".alert-warning");
	var alertContainerContent = $(".alert-warning .content");
	alertContainerContent.html(message);
	alertContainer.show();
}

function showError(message) {
	var alertContainer = $(".alert-error");
	var alertContainerContent = $(".alert-error .content");
	alertContainerContent.html(message);
	alertContainer.show();
}

function hideRows () {
	$("#addrrow").hide();
	$("#phonerow").hide();
	$("#homepagerow").hide();
	$("#emailrow").hide();
	$("#ratingfoodrow").hide();
	$("#ratingservicerow").hide();
	$("#ratinginteriorrow").hide();
	$("#kitchentyperow").hide();
	$("#kitchenfacilitiesrow").hide();
	$("#menutypesrow").hide();
	$("#averagemenupricerow").hide();
	$("#minimummenupricerow").hide();
	$("#housewinebottlepricerow").hide();
	$("#housewineglasspricerow").hide();
	$("#childmenupricerow").hide();
	$("#paymentoptionsrow").hide();
	$("#chefrow").hide();
	$("#maitrerow").hide();
	$("#sommelierrow").hide();
	$("#facilitiesrow").hide();
	$("#parkingpossibilitiesrow").hide();
	$("#grouppossibilitiesrow").hide();
	$("#privateroompossibilitiesrow").hide();
	$("#typerestaurantrow").hide();
	$("#exteriordiningoptionsrow").hide();
	$("#childfeaturesrow").hide();
	$("#accessibilityrow").hide();
	$("#openhoursrow").hide();
	$("#resimage").attr('src', '').hide();
	$("#googleratingrow").hide();
}
