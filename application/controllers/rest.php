<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('phpQuery/phpQuery.php');

class Rest extends CI_Controller {
	public function listvenues($searchstring = '', $iens = false)
	{
		if(isset($_GET['iens'])) {
			$iens = $_GET['iens'] == "false" ? false : true;
		}
		$lat = isset($_GET['lat']) ? $_GET['lat'] : '';
		$lon = isset($_GET['lon']) ? $_GET['lon'] : '';
		if(!isset($searchstring) || $searchstring == '' || $lat == '' || $lon == '') {
			show_error('Invalid search string (empty), please try again.<br />
			This REST call returns JSON and expects the following format:<br />
			/rest/listvenues/$searchstring?lat=...&lon=...');
			return;
		}
		$data['searchstring'] = $searchstring;

		// set the protocol for the api
		$prot = 'https';
		
		// set the target hostname
		$address = 'api.foursquare.com';

		$url = $prot.'://'.$address."/v2/venues/search?intent=browse&ll=$lat,$lon&radius=10000&query=$searchstring&client_id=W4USEKED0G3FB0QBFBUOZ2SXJFDFAU4PGV4SBJK2SMWHX1ZS&client_secret=UIOCS2HQUY14YSQDIPZ51VZ2CED4KGWX1Q5QQAC0OHHYBE4I&v=20130214";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		$result = curl_exec($ch);
		curl_close($ch);

		$fs_array = json_decode($result, true);
		if($iens) {
		foreach($fs_array['response']['venues'] as &$ven) {
			if(isset($ven['name']) && isset($ven['location']['city'])) {
				$res_array = $this->getRestaurantRating(rawurlencode($ven['name'].', '.$ven['location']['city']), false);
				if($res_array != null) {
					if(isset($res_array['rating_food'])) {
						$ven['rating_food'] = $res_array['rating_food'];
					}
					if(isset($res_array['rating_service'])) {
						$ven['rating_service'] = $res_array['rating_service'];
					}
					if(isset($res_array['rating_interior'])) {
						$ven['rating_interior'] = $res_array['rating_interior'];
					}
				}
			}
		}
		}

		header('content-type: application/json');
		$data['output'] = json_encode($fs_array);
		$this->load->view('rest/listvenues', $data);
	}

	public function getRestaurantRating ($searchstring = '', $view = true, $id = false, $json = true) {
		// set the protocol for the api
		$prot = 'http';
		
		// set the target hostname
		$address = 'www.iens.nl';

		if(strtolower(substr($searchstring, 0, 13)) == "restaurant%20") {
			$searchstring = substr($searchstring, 13);
		}

		if(!$id || $id == 'false') {
			$url = $prot.'://'.$address."/zoek-een-restaurant/index.php?searchType=universal&search=$searchstring";

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, $url);
			$result = curl_exec($ch);
			curl_close($ch);

			$iens_search_results = phpQuery::newDocumentHTML($result);

			// extract url to result page
			$data['url'] = $iens_search_results['h2.floatLeft > a']->attr('href');
			if($data['url'] == '') {
				return null;
			}
			$url_long = $prot.'://'.$address.$iens_search_results['h2.floatLeft > a']->attr('href');
			$short_pattern = '/(http:\/\/www.iens.nl\/restaurant\/[0-9]+)\/*/';
			preg_match($short_pattern, $url_long, $matches);
			$url = $matches[1];
			$url_details = $prot.'://'.$address.$iens_search_results['h2.floatLeft > a']->attr('href').'/kenmerken';
		} else {
			$url = $prot.'://'.$address.'/restaurant/'.$id;
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, $url);
			$headers = curl_exec($ch);
			curl_close($ch);

			$loc_pattern = '/Location: (.*)/';
			preg_match($loc_pattern, $headers, $matches);
			$red_url = trim($matches[1]);

			$url_details = $red_url.'/kenmerken';
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $url_details);
		$result2 = curl_exec($ch);
		curl_close($ch);

		$iens_rest = phpQuery::newDocumentHTML($result2);

		// we've got a restaurant! let's extract data
		// scores first
		$i = 0;
		foreach(pq('div.scoreTd > span') as $score) {
			if($i == 0) {
				if(pq($score)->html() != '?') {
					$data['rating_food'] = pq($score)->html();
				}
			} else if($i == 1) {
				if(pq($score)->html() != '?') {
					$data['rating_service'] = pq($score)->html();
				}
			} else {
				if(pq($score)->html() != '?') {
					$data['rating_interior'] = pq($score)->html();
				}
			}
			$i++;
		}

		$data['name'] = pq('.restaurantHeaderName span')->html();
		$data['url'] = $url;
		$data['address'] = $this->joinLinks(pq('.small.paddingSmallBottom:last > a'));
		$data['phonenumber'] = pq('#phonenumber')->html();
		
		if($id != 'false') {
			$data['id'] = $id;
		} else {
			$id_pattern = '/restaurant\/([0-9]+)\/*/';
			preg_match($id_pattern, $url, $matches);
			$data['id'] = $matches[1];	
		}
		
		$data['website'] = pq('#weblink:first')->html();
		$data['mail'] = pq('#maillink:first')->html();
		$data['kitchenType'] = $this->getValueFromTable(pq('#restaurantTable > tr > td'), "Keuken");
		$data['kitchenFacilities'] = $this->getValueFromTable(pq('#restaurantTable > tr > td'), "Faciliteiten keuken");
		$data['menuTypes'] = $this->getValueFromTable(pq('#restaurantTable > tr > td'), "Menu");
		$data['openTimes']['monday'] = $this->getValueFromTable(pq('.openingHoursTableFull > tr > td'), "Maandag", false);
		$data['openTimes']['tuesday'] = $this->getValueFromTable(pq('.openingHoursTableFull > tr > td'), "Dinsdag", false);
		$data['openTimes']['wednesday'] = $this->getValueFromTable(pq('.openingHoursTableFull > tr > td'), "Woensdag", false);
		$data['openTimes']['thursday'] = $this->getValueFromTable(pq('.openingHoursTableFull > tr > td'), "Donderdag", false);
		$data['openTimes']['friday'] = $this->getValueFromTable(pq('.openingHoursTableFull > tr > td'), "Vrijdag", false);
		$data['openTimes']['saturday'] = $this->getValueFromTable(pq('.openingHoursTableFull > tr > td'), "Zaterdag", false);
		$data['openTimes']['sunday'] = $this->getValueFromTable(pq('.openingHoursTableFull > tr > td'), "Zondag", false);
		if(!$data['openTimes']['monday']) {
			$openTimeBlock = explode("<br>", $this->getValueFromTable(pq('#restaurantTable > tr > td'), "Openingstijden"));
			$data['openTimes'] = $openTimeBlock[0];
		}
		$data['averageMenuPrice'] = $this->getValueFromTable(pq('#restaurantTable > tr > td'), "Gemiddelde menuprijs");
		$data['minimumMenuPrice'] = $this->getValueFromTable(pq('#restaurantTable > tr > td'), "Minimum menuprijs");
		$data['houseWineBottlePrice'] = $this->getValueFromTable(pq('#restaurantTable > tr > td'), "Huiswijn per fles");
		$data['houseWineGlassPrice'] = $this->getValueFromTable(pq('#restaurantTable > tr > td'), "Huiswijn per glas");
		$data['childMenuPrice'] = $this->getValueFromTable(pq('#restaurantTable > tr > td'), "Kindermenu");
		$data['paymentOptions'] = $this->convertImages($this->getValueFromTable(pq('#restaurantTable > tr > td'), "Betalen"));
		$data['chef'] = $this->getValueFromTable(pq('#restaurantTable > tr > td'), "Chef");
		$data['maitre'] = $this->getValueFromTable(pq('#restaurantTable > tr > td'), "Maitre");
		$data['sommelier'] = $this->getValueFromTable(pq('#restaurantTable > tr > td'), "Sommelier");
		$data['facilities'] = $this->getValueFromTable(pq('#restaurantTable > tr > td'), "Faciliteiten");
		$data['parkingPossibilities'] = $this->getValueFromTable(pq('#restaurantTable > tr > td'), "Parkeren");
		$data['groupPossibilities'] = $this->getValueFromTable(pq('#restaurantTable > tr > td'), "Groepen");
		$data['privateRoomPossibilities'] = $this->getValueFromTable(pq('#restaurantTable > tr > td'), "Privé ruimte");
		$data['typeRestaurant'] = $this->getValueFromTable(pq('#restaurantTable > tr > td'), "Sfeer");
		$data['exteriorDiningOptions'] = $this->getValueFromTable(pq('#restaurantTable > tr > td'), "Buiten eten");
		$data['accessibility'] = $this->getValueFromTable(pq('#restaurantTable > tr > td'), "Toegankelijkheid");
		$data['childFeatures'] = $this->getValueFromTable(pq('#restaurantTable > tr > td'), "Kinderen");
		$lat_pattern = '/var restaurantLatitude = ([0-9{2}.[0-9]+);/';
		$lon_pattern = '/var restaurantLongitude = ([0-9{1}.[0-9]+);/';
		preg_match($lat_pattern, $result2, $matches);
		$data['lat'] = $matches[1];
		preg_match($lon_pattern, $result2, $matches);
		$data['lon'] = $matches[1];
		$data['photos'] = $this->joinHrefs(pq("a[rel='restaurantPhotos']"));

		$data['table'] = pq('#restaurantTable');
		$data['betaalOpties'] = pq('.openingHoursTableFull > tr > td');

		if($view) {
			if($json == 'true') {
				header('content-type: application/json');
				$this->load->view('rest/getRestaurantRating', $data);
			} else {
				header('content-type: application/rdf+xml');
				$this->load->view('rest/getRestaurantRatingRDF', $data);
			}
		}
		return $data;
	}

	function joinHrefs ($links) {
		$result = array();
		foreach($links as $link) {
			$result[] = pq($link)->attr('href');
		}
		//return implode(', ', $result);
		return $result;
	}

	function joinLinks ($links) {
		$result = array();
		foreach($links as $link) {
			$result[] = pq($link)->html();
		}
		return implode(', ', $result);
	}

	function convertImages ($td) {
		$result = array();
		if(substr($td, 0, 1) == '<' || substr($td, 0, 2) == "\n<") {
			foreach(pq($td)->filter('img') as $img) {
				$result[] = pq($img)->attr('alt');
			}
			return implode(', ', $result);
		}
		return $td;
	}

	function convertKitchenType ($kitchenTypes) {
		$result = array();
		foreach(pq($kitchenTypes)->filter('a') as $a) {
			$result[] = pq($a)->html();
		}
		return implode(', ', $result);
	}

	function getValueFromTable ($tds, $selector, $oddtoggle = true) {
		if($tds->length() == 0) return false;
		$returnNext = false;
		$even = true;
		foreach($tds as $td) {
			if($returnNext) {
				if(substr(pq($td)->html(), 0, 2) == '<a' || substr(pq($td)->html(), 0, 3) == "\n<a") {
					return $this->convertKitchenType(pq($td)->html());
				}
				return pq($td)->html();
			}
			if($oddtoggle) {
				if(pq($td)->html() == $selector && $even) {
					$returnNext = true;
				}
			} else if(pq($td)->html() == $selector) {
				$returnNext = true;
			}
			if($oddtoggle) {
				if(pq($td)->attr('colspan') != '2') {
					$even = !$even;
				}
			} else {
				$even = !$even;
			}
		}
		return $returnNext;
	}
}
