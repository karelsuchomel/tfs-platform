<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
	<meta charset="<?php bloginfo('charset');?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Windows tile graphics and RSS feed -->
	<?php $templateURL = get_bloginfo('template_url'); ?>
	<meta name="application-name" content="www.zshroznova.cz"/>
	<meta name="msapplication-square70x70logo" content="<?php echo $templateURL; ?>/assets/images/ms-windows-tiles/small.jpg"/>
	<meta name="msapplication-square150x150logo" content="<?php echo $templateURL; ?>/assets/images/ms-windows-tiles/medium.jpg"/>
	<meta name="msapplication-wide310x150logo" content="<?php echo $templateURL; ?>/assets/images/ms-windows-tiles/wide.jpg"/>
	<meta name="msapplication-square310x310logo" content="<?php echo $templateURL; ?>/assets/images/ms-windows-tiles/large.jpg"/>
	<meta name="msapplication-TileColor" content="#00b04c"/>
	<meta name="msapplication-notification" content="frequency=30;polling-uri=http://notifications.buildmypinnedsite.com/?feed=https://www.zshroznova.cz/feed/&amp;id=1;polling-uri2=http://notifications.buildmypinnedsite.com/?feed=https://www.zshroznova.cz/feed/&amp;id=2;polling-uri3=http://notifications.buildmypinnedsite.com/?feed=https://www.zshroznova.cz/feed/&amp;id=3;polling-uri4=http://notifications.buildmypinnedsite.com/?feed=https://www.zshroznova.cz/feed/&amp;id=4;polling-uri5=http://notifications.buildmypinnedsite.com/?feed=https://www.zshroznova.cz/feed/&amp;id=5; cycle=1"/>

	<!-- Links-->
	<?php wp_head(); ?>
	</head>
<body <?php body_class(); ?> >

	<noscript>
		You need to enable JavaScript to run this app.
	</noscript>
	
	<div id="root"></div>

	<?php wp_footer(); ?>
</body>
</html>