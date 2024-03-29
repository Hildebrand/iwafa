<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>IWAFA :: Intelligent Web Applications Final Assignment</title>

	<script src="<?= $this->config->base_url() ?>javascript/jquery-1.9.1.min.js"></script>
	<script src="<?= $this->config->base_url() ?>javascript/jquery.cookie.js"></script>
	<script src="<?= $this->config->base_url() ?>javascript/bootstrap.min.js"></script>
	<link rel="stylesheet" href="<?= $this->config->base_url() ?>css/bootstrap.min.css" media="screen" />
	<link rel="stylesheet" href="<?= $this->config->base_url() ?>css/general.css" />
	<link rel="stylesheet" href="<?= $this->config->base_url() ?>css/bootstrap-responsive.min.css" />
</head>
<body>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<ul class="nav">
					<li>
						<a href="<?= $this->config->base_url() ?>">Home</a>
					</li>
					<li><a href="#" id="legendlink" data-html="true" data-content="<img src='<?= $this->config->base_url() ?>/img/legend.png'/>" data-original-title="Legend" data-placement="bottom" data-trigger="hover">Legend</a></li>
					<li><a href="<?= $this->config->base_url() ?>documentation">Developers documentation</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container">
