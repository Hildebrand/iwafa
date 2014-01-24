<div class="row">
	<div class="span12">
		<h1>Documentation</h1>
		<p>This webapp offers several endpoints which you can query for data, for a starter there's the iens.nl endpoint which allows you to request information about a specific restaurant. The REST endpoint is <code>http://www.pwnshop.nl/iwafa/rest/getrestaurant</code></p>
	
		<h3>REST</h3>	
		<p>You can get the first search result back from iens in JSON format by querying for the name, separated by a comma + space with the city name:</p>

		<div class="well well-small">
			http://pwnshop.nl/iwafa/rest/getrestaurant/restaurant%20greetje%2c%20amsterdam
		</div>

		<p>The endpoint allows one to get a restaurant by its id too. This means the scraper does not need to resolve the name to an id by hitting the iens search engine and thus better performance. The downside is that it still needs to requests the headers for this url as to get to the details page (which requires a more canonical url postpended with the 'kenmerken' string).</p>

		<div class="well well-small">
			http://pwnshop.nl/iwafa/rest/getrestaurant/20732
		</div>
		
		<h3>RDF+XML</h3>
		<p>Both types of queries can also be requested in RDF/XML format by changing the url a little:</p>
		
		<div class="well well-small">
			http://pwnshop.nl/iwafa/rest/getrestaurantrdf/20732<br />
			http://pwnshop.nl/iwafa/rest/getrestaurantrdf/restaurant%20greetje%2c%20amsterdam
		</div>

		<h3>Cityscraper</h3>
		<p>As to automate the scraping of all restaurants in a city, there's the cityscraper. It takes the name of a city as argument and then scrapes all restaurants to an RDF store. As it needs some adjustments regarding the URL endpoints of your RDF store it should be run locally. It returns raw text with all the url endpoints of the restaurants it has scraped.<br /><br />
		<span class="label label-warning">Warning!</span> Execution times can reach up to 30 minutes for a big city such as Amsterdam with 2200 restaurants</p>

		<div class="well well-small">
			http://pwnshop.nl/iwafa/cityscraper/Amsterdam
		</div>
	</div>
</div>

<script src="<?= $this->config->base_url() ?>javascript/documentation.js"></script>
