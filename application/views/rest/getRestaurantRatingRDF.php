<?PHP
	$namespace = "http://example.com/iwa/";

	$result = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
	$result .= "<rdf:RDF
		xmlns:rdf=\"http://www.w3.org/1999/02/22-rdf-syntax-ns#\"
		xmlns:rdfs=\"http://www.w3.org/2000/01/rdf-schema#\"
		xmlns:foaf=\"http://xmlns.com/foaf/0.1/\"
		xmlns:geo=\"http://www.w3.org/2003/01/geo/wgs84_pos#\"
		xmlns:gn=\"http://www.geonames.org/ontology#\"
		xmlns:dbpedia=\"http://dbpedia.org/page/\"
		xmlns:dbpprop=\"http://dbpedia.org/property/\"
		xmlns:dbpedia-owl=\"http://dbpedia.org/ontology/\"
		xmlns:dbpedia-res=\"http://dbpedia.org/resource/\"
		xmlns:fs=\"https://api.foursquare.com/v2/venues/\"
		xmlns:dc=\"http://purl.org/dc/terms/\"
		xmlns:ah=\"http://purl.org/artsholland/1.0/\"
		xmlns:vcard=\"http://www.w3.org/2006/vcard/ns#\"
		xmlns:iwa=\"$namespace\">\n\n";

	$result.= "\t\t<rdf:Description rdf:about=\"$url\">
			<rdf:type rdf:resource=\"http://dbpedia.org/ontology/Restaurant\"/>
			<dc:title>$name</dc:title>\n";
	if($phonenumber) {
	$result.= "\t\t	<foaf:phone>$phonenumber</foaf:phone>\n";
	}
	$result.= "	<dbpedia-owl:location>
				<rdf:Description>
					<dbpedia-owl:address>$address</dbpedia-owl:address>
					<geo:latitude>$lat</geo:latitude>
					<geo:longitude>$lon</geo:longitude>
				</rdf:Description>
			</dbpedia-owl:location>\n";
	if($id) {
	$result.= "\t\t	<iwa:id>$id</iwa:id>\n";
	}
	if($website) {
	$result.= "\t\t	<foaf:homepage>$website</foaf:homepage>\n";
	}
	if($mail) {
	$result.= "\t\t	<vcard:email>$mail</vcard:email>\n";
	}
	if(isset($rating_food)) {
	$result.= "\t\t	<iwa:ratingFood>$rating_food</iwa:ratingFood>\n";
	}
	if(isset($rating_service)) {
	$result.= "\t\t	<iwa:ratingService>$rating_service</iwa:ratingService>\n";
	}
	if(isset($rating_interior)) {
	$result.= "\t\t	<iwa:ratingInterior>$rating_interior</iwa:ratingInterior>\n";
	}
	if($kitchenType) {
	$result.= "\t\t	<iwa:kitchenType>$kitchenType</iwa:kitchenType>\n";
	}
	if($kitchenFacilities) {
	$result.= "\t\t	<iwa:kitchenFacilities>$kitchenFacilities</iwa:kitchenFacilities>\n";
	}
	if($menuTypes) {
	$result.= "\t\t	<iwa:menuTypes>$menuTypes</iwa:menuTypes>\n";
	}
	$mustcloseOpenHours = false;
	if(is_array($openTimes) && ($openTimes['monday'] || $openTimes['tuesday'] || $openTimes['wednesday'] || $openTimes['thursday'] || $openTimes['friday'] || $openTimes['saturday'] || $openTimes['sunday'])) {
	$result.= "\t\t	<iwa:openHours>\n";
	$result.= "\t\t\t	<rdf:Description>\n";
	$mustcloseOpenHours = true;
	}
	if(is_array($openTimes) && $openTimes['monday']) {
	$result.= "\t\t\t		<iwa:openHoursMonday>".$openTimes['monday']."</iwa:openHoursMonday>\n";
	}
	if(is_array($openTimes) && $openTimes['tuesday']) {
	$result.= "\t\t\t		<iwa:openHoursTuesday>".$openTimes['tuesday']."</iwa:openHoursTuesday>\n";
	}
	if(is_array($openTimes) && $openTimes['wednesday']) {
	$result.= "\t\t\t		<iwa:openHoursWednesday>".$openTimes['wednesday']."</iwa:openHoursWednesday>\n";
	}
	if(is_array($openTimes) && $openTimes['thursday']) {
	$result.= "\t\t\t		<iwa:openHoursThursday>".$openTimes['thursday']."</iwa:openHoursThursday>\n";
	}
	if(is_array($openTimes) && $openTimes['friday']) {
	$result.= "\t\t\t		<iwa:openHoursFriday>".$openTimes['friday']."</iwa:openHoursFriday>\n";
	}
	if(is_array($openTimes) && $openTimes['saturday']) {
	$result.= "\t\t\t		<iwa:openHoursSaturday>".$openTimes['saturday']."</iwa:openHoursSaturday>\n";
	}
	if(is_array($openTimes) && $openTimes['sunday']) {
	$result.= "\t\t\t		<iwa:openHoursSunday>".$openTimes['sunday']."</iwa:openHoursSunday>\n";
	}
	if($mustcloseOpenHours) {
	$result.= "\t\t\t	</rdf:Description>\n";
	$result.= "\t\t	</iwa:openHours>\n";
	}
	if(!is_array($openTimes) && $openTimes) {
	$result.= "\t\t	<iwa:openHours>$openTimes</iwa:openHours>\n";
	}
	if($averageMenuPrice) {
	$result.= "\t\t	<iwa:averageMenuPrice>$averageMenuPrice</iwa:averageMenuPrice>\n";	
	}
	if($minimumMenuPrice) {
	$result.= "\t\t	<iwa:minimumMenuPrice>$minimumMenuPrice</iwa:minimumMenuPrice>\n";	
	}
	if($houseWineBottlePrice) {
	$result.= "\t\t	<iwa:houseWineBottlePrice>$houseWineBottlePrice</iwa:houseWineBottlePrice>\n";
	}
	if($houseWineGlassPrice) {
	$result.= "\t\t	<iwa:houseWineGlassPrice>$houseWineGlassPrice</iwa:houseWineGlassPrice>\n";	
	}
	if($childMenuPrice) {
	$result.= "\t\t	<iwa:childMenuPrice>$childMenuPrice</iwa:childMenuPrice>\n";
	}
	if($paymentOptions) {
	$result.= "\t\t	<iwa:paymentOptions>$paymentOptions</iwa:paymentOptions>\n";
	}
	if($chef) {
	$result.= "\t\t	<iwa:chef>$chef</iwa:chef>\n";
	}
	if($maitre) {
	$result.= "\t\t	<iwa:maitre>$maitre</iwa:maitre>\n";
	}
	if($sommelier) {
	$result.= "\t\t	<iwa:sommelier>$sommelier</iwa:sommelier>\n";
	}
	if($facilities) {
	$result.= "\t\t	<iwa:facilities>$facilities</iwa:facilities>\n";
	}
	if($parkingPossibilities) {
	$result.= "\t\t	<iwa:parkingPossibilities>$parkingPossibilities</iwa:parkingPossibilities>\n";
	}
	if($groupPossibilities) {
	$result.= "\t\t	<iwa:groupPossibilities>$groupPossibilities</iwa:groupPossibilities>\n";
	}
	if($privateRoomPossibilities) {
	$result.= "\t\t	<iwa:privateRoomPossibilities>$privateRoomPossibilities</iwa:privateRoomPossibilities>\n";
	}
	if($typeRestaurant) {
	$result.= "\t\t	<iwa:typeRestaurant>$typeRestaurant</iwa:typeRestaurant>\n";
	}
	if($exteriorDiningOptions) {
	$result.= "\t\t	<iwa:exteriorDiningOptions>$exteriorDiningOptions</iwa:exteriorDiningOptions>\n";
	}
	if($childFeatures) {
	$result.= "\t\t	<iwa:childFeatures>$childFeatures</iwa:childFeatures>\n";
	}
	if($accessibility) {
	$result.= "\t\t	<iwa:accessibility>$accessibility</iwa:accessibility>\n";
	}
	if($photos) {
	$result.= "\t\t	<dbpprop:hasPhotoCollection>
				<rdf:Description>\n";
		foreach($photos as $photo) {
		$result.= "\t\t\t\t	 <dbpedia-res:Photograph>$photo</dbpedia-res:Photograph>\n";
		}
	$result.= "\t\t\t	</rdf:Description>
			</dbpprop:hasPhotoCollection>\n";
	}

	$result .= "\t </rdf:Description>\n";
	$result .= "</rdf:RDF>";
	
	echo $result;
?>
