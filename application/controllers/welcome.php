<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$query = "PREFIX :<http://example.com/iwa/>
			PREFIX rdfs:<http://www.w3.org/2000/01/rdf-schema#>
			PREFIX time:<http://www.w3.org/2006/time#>
			PREFIX iwa:<http://example.com/iwa/>
			PREFIX search:<http://rdf.opensahara.com/search#>
			PREFIX osgeo:<http://rdf.opensahara.com/type/geo/>
			PREFIX dbpedia:<http://dbpedia.org/page/>
			PREFIX fs:<https://api.foursquare.com/v2/venues/>
			PREFIX spin:<http://spinrdf.org/spin#>
			PREFIX rdf:<http://www.w3.org/1999/02/22-rdf-syntax-ns#>
			PREFIX pext:<http://proton.semanticweb.org/protonext#>
			PREFIX dbpprop:<http://dbpedia.org/property/>
			PREFIX fn:<http://www.w3.org/2005/xpath-functions#>
			PREFIX bd:<http://www.bigdata.com/rdf/search#>
			PREFIX bigdata:<http://www.bigdata.com/rdf#>
			PREFIX dc:<http://purl.org/dc/terms/>
			PREFIX dbpedia-owl:<http://dbpedia.org/ontology/>
			PREFIX geo:<http://www.w3.org/2003/01/geo/wgs84_pos#>
			PREFIX foaf:<http://xmlns.com/foaf/0.1/>
			PREFIX vcard:<http://www.w3.org/2006/vcard/ns#>
			PREFIX gn:<http://www.geonames.org/ontology#>
			PREFIX psys:<http://proton.semanticweb.org/protonsys#>
			PREFIX dct:<http://purl.org/dc/terms/>
			PREFIX owl:<http://www.w3.org/2002/07/owl#>
			PREFIX xsd:<http://www.w3.org/2001/XMLSchema#>
			PREFIX gr:<http://purl.org/goodrelations/v1#>
			PREFIX ah:<http://purl.org/artsholland/1.0/>
			PREFIX dbpedia-res:<http://dbpedia.org/resource/>";
		$query .= 'SELECT * WHERE {
{	SELECT * WHERE { ?res a dbpedia-owl:Restaurant ;
				iwa:google-rating ?gr;
				dc:title ?title ;
				iwa:id ?id ;
				dbpedia-owl:location ?loc .
				?loc dbpedia-owl:address ?add ;
				geo:latitude ?lat ;
				geo:longitude ?lon.
		FILTER regex(?add, ".+, Amsterdam", "i")
		FILTER NOT EXISTS { 
			?res iwa:id ?id1;
				iwa:id ?id2.
			FILTER(?id1 != ?id2)
		}
	} LIMIT 3
} UNION {
	SELECT * WHERE { ?res a dbpedia-owl:Restaurant ;
				iwa:google-rating ?gr;
				dc:title ?title ;
				iwa:id ?id ;
				dbpedia-owl:location ?loc .
				?loc dbpedia-owl:address ?add ;
				geo:latitude ?lat ;
				geo:longitude ?lon .
		FILTER regex(?add, ".+, Zwolle", "i")
		FILTER NOT EXISTS { 
			?res iwa:id ?id1;
				iwa:id ?id2.
			FILTER(?id1 != ?id2)
		}
	} LIMIT 3
} UNION {
	SELECT * WHERE { ?res a dbpedia-owl:Restaurant ;
				iwa:google-rating ?gr;
				dc:title ?title ;
				iwa:id ?id ;
				dbpedia-owl:location ?loc .
				?loc dbpedia-owl:address ?add ;
				geo:latitude ?lat ;
				geo:longitude ?lon .
		FILTER regex(?add, ".+, Alkmaar", "i")
		FILTER NOT EXISTS { 
			?res iwa:id ?id1;
				iwa:id ?id2.
			FILTER(?id1 != ?id2)
		}
	} LIMIT 3
} UNION {
	SELECT * WHERE { ?res a dbpedia-owl:Restaurant ;
				iwa:google-rating ?gr;
				dc:title ?title ;
				iwa:id ?id ;
				dbpedia-owl:location ?loc .
				?loc dbpedia-owl:address ?add ;
				geo:latitude ?lat ;
				geo:longitude ?lon .
		FILTER regex(?add, ".+, Almere", "i")
		FILTER NOT EXISTS { 
			?res iwa:id ?id1;
				iwa:id ?id2.
			FILTER(?id1 != ?id2)
		}
	} LIMIT 3
} UNION {
	SELECT * WHERE { ?res a dbpedia-owl:Restaurant ;
				iwa:google-rating ?gr;
				dc:title ?title ;
				iwa:id ?id ;
				dbpedia-owl:location ?loc .
				?loc dbpedia-owl:address ?add ;
				geo:latitude ?lat ;
				geo:longitude ?lon .
		FILTER regex(?add, ".+, Amersfoort", "i")
		FILTER NOT EXISTS { 
			?res iwa:id ?id1;
				iwa:id ?id2.
			FILTER(?id1 != ?id2)
		}
	} LIMIT 3
} UNION {
	SELECT * WHERE { ?res a dbpedia-owl:Restaurant ;
				iwa:google-rating ?gr;
				dc:title ?title ;
				iwa:id ?id ;
				dbpedia-owl:location ?loc .
				?loc dbpedia-owl:address ?add ;
				geo:latitude ?lat ;
				geo:longitude ?lon .
		FILTER regex(?add, ".+, Apeldoorn", "i")
		FILTER NOT EXISTS { 
			?res iwa:id ?id1;
				iwa:id ?id2.
			FILTER(?id1 != ?id2)
		}
	} LIMIT 3
} UNION {
	SELECT * WHERE { ?res a dbpedia-owl:Restaurant ;
				iwa:google-rating ?gr;
				dc:title ?title ;
				iwa:id ?id ;
				dbpedia-owl:location ?loc .
				?loc dbpedia-owl:address ?add ;
				geo:latitude ?lat ;
				geo:longitude ?lon .
		FILTER regex(?add, ".+, Arnhem", "i")
		FILTER NOT EXISTS { 
			?res iwa:id ?id1;
				iwa:id ?id2.
			FILTER(?id1 != ?id2)
		}
	} LIMIT 3
} UNION {
	SELECT * WHERE { ?res a dbpedia-owl:Restaurant ;
				iwa:google-rating ?gr;
				dc:title ?title ;
				iwa:id ?id ;
				dbpedia-owl:location ?loc .
				?loc dbpedia-owl:address ?add ;
				geo:latitude ?lat ;
				geo:longitude ?lon .
		FILTER regex(?add, ".+, Breda", "i")
		FILTER NOT EXISTS { 
			?res iwa:id ?id1;
				iwa:id ?id2.
			FILTER(?id1 != ?id2)
		}
	} LIMIT 3
} UNION {
	SELECT * WHERE { ?res a dbpedia-owl:Restaurant ;
				iwa:google-rating ?gr;
				dc:title ?title ;
				iwa:id ?id ;
				dbpedia-owl:location ?loc .
				?loc dbpedia-owl:address ?add ;
				geo:latitude ?lat ;
				geo:longitude ?lon .
		FILTER regex(?add, ".+, Delft", "i")
		FILTER NOT EXISTS { 
			?res iwa:id ?id1;
				iwa:id ?id2.
			FILTER(?id1 != ?id2)
		}
	} LIMIT 3
} UNION {
	SELECT * WHERE { ?res a dbpedia-owl:Restaurant ;
				iwa:google-rating ?gr;
				dc:title ?title ;
				iwa:id ?id ;
				dbpedia-owl:location ?loc .
				?loc dbpedia-owl:address ?add ;
				geo:latitude ?lat ;
				geo:longitude ?lon .
		FILTER regex(?add, ".+, Den Bosch", "i")
		FILTER NOT EXISTS { 
			?res iwa:id ?id1;
				iwa:id ?id2.
			FILTER(?id1 != ?id2)
		}
	} LIMIT 3
} UNION {
	SELECT * WHERE { ?res a dbpedia-owl:Restaurant ;
				iwa:google-rating ?gr;
				dc:title ?title ;
				iwa:id ?id ;
				dbpedia-owl:location ?loc .
				?loc dbpedia-owl:address ?add ;
				geo:latitude ?lat ;
				geo:longitude ?lon .
		FILTER regex(?add, ".+, Den Haag", "i")
		FILTER NOT EXISTS { 
			?res iwa:id ?id1;
				iwa:id ?id2.
			FILTER(?id1 != ?id2)
		}
	} LIMIT 3
} UNION {
	SELECT * WHERE { ?res a dbpedia-owl:Restaurant ;
				iwa:google-rating ?gr;
				dc:title ?title ;
				iwa:id ?id ;
				dbpedia-owl:location ?loc .
				?loc dbpedia-owl:address ?add ;
				geo:latitude ?lat ;
				geo:longitude ?lon .
		FILTER regex(?add, ".+, Eindhoven", "i")
		FILTER NOT EXISTS { 
			?res iwa:id ?id1;
				iwa:id ?id2.
			FILTER(?id1 != ?id2)
		}
	} LIMIT 3
} UNION {
	SELECT * WHERE { ?res a dbpedia-owl:Restaurant ;
				iwa:google-rating ?gr;
				dc:title ?title ;
				iwa:id ?id ;
				dbpedia-owl:location ?loc .
				?loc dbpedia-owl:address ?add ;
				geo:latitude ?lat ;
				geo:longitude ?lon .
		FILTER regex(?add, ".+, Enschede", "i")
		FILTER NOT EXISTS { 
			?res iwa:id ?id1;
				iwa:id ?id2.
			FILTER(?id1 != ?id2)
		}
	} LIMIT 3
} UNION {
	SELECT * WHERE { ?res a dbpedia-owl:Restaurant ;
				iwa:google-rating ?gr;
				dc:title ?title ;
				iwa:id ?id ;
				dbpedia-owl:location ?loc .
				?loc dbpedia-owl:address ?add ;
				geo:latitude ?lat ;
				geo:longitude ?lon .
		FILTER regex(?add, ".+, Groningen", "i")
		FILTER NOT EXISTS { 
			?res iwa:id ?id1;
				iwa:id ?id2.
			FILTER(?id1 != ?id2)
		}
	} LIMIT 3
} UNION {
	SELECT * WHERE { ?res a dbpedia-owl:Restaurant ;
				iwa:google-rating ?gr;
				dc:title ?title ;
				iwa:id ?id ;
				dbpedia-owl:location ?loc .
				?loc dbpedia-owl:address ?add ;
				geo:latitude ?lat ;
				geo:longitude ?lon .
		FILTER regex(?add, ".+, Haarlem", "i")
		FILTER NOT EXISTS { 
			?res iwa:id ?id1;
				iwa:id ?id2.
			FILTER(?id1 != ?id2)
		}
	} LIMIT 3
} UNION {
	SELECT * WHERE { ?res a dbpedia-owl:Restaurant ;
				iwa:google-rating ?gr;
				dc:title ?title ;
				iwa:id ?id ;
				dbpedia-owl:location ?loc .
				?loc dbpedia-owl:address ?add ;
				geo:latitude ?lat ;
				geo:longitude ?lon .
		FILTER regex(?add, ".+, Leeuwarden", "i")
		FILTER NOT EXISTS { 
			?res iwa:id ?id1;
				iwa:id ?id2.
			FILTER(?id1 != ?id2)
		}
	} LIMIT 3
} UNION {
	SELECT * WHERE { ?res a dbpedia-owl:Restaurant ;
				iwa:google-rating ?gr;
				dc:title ?title ;
				iwa:id ?id ;
				dbpedia-owl:location ?loc .
				?loc dbpedia-owl:address ?add ;
				geo:latitude ?lat ;
				geo:longitude ?lon .
		FILTER regex(?add, ".+, Leiden", "i")
		FILTER NOT EXISTS { 
			?res iwa:id ?id1;
				iwa:id ?id2.
			FILTER(?id1 != ?id2)
		}
	} LIMIT 3
} UNION {
	SELECT * WHERE { ?res a dbpedia-owl:Restaurant ;
				iwa:google-rating ?gr;
				dc:title ?title ;
				iwa:id ?id ;
				dbpedia-owl:location ?loc .
				?loc dbpedia-owl:address ?add ;
				geo:latitude ?lat ;
				geo:longitude ?lon .
		FILTER regex(?add, ".+, Maastricht", "i")
		FILTER NOT EXISTS { 
			?res iwa:id ?id1;
				iwa:id ?id2.
			FILTER(?id1 != ?id2)
		}
	} LIMIT 3
} UNION {
	SELECT * WHERE { ?res a dbpedia-owl:Restaurant ;
				iwa:google-rating ?gr;
				dc:title ?title ;
				iwa:id ?id ;
				dbpedia-owl:location ?loc .
				?loc dbpedia-owl:address ?add ;
				geo:latitude ?lat ;
				geo:longitude ?lon .
		FILTER regex(?add, ".+, Nijmegen", "i")
		FILTER NOT EXISTS { 
			?res iwa:id ?id1;
				iwa:id ?id2.
			FILTER(?id1 != ?id2)
		}
	} LIMIT 3
} UNION {
	SELECT * WHERE { ?res a dbpedia-owl:Restaurant ;
				iwa:google-rating ?gr;
				dc:title ?title ;
				iwa:id ?id ;
				dbpedia-owl:location ?loc .
				?loc dbpedia-owl:address ?add ;
				geo:latitude ?lat ;
				geo:longitude ?lon .
		FILTER regex(?add, ".+, Rotterdam", "i")
		FILTER NOT EXISTS { 
			?res iwa:id ?id1;
				iwa:id ?id2.
			FILTER(?id1 != ?id2)
		}
	} LIMIT 3
} UNION {
	SELECT * WHERE { ?res a dbpedia-owl:Restaurant ;
				iwa:google-rating ?gr;
				dc:title ?title ;
				iwa:id ?id ;
				dbpedia-owl:location ?loc .
				?loc dbpedia-owl:address ?add ;
				geo:latitude ?lat ;
				geo:longitude ?lon .
		FILTER regex(?add, ".+, Scheveningen", "i")
		FILTER NOT EXISTS { 
			?res iwa:id ?id1;
				iwa:id ?id2.
			FILTER(?id1 != ?id2)
		}
	} LIMIT 3
} UNION {
	SELECT * WHERE { ?res a dbpedia-owl:Restaurant ;
				iwa:google-rating ?gr;
				dc:title ?title ;
				iwa:id ?id ;
				dbpedia-owl:location ?loc .
				?loc dbpedia-owl:address ?add ;
				geo:latitude ?lat ;
				geo:longitude ?lon .
		FILTER regex(?add, ".+, Tilburg", "i")
		FILTER NOT EXISTS { 
			?res iwa:id ?id1;
				iwa:id ?id2.
			FILTER(?id1 != ?id2)
		}
	} LIMIT 3
} UNION {
	SELECT * WHERE { ?res a dbpedia-owl:Restaurant ;
				iwa:google-rating ?gr;
				dc:title ?title ;
				iwa:id ?id ;
				dbpedia-owl:location ?loc .
				?loc dbpedia-owl:address ?add ;
				geo:latitude ?lat ;
				geo:longitude ?lon .
		FILTER regex(?add, ".+, Utrecht", "i")
		FILTER NOT EXISTS { 
			?res iwa:id ?id1;
				iwa:id ?id2.
			FILTER(?id1 != ?id2)
		}
	} LIMIT 3
} UNION {
	SELECT * WHERE { ?res a dbpedia-owl:Restaurant ;
				iwa:google-rating ?gr;
				dc:title ?title ;
				iwa:id ?id ;
				dbpedia-owl:location ?loc .
				?loc dbpedia-owl:address ?add ;
				geo:latitude ?lat ;
				geo:longitude ?lon .
		FILTER regex(?add, ".+, Valkenburg \\\\(li\\\\)", "i")
		FILTER NOT EXISTS { 
			?res iwa:id ?id1;
				iwa:id ?id2.
			FILTER(?id1 != ?id2)
		}
	} LIMIT 3
}}';
		/* $prot = 'http';
		$req_url = $prot.'://localhost:8080/sesame/repositories/2';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $req_url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'query='.rawurlencode($query));
		curl_setopt($ch, CURLOPT_HTTPHEADER,array (
			"Accept: application/sparql-results+json"
		));
		$result = curl_exec($ch);
		curl_close($ch);

		$data['query'] = $query;
		$data['result'] = $result;*/

		// FOR PERFORMANCE: HARDCODE INITIAL RESTAURANTS
		$data['result'] = '{
	"head": {
		"vars": [ "res", "gr", "title", "id", "loc", "add", "lat", "lon", "id1", "id2" ]
	}, 
	"results": {
		"bindings": [
			{
				"id": { "type": "literal", "value": "6466" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/6466" }, 
				"lon": { "type": "literal", "value": "4.925841" }, 
				"title": { "type": "literal", "value": "Warung Sranang Makmur" }, 
				"loc": { "type": "bnode", "value": "node25485" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.9" }, 
				"add": { "type": "literal", "value": "Wijttenbachstraat 14, Amsterdam" }, 
				"lat": { "type": "literal", "value": "52.360081" }
			}, 
			{
				"id": { "type": "literal", "value": "568" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/568" }, 
				"lon": { "type": "literal", "value": "4.914066" }, 
				"title": { "type": "literal", "value": "San Remo" }, 
				"loc": { "type": "bnode", "value": "node25289" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "5.0" }, 
				"add": { "type": "literal", "value": "Mosveld 74, Amsterdam" }, 
				"lat": { "type": "literal", "value": "52.391792" }
			}, 
			{
				"id": { "type": "literal", "value": "27400" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/27400" }, 
				"lon": { "type": "literal", "value": "4.891525" }, 
				"title": { "type": "literal", "value": "Los Amigos" }, 
				"loc": { "type": "bnode", "value": "node25035" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "2.8" }, 
				"add": { "type": "literal", "value": "Reguliersdwarsstraat 57, Amsterdam" }, 
				"lat": { "type": "literal", "value": "52.366314" }
			}, 
			{
				"id": { "type": "literal", "value": "22513" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/22513" }, 
				"lon": { "type": "literal", "value": "6.080084" }, 
				"title": { "type": "literal", "value": "Hotel Fidder" }, 
				"loc": { "type": "bnode", "value": "node33070" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.8" }, 
				"add": { "type": "literal", "value": "Kon. wilhelminastraat 6, Zwolle" }, 
				"lat": { "type": "literal", "value": "52.507519" }
			}, 
			{
				"id": { "type": "literal", "value": "26699" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/26699" }, 
				"lon": { "type": "literal", "value": "6.089605" }, 
				"title": { "type": "literal", "value": "Las Rosas" }, 
				"loc": { "type": "bnode", "value": "node33022" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.8" }, 
				"add": { "type": "literal", "value": "Rodetorenplein 10, Zwolle" }, 
				"lat": { "type": "literal", "value": "52.513275" }
			}, 
			{
				"id": { "type": "literal", "value": "23541" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/23541" }, 
				"lon": { "type": "literal", "value": "6.095171" }, 
				"title": { "type": "literal", "value": "Croissanterie Pigalle" }, 
				"loc": { "type": "bnode", "value": "node33000" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.6" }, 
				"add": { "type": "literal", "value": "Gasthuisstraat 4, Zwolle" }, 
				"lat": { "type": "literal", "value": "52.512276" }
			}, 
			{
				"id": { "type": "literal", "value": "17109" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/17109" }, 
				"lon": { "type": "literal", "value": "4.750015" }, 
				"title": { "type": "literal", "value": "La Cubanita Alkmaar" }, 
				"loc": { "type": "bnode", "value": "node21570" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.1" }, 
				"add": { "type": "literal", "value": "Mient 22, Alkmaar" }, 
				"lat": { "type": "literal", "value": "52.630672" }
			}, 
			{
				"id": { "type": "literal", "value": "26804" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/26804" }, 
				"lon": { "type": "literal", "value": "4.747945" }, 
				"title": { "type": "literal", "value": "Grand Cafée Kleine Waarheid" }, 
				"loc": { "type": "bnode", "value": "node21560" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "4.8" }, 
				"add": { "type": "literal", "value": "Lombardsteeg 7, Alkmaar" }, 
				"lat": { "type": "literal", "value": "52.632912" }
			}, 
			{
				"id": { "type": "literal", "value": "7294" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/7294" }, 
				"lon": { "type": "literal", "value": "4.750886" }, 
				"title": { "type": "literal", "value": "Het Eetpaleis" }, 
				"loc": { "type": "bnode", "value": "node21545" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.8" }, 
				"add": { "type": "literal", "value": "Verdronkenoord 102, Alkmaar" }, 
				"lat": { "type": "literal", "value": "52.629726" }
			}, 
			{
				"id": { "type": "literal", "value": "31497" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/31497" }, 
				"lon": { "type": "literal", "value": "5.231701" }, 
				"title": { "type": "literal", "value": "Jan\'s River" }, 
				"loc": { "type": "bnode", "value": "node21755" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "4.2" }, 
				"add": { "type": "literal", "value": "Botplein 12, Almere" }, 
				"lat": { "type": "literal", "value": "52.388733" }
			}, 
			{
				"id": { "type": "literal", "value": "7362" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/7362" }, 
				"lon": { "type": "literal", "value": "5.218401" }, 
				"title": { "type": "literal", "value": "Steakhouse Wild West" }, 
				"loc": { "type": "bnode", "value": "node21743" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.5" }, 
				"add": { "type": "literal", "value": "Havenzicht 14, Almere" }, 
				"lat": { "type": "literal", "value": "52.333923" }
			}, 
			{
				"id": { "type": "literal", "value": "7077" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/7077" }, 
				"lon": { "type": "literal", "value": "5.219470" }, 
				"title": { "type": "literal", "value": "Krab aan de Haven" }, 
				"loc": { "type": "bnode", "value": "node21704" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "4.8" }, 
				"add": { "type": "literal", "value": "Sluiskade 16, Almere" }, 
				"lat": { "type": "literal", "value": "52.333961" }
			}, 
			{
				"id": { "type": "literal", "value": "4589" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/4589" }, 
				"lon": { "type": "literal", "value": "5.265641" }, 
				"title": { "type": "literal", "value": "La Montagne" }, 
				"loc": { "type": "bnode", "value": "node25708" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "4.0" }, 
				"add": { "type": "literal", "value": "Utrechtseweg 76, Amersfoort" }, 
				"lat": { "type": "literal", "value": "52.159290" }
			}, 
			{
				"id": { "type": "literal", "value": "7510" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/7510" }, 
				"lon": { "type": "literal", "value": "5.423077" }, 
				"title": { "type": "literal", "value": "De Tweede Steeg" }, 
				"loc": { "type": "bnode", "value": "node25686" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "4.3" }, 
				"add": { "type": "literal", "value": "Hogeweg 227, Amersfoort" }, 
				"lat": { "type": "literal", "value": "52.162121" }
			}, 
			{
				"id": { "type": "literal", "value": "5389" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/5389" }, 
				"lon": { "type": "literal", "value": "5.393301" }, 
				"title": { "type": "literal", "value": "De Monnikendam" }, 
				"loc": { "type": "bnode", "value": "node25684" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.6" }, 
				"add": { "type": "literal", "value": "Plantsoen-Oost 2, Amersfoort" }, 
				"lat": { "type": "literal", "value": "52.154163" }
			}, 
			{
				"id": { "type": "literal", "value": "18327" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/18327" }, 
				"lon": { "type": "literal", "value": "5.962999" }, 
				"title": { "type": "literal", "value": "Wokcentre" }, 
				"loc": { "type": "bnode", "value": "node25865" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.1" }, 
				"add": { "type": "literal", "value": "Brinklaan 32, Apeldoorn" }, 
				"lat": { "type": "literal", "value": "52.212364" }
			}, 
			{
				"id": { "type": "literal", "value": "33643" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/33643" }, 
				"lon": { "type": "literal", "value": "5.965318" }, 
				"title": { "type": "literal", "value": "Pizzeria Italia" }, 
				"loc": { "type": "bnode", "value": "node25850" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.8" }, 
				"add": { "type": "literal", "value": "Hofveld 4, Apeldoorn" }, 
				"lat": { "type": "literal", "value": "52.198162" }
			}, 
			{
				"id": { "type": "literal", "value": "31508" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/31508" }, 
				"lon": { "type": "literal", "value": "5.962635" }, 
				"title": { "type": "literal", "value": "Hotel et le Cafe de Paris" }, 
				"loc": { "type": "bnode", "value": "node25825" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.7" }, 
				"add": { "type": "literal", "value": "Raadhuisplein 5, Apeldoorn" }, 
				"lat": { "type": "literal", "value": "52.215050" }
			}, 
			{
				"id": { "type": "literal", "value": "9780" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/9780" }, 
				"lon": { "type": "literal", "value": "5.934317" }, 
				"title": { "type": "literal", "value": "Hong Sing" }, 
				"loc": { "type": "bnode", "value": "node26102" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "4.0" }, 
				"add": { "type": "literal", "value": "Sperwerstraat 67, Arnhem" }, 
				"lat": { "type": "literal", "value": "52.003300" }
			}, 
			{
				"id": { "type": "literal", "value": "9772" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/9772" }, 
				"lon": { "type": "literal", "value": "5.859280" }, 
				"title": { "type": "literal", "value": "Fong Sho" }, 
				"loc": { "type": "bnode", "value": "node26093" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.6" }, 
				"add": { "type": "literal", "value": "Elderveldplein 23-27, Arnhem" }, 
				"lat": { "type": "literal", "value": "51.961048" }
			}, 
			{
				"id": { "type": "literal", "value": "21757" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/21757" }, 
				"lon": { "type": "literal", "value": "5.865323" }, 
				"title": { "type": "literal", "value": "Atlantis" }, 
				"loc": { "type": "bnode", "value": "node26053" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.3" }, 
				"add": { "type": "literal", "value": "Hollandweg 6-8, Arnhem" }, 
				"lat": { "type": "literal", "value": "51.962685" }
			}, 
			{
				"id": { "type": "literal", "value": "17400" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/17400" }, 
				"lon": { "type": "literal", "value": "4.781236" }, 
				"title": { "type": "literal", "value": "De Beyerd" }, 
				"loc": { "type": "bnode", "value": "node26326" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "4.6" }, 
				"add": { "type": "literal", "value": "Pasbaan 1, Breda" }, 
				"lat": { "type": "literal", "value": "51.589725" }
			}, 
			{
				"id": { "type": "literal", "value": "18105" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/18105" }, 
				"lon": { "type": "literal", "value": "4.773585" }, 
				"title": { "type": "literal", "value": "Brooklyn" }, 
				"loc": { "type": "bnode", "value": "node26317" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "4.8" }, 
				"add": { "type": "literal", "value": "Havermarkt 21, Breda" }, 
				"lat": { "type": "literal", "value": "51.589153" }
			}, 
			{
				"id": { "type": "literal", "value": "16910" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/16910" }, 
				"lon": { "type": "literal", "value": "4.776088" }, 
				"title": { "type": "literal", "value": "Dickens & Jones" }, 
				"loc": { "type": "bnode", "value": "node26301" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "2.3" }, 
				"add": { "type": "literal", "value": "Grote Markt 40-42, Breda" }, 
				"lat": { "type": "literal", "value": "51.588879" }
			}, 
			{
				"id": { "type": "literal", "value": "3933" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/3933" }, 
				"lon": { "type": "literal", "value": "4.357437" }, 
				"title": { "type": "literal", "value": "De Wijnhaven" }, 
				"loc": { "type": "bnode", "value": "node26586" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.9" }, 
				"add": { "type": "literal", "value": "Wijnhaven 22, Delft" }, 
				"lat": { "type": "literal", "value": "52.011501" }
			}, 
			{
				"id": { "type": "literal", "value": "2900" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/2900" }, 
				"lon": { "type": "literal", "value": "4.362729" }, 
				"title": { "type": "literal", "value": "Billy Beer" }, 
				"loc": { "type": "bnode", "value": "node26580" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.5" }, 
				"add": { "type": "literal", "value": "Beestenmarkt 26, Delft" }, 
				"lat": { "type": "literal", "value": "52.011757" }
			}, 
			{
				"id": { "type": "literal", "value": "3641" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/3641" }, 
				"lon": { "type": "literal", "value": "4.359643" }, 
				"title": { "type": "literal", "value": "De Kurk" }, 
				"loc": { "type": "bnode", "value": "node26473" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.4" }, 
				"add": { "type": "literal", "value": "Kromstraat 20, Delft" }, 
				"lat": { "type": "literal", "value": "52.010777" }
			}, 
			{
				"id": { "type": "literal", "value": "8103" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/8103" }, 
				"lon": { "type": "literal", "value": "5.306870" }, 
				"title": { "type": "literal", "value": "Cantina San Juan" }, 
				"loc": { "type": "bnode", "value": "node26736" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "4.3" }, 
				"add": { "type": "literal", "value": "Kerkstraat 54, Den Bosch" }, 
				"lat": { "type": "literal", "value": "51.687939" }
			}, 
			{
				"id": { "type": "literal", "value": "8123" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/8123" }, 
				"lon": { "type": "literal", "value": "5.316340" }, 
				"title": { "type": "literal", "value": "Lai Thai" }, 
				"loc": { "type": "bnode", "value": "node26731" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "4.5" }, 
				"add": { "type": "literal", "value": "Muntelstraat 12, Den Bosch" }, 
				"lat": { "type": "literal", "value": "51.690662" }
			}, 
			{
				"id": { "type": "literal", "value": "8104" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/8104" }, 
				"lon": { "type": "literal", "value": "5.307476" }, 
				"title": { "type": "literal", "value": "Pilkington\'s" }, 
				"loc": { "type": "bnode", "value": "node26729" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "2.8" }, 
				"add": { "type": "literal", "value": "Torenstraat 5, Den Bosch" }, 
				"lat": { "type": "literal", "value": "51.688488" }
			}, 
			{
				"id": { "type": "literal", "value": "2994" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/2994" }, 
				"lon": { "type": "literal", "value": "4.324733" }, 
				"title": { "type": "literal", "value": "The Clipper" }, 
				"loc": { "type": "bnode", "value": "node28014" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "4.0" }, 
				"add": { "type": "literal", "value": "Willem Royaardsplein 8, Den Haag" }, 
				"lat": { "type": "literal", "value": "52.104885" }
			}, 
			{
				"id": { "type": "literal", "value": "30988" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/30988" }, 
				"lon": { "type": "literal", "value": "4.272923" }, 
				"title": { "type": "literal", "value": "Roti Palace James" }, 
				"loc": { "type": "bnode", "value": "node27971" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "4.1" }, 
				"add": { "type": "literal", "value": "fahrenheitstraat 354, Den Haag" }, 
				"lat": { "type": "literal", "value": "52.074829" }
			}, 
			{
				"id": { "type": "literal", "value": "32375" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/32375" }, 
				"lon": { "type": "literal", "value": "4.284607" }, 
				"title": { "type": "literal", "value": "Man\'s Garden" }, 
				"loc": { "type": "bnode", "value": "node27905" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "2.7" }, 
				"add": { "type": "literal", "value": "Laan van Wateringseveld 70, Den Haag" }, 
				"lat": { "type": "literal", "value": "52.034203" }
			}, 
			{
				"id": { "type": "literal", "value": "10335" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/10335" }, 
				"lon": { "type": "literal", "value": "5.447883" }, 
				"title": { "type": "literal", "value": "La Palmera" }, 
				"loc": { "type": "bnode", "value": "node28230" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "4.5" }, 
				"add": { "type": "literal", "value": "Plaggenstraat 36, Eindhoven" }, 
				"lat": { "type": "literal", "value": "51.447758" }
			}, 
			{
				"id": { "type": "literal", "value": "16966" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/16966" }, 
				"lon": { "type": "literal", "value": "5.472912" }, 
				"title": { "type": "literal", "value": "Juffrouw Tok" }, 
				"loc": { "type": "bnode", "value": "node28229" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "2.1" }, 
				"add": { "type": "literal", "value": "Edenstraat 5, Eindhoven" }, 
				"lat": { "type": "literal", "value": "51.434559" }
			}, 
			{
				"id": { "type": "literal", "value": "14903" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/14903" }, 
				"lon": { "type": "literal", "value": "5.481033" }, 
				"title": { "type": "literal", "value": "Tapasbar Que Pasa" }, 
				"loc": { "type": "bnode", "value": "node28222" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.3" }, 
				"add": { "type": "literal", "value": "Dommelstraat 19, Eindhoven" }, 
				"lat": { "type": "literal", "value": "51.441036" }
			}, 
			{
				"id": { "type": "literal", "value": "21476" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/21476" }, 
				"lon": { "type": "literal", "value": "6.893309" }, 
				"title": { "type": "literal", "value": "The Saloon" }, 
				"loc": { "type": "bnode", "value": "node28523" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.7" }, 
				"add": { "type": "literal", "value": "Walstraat 63, Enschede" }, 
				"lat": { "type": "literal", "value": "52.220978" }
			}, 
			{
				"id": { "type": "literal", "value": "10512" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/10512" }, 
				"lon": { "type": "literal", "value": "6.891957" }, 
				"title": { "type": "literal", "value": "Joop\'s Broodjes" }, 
				"loc": { "type": "bnode", "value": "node28494" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.5" }, 
				"add": { "type": "literal", "value": "Deurningerstraat 57, Enschede" }, 
				"lat": { "type": "literal", "value": "52.223499" }
			}, 
			{
				"id": { "type": "literal", "value": "31810" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/31810" }, 
				"lon": { "type": "literal", "value": "6.900162" }, 
				"title": { "type": "literal", "value": "Bistro \'t Anker" }, 
				"loc": { "type": "bnode", "value": "node28457" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.0" }, 
				"add": { "type": "literal", "value": "Oldenzaalsestraat 175, Enschede" }, 
				"lat": { "type": "literal", "value": "52.228645" }
			}, 
			{
				"id": { "type": "literal", "value": "10948" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/10948" }, 
				"lon": { "type": "literal", "value": "6.552018" }, 
				"title": { "type": "literal", "value": "Piccola Roma" }, 
				"loc": { "type": "bnode", "value": "node28931" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.0" }, 
				"add": { "type": "literal", "value": "Kraneweg 38, Groningen" }, 
				"lat": { "type": "literal", "value": "53.217529" }
			}, 
			{
				"id": { "type": "literal", "value": "21482" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/21482" }, 
				"lon": { "type": "literal", "value": "6.564285" }, 
				"title": { "type": "literal", "value": "Het Heerenhuis" }, 
				"loc": { "type": "bnode", "value": "node28899" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "4.2" }, 
				"add": { "type": "literal", "value": "Spilsluizen 9, Groningen" }, 
				"lat": { "type": "literal", "value": "53.221939" }
			}, 
			{
				"id": { "type": "literal", "value": "28261" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/28261" }, 
				"lon": { "type": "literal", "value": "6.568909" }, 
				"title": { "type": "literal", "value": "Friends" }, 
				"loc": { "type": "bnode", "value": "node28891" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.7" }, 
				"add": { "type": "literal", "value": "Gelkingestraat 50, Groningen" }, 
				"lat": { "type": "literal", "value": "53.216774" }
			}, 
			{
				"id": { "type": "literal", "value": "11145" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/11145" }, 
				"lon": { "type": "literal", "value": "4.639516" }, 
				"title": { "type": "literal", "value": "Taverne De Waag" }, 
				"loc": { "type": "bnode", "value": "node29298" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "4.3" }, 
				"add": { "type": "literal", "value": "Damstraat 29, Haarlem" }, 
				"lat": { "type": "literal", "value": "52.380062" }
			}, 
			{
				"id": { "type": "literal", "value": "6039" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/6039" }, 
				"lon": { "type": "literal", "value": "4.633065" }, 
				"title": { "type": "literal", "value": "De Ark" }, 
				"loc": { "type": "bnode", "value": "node29221" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.6" }, 
				"add": { "type": "literal", "value": "Nieuw Heiligland 3, Haarlem" }, 
				"lat": { "type": "literal", "value": "52.377159" }
			}, 
			{
				"id": { "type": "literal", "value": "29736" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/29736" }, 
				"lon": { "type": "literal", "value": "4.629787" }, 
				"title": { "type": "literal", "value": "Jopenkerk" }, 
				"loc": { "type": "bnode", "value": "node29212" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "4.4" }, 
				"add": { "type": "literal", "value": "Gedempte Voldersgracht 2, Haarlem" }, 
				"lat": { "type": "literal", "value": "52.380585" }
			}, 
			{
				"id": { "type": "literal", "value": "15677" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/15677" }, 
				"lon": { "type": "literal", "value": "5.828938" }, 
				"title": { "type": "literal", "value": "Long Sing" }, 
				"loc": { "type": "bnode", "value": "node29414" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.3" }, 
				"add": { "type": "literal", "value": "Salomonszegel 1, Leeuwarden" }, 
				"lat": { "type": "literal", "value": "53.188229" }
			}, 
			{
				"id": { "type": "literal", "value": "15655" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/15655" }, 
				"lon": { "type": "literal", "value": "5.799021" }, 
				"title": { "type": "literal", "value": "Las Tapas" }, 
				"loc": { "type": "bnode", "value": "node29376" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "4.4" }, 
				"add": { "type": "literal", "value": "Oude Oosterstraat 7, Leeuwarden" }, 
				"lat": { "type": "literal", "value": "53.200859" }
			}, 
			{
				"id": { "type": "literal", "value": "16631" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/16631" }, 
				"lon": { "type": "literal", "value": "5.797101" }, 
				"title": { "type": "literal", "value": "De Lachende Koe" }, 
				"loc": { "type": "bnode", "value": "node29374" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.9" }, 
				"add": { "type": "literal", "value": "Grote Hoogstraat 20, Leeuwarden" }, 
				"lat": { "type": "literal", "value": "53.202320" }
			}, 
			{
				"id": { "type": "literal", "value": "5465" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/5465" }, 
				"lon": { "type": "literal", "value": "4.484534" }, 
				"title": { "type": "literal", "value": "De Griek" }, 
				"loc": { "type": "bnode", "value": "node29647" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.8" }, 
				"add": { "type": "literal", "value": "Steenstraat 21, Leiden" }, 
				"lat": { "type": "literal", "value": "52.162968" }
			}, 
			{
				"id": { "type": "literal", "value": "21563" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/21563" }, 
				"lon": { "type": "literal", "value": "4.491373" }, 
				"title": { "type": "literal", "value": "Dende" }, 
				"loc": { "type": "bnode", "value": "node29626" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.8" }, 
				"add": { "type": "literal", "value": "Nieuwe Rijn 5, Leiden" }, 
				"lat": { "type": "literal", "value": "52.159050" }
			}, 
			{
				"id": { "type": "literal", "value": "15707" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/15707" }, 
				"lon": { "type": "literal", "value": "4.483984" }, 
				"title": { "type": "literal", "value": "Tapadero" }, 
				"loc": { "type": "bnode", "value": "node29623" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.6" }, 
				"add": { "type": "literal", "value": "Stationsweg 30, Leiden" }, 
				"lat": { "type": "literal", "value": "52.164963" }
			}, 
			{
				"id": { "type": "literal", "value": "6890" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/6890" }, 
				"lon": { "type": "literal", "value": "5.711656" }, 
				"title": { "type": "literal", "value": "New China Garden" }, 
				"loc": { "type": "bnode", "value": "node30095" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "4.5" }, 
				"add": { "type": "literal", "value": "Meerssenerweg 59a, Maastricht" }, 
				"lat": { "type": "literal", "value": "50.862217" }
			}, 
			{
				"id": { "type": "literal", "value": "6454" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/6454" }, 
				"lon": { "type": "literal", "value": "5.674390" }, 
				"title": { "type": "literal", "value": "Café900" }, 
				"loc": { "type": "bnode", "value": "node29943" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "4.5" }, 
				"add": { "type": "literal", "value": "Orleansplein 14b, Maastricht" }, 
				"lat": { "type": "literal", "value": "50.850796" }
			}, 
			{
				"id": { "type": "literal", "value": "24776" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/24776" }, 
				"lon": { "type": "literal", "value": "5.687614" }, 
				"title": { "type": "literal", "value": "Kiwi" }, 
				"loc": { "type": "bnode", "value": "node29935" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "4.0" }, 
				"add": { "type": "literal", "value": "Ezelmarkt 15, Maastricht" }, 
				"lat": { "type": "literal", "value": "50.845951" }
			}, 
			{
				"id": { "type": "literal", "value": "12239" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/12239" }, 
				"lon": { "type": "literal", "value": "5.860752" }, 
				"title": { "type": "literal", "value": "Romagna" }, 
				"loc": { "type": "bnode", "value": "node30417" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.8" }, 
				"add": { "type": "literal", "value": "In de Betouwstraat 6, Nijmegen" }, 
				"lat": { "type": "literal", "value": "51.843338" }
			}, 
			{
				"id": { "type": "literal", "value": "12178" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/12178" }, 
				"lon": { "type": "literal", "value": "5.807559" }, 
				"title": { "type": "literal", "value": "Landhuis De Duckenburg" }, 
				"loc": { "type": "bnode", "value": "node30386" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.7" }, 
				"add": { "type": "literal", "value": "Lankforst 51-01, Nijmegen" }, 
				"lat": { "type": "literal", "value": "51.813374" }
			}, 
			{
				"id": { "type": "literal", "value": "20422" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/20422" }, 
				"lon": { "type": "literal", "value": "5.862461" }, 
				"title": { "type": "literal", "value": "De Dromaai" }, 
				"loc": { "type": "bnode", "value": "node30353" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "4.0" }, 
				"add": { "type": "literal", "value": "Plein 1944 25, Nijmegen" }, 
				"lat": { "type": "literal", "value": "51.845715" }
			}, 
			{
				"id": { "type": "literal", "value": "1891" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/1891" }, 
				"lon": { "type": "literal", "value": "4.474552" }, 
				"title": { "type": "literal", "value": "Pegasus" }, 
				"loc": { "type": "bnode", "value": "node31575" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "4.7" }, 
				"add": { "type": "literal", "value": "Wolphaertsbocht 138, Rotterdam" }, 
				"lat": { "type": "literal", "value": "51.890907" }
			}, 
			{
				"id": { "type": "literal", "value": "16771" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/16771" }, 
				"lon": { "type": "literal", "value": "4.482506" }, 
				"title": { "type": "literal", "value": "Maritime Hotel" }, 
				"loc": { "type": "bnode", "value": "node31534" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.2" }, 
				"add": { "type": "literal", "value": "Willemskade 13, Rotterdam" }, 
				"lat": { "type": "literal", "value": "51.909428" }
			}, 
			{
				"id": { "type": "literal", "value": "20687" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/20687" }, 
				"lon": { "type": "literal", "value": "4.481446" }, 
				"title": { "type": "literal", "value": "Ciné" }, 
				"loc": { "type": "bnode", "value": "node31376" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.8" }, 
				"add": { "type": "literal", "value": "Rodezand 36, Rotterdam" }, 
				"lat": { "type": "literal", "value": "51.921280" }
			}, 
			{
				"id": { "type": "literal", "value": "2998" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/2998" }, 
				"lon": { "type": "literal", "value": "4.282365" }, 
				"title": { "type": "literal", "value": "Columbus" }, 
				"loc": { "type": "bnode", "value": "node31838" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "2.9" }, 
				"add": { "type": "literal", "value": "Strandweg 47, Scheveningen" }, 
				"lat": { "type": "literal", "value": "52.114376" }
			}, 
			{
				"id": { "type": "literal", "value": "3810" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/3810" }, 
				"lon": { "type": "literal", "value": "4.285437" }, 
				"title": { "type": "literal", "value": "De Mollige Haan" }, 
				"loc": { "type": "bnode", "value": "node31836" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "1.8" }, 
				"add": { "type": "literal", "value": "Strandweg 137, Scheveningen" }, 
				"lat": { "type": "literal", "value": "52.116318" }
			}, 
			{
				"id": { "type": "literal", "value": "6819" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/6819" }, 
				"lon": { "type": "literal", "value": "4.273730" }, 
				"title": { "type": "literal", "value": "De Maatschappij" }, 
				"loc": { "type": "bnode", "value": "node31781" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "4.5" }, 
				"add": { "type": "literal", "value": "Keizerstraat 67, Scheveningen" }, 
				"lat": { "type": "literal", "value": "52.106079" }
			}, 
			{
				"id": { "type": "literal", "value": "8597" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/8597" }, 
				"lon": { "type": "literal", "value": "5.092497" }, 
				"title": { "type": "literal", "value": "Osaka" }, 
				"loc": { "type": "bnode", "value": "node32087" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "4.0" }, 
				"add": { "type": "literal", "value": "Ns Plein 38, Tilburg" }, 
				"lat": { "type": "literal", "value": "51.561646" }
			}, 
			{
				"id": { "type": "literal", "value": "8650" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/8650" }, 
				"lon": { "type": "literal", "value": "5.091575" }, 
				"title": { "type": "literal", "value": "L\'Orangerie" }, 
				"loc": { "type": "bnode", "value": "node32059" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "4.3" }, 
				"add": { "type": "literal", "value": "Heuvel 39, Tilburg" }, 
				"lat": { "type": "literal", "value": "51.557255" }
			}, 
			{
				"id": { "type": "literal", "value": "21640" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/21640" }, 
				"lon": { "type": "literal", "value": "5.090010" }, 
				"title": { "type": "literal", "value": "Cafe Karel" }, 
				"loc": { "type": "bnode", "value": "node32017" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.4" }, 
				"add": { "type": "literal", "value": "Heuvel 24, Tilburg" }, 
				"lat": { "type": "literal", "value": "51.557419" }
			}, 
			{
				"id": { "type": "literal", "value": "2983" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/2983" }, 
				"lon": { "type": "literal", "value": "5.118387" }, 
				"title": { "type": "literal", "value": "Winkel van Sinkel" }, 
				"loc": { "type": "bnode", "value": "node32655" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.0" }, 
				"add": { "type": "literal", "value": "Oudegracht 158, Utrecht" }, 
				"lat": { "type": "literal", "value": "52.091782" }
			}, 
			{
				"id": { "type": "literal", "value": "3060" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/3060" }, 
				"lon": { "type": "literal", "value": "5.117441" }, 
				"title": { "type": "literal", "value": "Toque Toque" }, 
				"loc": { "type": "bnode", "value": "node32639" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.2" }, 
				"add": { "type": "literal", "value": "Oudegracht 138, Utrecht" }, 
				"lat": { "type": "literal", "value": "52.091858" }
			}, 
			{
				"id": { "type": "literal", "value": "3479" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/3479" }, 
				"lon": { "type": "literal", "value": "5.117043" }, 
				"title": { "type": "literal", "value": "Den Draeck" }, 
				"loc": { "type": "bnode", "value": "node32634" }, 
				"gr": { "type": "typed-literal", "datatype": "http:\/\/www.w3.org\/2001\/XMLSchema#float", "value": "3.4" }, 
				"add": { "type": "literal", "value": "Oudegracht a\/d Werf 114, Utrecht" }, 
				"lat": { "type": "literal", "value": "52.092251" }
			}, 
			{
				"id": { "type": "literal", "value": "7014" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/7014" }, 
				"title": { "type": "literal", "value": "Wilhelminatoren" }, 
				"lon": { "type": "literal", "value": "5.830110" }, 
				"loc": { "type": "bnode", "value": "node32915" }, 
				"add": { "type": "literal", "value": "Heunsbergerweg 9, Valkenburg (li)" }, 
				"lat": { "type": "literal", "value": "50.858654" }
			}, 
			{
				"id": { "type": "literal", "value": "27279" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/27279" }, 
				"title": { "type": "literal", "value": "Valkenburg (Fletcher Hotel-Restaurant)" }, 
				"lon": { "type": "literal", "value": "5.823072" }, 
				"loc": { "type": "bnode", "value": "node32914" }, 
				"add": { "type": "literal", "value": "Bosstraat 2-6, Valkenburg (li)" }, 
				"lat": { "type": "literal", "value": "50.871197" }
			}, 
			{
				"id": { "type": "literal", "value": "25181" }, 
				"res": { "type": "uri", "value": "http:\/\/www.iens.nl\/restaurant\/25181" }, 
				"title": { "type": "literal", "value": "Sunndays" }, 
				"lon": { "type": "literal", "value": "5.831439" }, 
				"loc": { "type": "bnode", "value": "node32913" }, 
				"add": { "type": "literal", "value": "Berkelstraat 21, Valkenburg (li)" }, 
				"lat": { "type": "literal", "value": "50.862747" }
			}
		]
	}
}';

		$this->load->view('header');
		$this->load->view('welcome_message', $data);
		$this->load->view('footer');
	}
}
