<div class="row">
	<div class="span12">
		<div class="alert alert-warning">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<span class="content"></span>
		</div>
		<div class="alert alert-error">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<span class="content"></span>
		</div>
	</div>
	<div class="span4">
		<div class="input-prepend">
			<span class="add-on">Location</span>
			<input type="text" class="input-medium posContainer" placeholder="retrieving...">
		</div>
		<a href="" onClick="getLocation(event)" class="btn">Set to current location</a>
		<div class="well well-small" style="margin-top: 15px">
		<h4>Restaurant: <span id="restitle"></span></h4>
		<table class="resprop table table-striped">
			<tr id="addrrow"><td>Address:</td><td id="resaddress"></td></tr>
			<tr id="phonerow"><td>Phone number:</td><td id="resphone"></td></tr>
			<tr id="homepagerow"><td>Homepage:</td><td id="reshomepage"></td></tr>
			<tr id="emailrow"><td>E-mail address:</td><td id="resemail"></td></tr>
			<tr id="ratingfoodrow"><td>Rating food:</td><td id="resratingfood"></td></tr>
			<tr id="ratingservicerow"><td>Rating service:</td><td id="resratingservice"></td></tr>
			<tr id="ratinginteriorrow"><td>Rating interior:</td><td id="resratinginterior"></td></tr>
			<tr id="googleratingrow"><td>Rating google places:</td><td id="resgooglerating"></td></tr>
			<tr id="kitchentyperow"><td>Kitchen type:</td><td id="reskitchentype"></td></tr>
			<tr id="openhoursrow"><td>Open hours:</td><td id="resopenhours"></td></tr>
			<tr id="kitchenfacilitiesrow"><td>Kitchen facilities:</td><td id="reskitchenfacilities"></td></tr>
			<tr id="menutypesrow"><td>Menu types:</td><td id="resmenutypes"></td></tr>
			<tr id="averagemenupricerow"><td>Average menu price:</td><td id="resaveragemenuprice"></td></tr>
			<tr id="minimummenupricerow"><td>Minimum menu price:</td><td id="resminimummenuprice"></td></tr>
			<tr id="housewinebottlepricerow"><td>Housewine price (bottle):</td><td id="reshousewinebottleprice"></td></tr>
			<tr id="housewineglasspricerow"><td>Housewine price (glass):</td><td id="reshousewineglassprice"></td></tr>
			<tr id="childmenupricerow"><td>Child menu price:</td><td id="reschildmenuprice"></td></tr>
			<tr id="paymentoptionsrow"><td>Payment options:</td><td id="respaymentoptions"></td></tr>
			<tr id="chefrow"><td>Chef:</td><td id="reschef"></td></tr>
			<tr id="maitrerow"><td>Maitre:</td><td id="resmaitre"></td></tr>
			<tr id="sommelierrow"><td>Sommelier:</td><td id="ressommelier"></td></tr>
			<tr id="facilitiesrow"><td>Facilities:</td><td id="resfacilities"></td></tr>
			<tr id="parkingpossibilitiesrow"><td>Parking possibilities:</td><td id="resparkingpossibilities"></td></tr>
			<tr id="grouppossibilitiesrow"><td>Group possibilities:</td><td id="resgrouppossibilities"></td></tr>
			<tr id="privateroompossibilitiesrow"><td>Private room possibilities:</td><td id="resprivateroompossibilities"></td></tr>
			<tr id="typerestaurantrow"><td>Type of restaurant:</td><td id="restyperestaurant"></td></tr>
			<tr id="exteriordiningoptionsrow"><td>Exterior dining options:</td><td id="resexteriordiningoptions"></td></tr>
			<tr id="childfeaturesrow"><td>Child features:</td><td id="reschildfeatures"></td></tr>
			<tr id="accessibilityrow"><td>Accessibility:</td><td id="resaccessibility"></td></tr>
		</table>
		<img src="" id="resimage" style="margin-top: 10px; width: 350px;" />
		</div>
	</div>
	<div class="span8">
		<div id="map_canvas" style="width:770px; height:500px; margin-bottom: 10px;"></div>
		<div class="row">
			<div class="span4">
				<div class="well well-small">
					<span id="venuecounter" class="badge pull-right">0</span>
					<h4 style="margin-bottom: 0px; float: left;">Venues: <span id="venuetitle"></span></h4>
					<table id="venuetable" class="table table-striped">

					</table>
				</div>
			</div>
			<div class="span4">
				<div id="introbox" class="well well-small">
					<h4>Welcome to IWAFA</h4>
					On this mashup page you can browse for restaurants in the Netherlands, compare ratings from both <a href="http://www.iens.nl">iens.nl</a> and <a href="http://places.google.com">Google Places</a> and find matching venues to go to after dinner. Click on any marker in the map to get details and start your journey!<br />
                    <a id="close" class="btn btn-primary" onclick="$('#introbox').fadeOut();" style="float: right; clear:both;">Close</a><br /><br />
				</div>
				<div id="venuedetailbox" class="well well-small">
					<h4>Venue details</h4>
					<table id="venuedetailtable">

					</table>
				</div>
				<div id="eventbox" class="well well-small">
					<h4>Events</h4>
					<table id="eventtable">

					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
<?PHP echo "var restaurants = eval($result)"; ?>
</script>
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyDT7vetZ2ZZsupLtDTUEcO0zb0gHww4x2A"></script>
<script src="<?= $this->config->base_url() ?>javascript/jquery.geocomplete.min.js"></script>
<script src="<?= $this->config->base_url() ?>javascript/purl.js"></script>
<script src="<?= $this->config->base_url() ?>javascript/general.js"></script>
