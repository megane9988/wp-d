<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<!--[if IE 10]><html class="ie10" lang="en" > <![endif]-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
	<?php if ( has_post_thumbnail() ) : ?>
		<style>
			.main-img{
				background-image: url(
					<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>
					);
				background-repeat: repeat-x;
			}
		</style>
	<?php endif; ?>
</head>
<body <?php body_class(); ?>>
	<div class="contain-to-grid">
		<nav class="top-bar" data-topbar="">
			<ul class="title-area">
				<li class="name">
					<h1>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php bloginfo( 'name' ); ?>
						</a>
					</h1>
				</li>
				<li class="toggle-topbar menu-icon">
					<a href=""><span>Menu</span></a>
				</li>
			</ul>
			<section class="top-bar-section">
			<!-- カスタムナビゲーションの読み込み -->
				<?php wp_nav_menu (array(
					'theme_location'=>'mainmenu', // 利用するナビゲーション
					'container'       => false,
					'menu_class'      => 'right',  // 付与するclass
					'menu_id'         => 'top', // 付与するid
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'after'           => '<li class="divider"></li>',
					'items_wrap'      => '<ul id="%1$s" class="%2$s"><li class="divider"></li>%3$s</ul>',
				)); ?>
			</section>
		</nav>
	</div>
	<div class="main-img <?php $author = get_userdata($post->post_author); echo $author->display_name; ?>
	">
		<div class="row">
			<div class="large-12 columns text-center">
					<?php
					if(get_field('catchcopy'))
					{
						echo '<h1>' . get_field('catchcopy') . '</h1>';
					}
					?>
					<?php
					if(get_field('catchcopy'))
					{
						echo '<h3>' . get_field('subcopy') . '</h3>';
					}
					?>
			</div>
		</div>
	</div>

