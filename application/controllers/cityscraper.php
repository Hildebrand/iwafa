<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require('phpQuery/phpQuery.php');

class Cityscraper extends CI_Controller {
	public function index ($startingpoint = '') {
		$data['startingpoint'] = $startingpoint != '' ? $startingpoint : 'No startingpoint given';

		// set the protocol for the api
		$prot = 'http';
		
		// set the target hostname
		$address = 'www.iens.nl';
		
		$page = 1;
		$nrPages = 1;
		while($page <= $nrPages) {
			if(strtolower($startingpoint) == 'den%20bosch') {
				$startingpoint = 'den-bosch';
			}
			if(strtolower($startingpoint) == 'den%20haag') {
				$startingpoint = 'denhaag';
			}
			if(strtolower($startingpoint) == 'valkenburg') {
				$startingpoint = 'valkenburg-li';
			}
			$url = $prot.'://'.$address.'/restaurant/'.strtolower($startingpoint)."?f=$page&";

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, $url);
			$result = curl_exec($ch);
			curl_close($ch);

			$iens_rest = phpQuery::newDocumentHTML($result);
			$restaurants = pq('h2.resultsRestaurantName > a');
		
			// determine amount of pages of restaurants to scrape (must be done only once)
			if($nrPages == 1) {
				$paginationLinks = pq('.pageInactive');
				$nrPaginationLinks = $paginationLinks->length()-2;
				$nrPagesString = pq('.pageInactive:eq('.$nrPaginationLinks.')')->attr('href');
				$pagePattern = '/\?f=([0-9]+)./';
				preg_match($pagePattern, $nrPagesString, $matches);
				$nrPages = $matches[1];
			}

			// get array of links to all detail pages of restaurants
			$links = array();
			$ids = array();
			foreach($restaurants as $restaurant) {
				$link = pq($restaurant)->attr('href');
				$links[] = $link;
				$id_pattern = '/restaurant\/([0-9]+)\/*/';
				preg_match($id_pattern, $link, $matches);
				$ids[] = $matches[1];
			}

			$i = 0;
			foreach($links as $link) {
				//if($i >= 0) break;
				$requrl = $prot.'://localhost/iwafa/rest/getrestaurantrdf/'.$ids[$i];
				echo 'Going to request: '.$requrl."<br />\n";

				// scrape restaurant to rdf/xml
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_URL, $requrl);
				$rdfxml = curl_exec($ch);
				curl_close($ch);

				$ses_url = $prot.'://localhost:8080/sesame/repositories/2/statements';
				// POST data to sesame repository
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_URL, $ses_url);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $rdfxml);
				curl_setopt($ch, CURLOPT_HTTPHEADER,array (
					"Content-Type: application/rdf+xml;charset=UTF-8"
				));
				$rdfxml = curl_exec($ch);
				curl_close($ch);

				$i++;
			}
			$page++;
		}

		$this->load->view('cityscraper/index', $data);
	}
}
