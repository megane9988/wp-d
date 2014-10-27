<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package _s_foudation
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<header id="masthead" class="site-header contain-to-grid <?php if(is_home()){ ?>fixed<?php } ?>" role="banner">
		<nav class="top-bar" data-topbar>
			<ul class="title-area">
				<li class="name">
					<h1><a href="/">WP-D</a></h1>
				</li>
				<li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
			</ul>

		<section class="top-bar-section">
			<!-- Right Nav Section -->
			<ul class="right">
				<li><a href="/about/">About</a></li>
				<li><a href="/consulting/">Consulting</a></li>
			</ul>
		</section>
	</nav>

	</header><!-- #masthead -->
	<?php if(is_home()){ ?><div class="home_img">
		<img src="<?php bloginfo('template_directory'); ?>/img/home/sunrize.jpg" alt="">
	</div><!-- /.home_img --><?php } ?>
	<div id="content" class="site-content">
