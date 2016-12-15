<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="UTF-8">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon-blue.png?v=10" type="image/x-icon" />
		<script type="text/javascript" src=""></script>

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>

	</head>
	<body <?php body_class(); ?>>
		<div class="content-wrapper">
			<header class="header">
				<div class="header__outer">
					<div class="header__select">
						<button id="menu-toggle" class="menu-toggle"><i class="fa fa-bars"></i></button>
						<button id="search-toggle" class="search-toggle"><i class="fa fa-search"></i></button>
					</div>
					<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?= site_url() . '/wp-content/themes/harding/images/logo.png'; ?>" alt="The Harding Times">
					</a>
					<nav id="menu" class="header__menu site-navigation primary-navigation" role="navigation">
						<?php
							global $categories;
							displayCategories($categories, true);
						?>
					</nav>
				</div>
				<div class="header__filler"></div>
				<div id="search-container" class="search-box-wrapper">
					<div class="search-box">
						<?php get_search_form(); ?>
					</div>
				</div>
			</header>
