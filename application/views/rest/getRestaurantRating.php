<?PHP
	$data = array();
	if($name) {
		$data['name'] = $name;
	}
	if($url) {
		$data['url'] = $url;
	}
	if($id) {
		$data['id'] = $id;
	}
	if($address) {
		$data['address'] = $address;
	}
	if($phonenumber) {
		$data['phonenumber'] = $phonenumber;
	}
	if(isset($rating_food)) {
		$data['rating_food'] = $rating_food;
	}
	if(isset($rating_service)) {
		$data['rating_service'] = $rating_service;
	}
	if(isset($rating_interior)) {
		$data['rating_interior'] = $rating_interior;
	}
	if($website) {
		$data['website'] = $website;
	}
	if($mail) {
		$data['email'] = $mail;
	}
	if($kitchenType) {
		$data['kitchenType'] = $kitchenType;
	}
	if($kitchenFacilities) {
		$data['kitchenFacilities'] = $kitchenFacilities;
	}
	if($menuTypes) {
		$data['menuTypes'] = $menuTypes;
	}
	if(is_array($openTimes) && $openTimes['monday']) {
		$data['openTimes']['monday'] = $openTimes['monday'];
	}
	if(is_array($openTimes) && $openTimes['tuesday']) {
		$data['openTimes']['tuesday'] = $openTimes['tuesday'];
	}
	if(is_array($openTimes) && $openTimes['wednesday']) {
		$data['openTimes']['wednesday'] = $openTimes['wednesday'];
	}
	if(is_array($openTimes) && $openTimes['thursday']) {
		$data['openTimes']['thursday'] = $openTimes['thursday'];
	}
	if(is_array($openTimes) && $openTimes['friday']) {
		$data['openTimes']['friday'] = $openTimes['friday'];
	}
	if(is_array($openTimes) && $openTimes['saturday']) {
		$data['openTimes']['saturday'] = $openTimes['saturday'];
	}
	if(is_array($openTimes) && $openTimes['sunday']) {
		$data['openTimes']['sunday'] = $openTimes['sunday'];
	}
	if(!is_array($openTimes) && $openTimes) {
		$data['openTimes'] = $openTimes;
	}
	if($averageMenuPrice) {
		$data['averageMenuPrice'] = $averageMenuPrice;
	}
	if($minimumMenuPrice) {
		$data['minimumMenuPrice'] = $minimumMenuPrice;
	}
	if($houseWineBottlePrice) {
		$data['houseWineBottlePrice'] = $houseWineBottlePrice;
	}
	if($houseWineGlassPrice) {
		$data['houseWineGlassPrice'] = $houseWineGlassPrice;
	}
	if($childMenuPrice) {
		$data['childMenuPrice'] = $childMenuPrice;
	}
	if($paymentOptions) {
		$data['paymentOptions'] = $paymentOptions;
	}
	if($chef) {
		$data['chef'] = $chef;
	}
	if($maitre) {
		$data['maitre'] = $maitre;
	}
	if($sommelier) {
		$data['sommelier'] = $sommelier;
	}
	if($facilities) {
		$data['facilities'] = $facilities;
	}
	if($parkingPossibilities) {
		$data['parkingPossibilities'] = $parkingPossibilities;
	}
	if($groupPossibilities) {
		$data['groupPossibilities'] = $groupPossibilities;
	}
	if($privateRoomPossibilities) {
		$data['privateRoomPossibilities'] = $privateRoomPossibilities;
	}
	if($typeRestaurant) {
		$data['typeRestaurant'] = $typeRestaurant;
	}
	if($exteriorDiningOptions) {
		$data['exteriorDiningOptions'] = $exteriorDiningOptions;
	}
	if($childFeatures) {
		$data['childFeatures'] = $childFeatures;
	}
	if($accessibility) {
		$data['accessibility'] = $accessibility;
	}
	if($lat) {
		$data['lat'] = $lat;
	}
	if($lon) {
		$data['lon'] = $lon;
	}
	if($photos) {
		$data['photos'] = $photos;
	}
	echo json_encode($data);
?>
