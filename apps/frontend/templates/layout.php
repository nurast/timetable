<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<?php include_http_metas() ?>
		<?php include_metas() ?>
		<?php include_title() ?>
		<link rel="shortcut icon" href="/favicon.ico" />
		<link rel="stylesheet" href="/css/jquery-ui.min.css" />
		
		<?php include_stylesheets() ?>
		<?php //use_javascript('jquery-1.11.2.min.js') ?>
		<script type="text/javascript" src="/js/jquery-1.11.2.min.js"></script>

		<script type="text/javascript" src="/js/jquery-ui.min.js"></script>

		<?php include_javascripts() ?>
	</head>
	<body>
		<?php echo $sf_content ?>
	</body>
</html>
