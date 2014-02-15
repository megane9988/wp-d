<?php
// cssとjsの読み込み ---------------------------------------------
function wp_d_2014_styles() {
wp_enqueue_style( 'wp_d_2014', get_bloginfo( 'stylesheet_directory') . '/stylesheets/app.css', array(), null, 'all');
wp_enqueue_script( 'foundation_js', get_bloginfo( 'stylesheet_directory') . '/bower_components/foundation/js/foundation.min.js', array('jquery'), false, true );
wp_enqueue_script( 'app_js', get_bloginfo( 'stylesheet_directory') . '/js/app.js', array(), false, true );
}
add_action( 'wp_enqueue_scripts', 'wp_d_2014_styles');

// titleタグ内を適切に表示 (twentyfourteenから流用)---------------------------------------------
function wp_d_2014_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'wp_d_2014' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'wp_d_2014_wp_title', 10, 2 );

// ページナビゲーション (twentyfourteenから流用)----------------------------------------------
if ( ! function_exists( 'wp_d_2014_paging_nav' ) ) :
function wp_d_2014_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; 前へ', 'wp_d_2014' ),
		'next_text' => __( '次へ &rarr;', 'wp_d_2014' )
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<div class="pagination loop-pagination">
			<?php echo $links; ?>
		</div><!-- .pagination -->
	</nav><!-- .navigation -->
	<?php
	endif;
}
endif;

// ウィジェット設定 ---------------------------------------------
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name'          => 'サイドバー',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
		));
	register_sidebar(array(
		'name'          => 'フッター01',
		'id'            => 'footer01',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
		));
	register_sidebar(array(
		'name'          => 'フッター02',
		'id'            => 'footer02',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
		));
	register_sidebar(array(
		'name'          => 'フッター03',
		'id'            => 'footer03',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
		));
	register_sidebar(array(
		'name'          => 'フッター04',
		'id'            => 'footer04',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>'
		));

// アイキャッチの利用 ---------------------------------------------
add_theme_support( 'post-thumbnails' );

// カスタムナビゲーションの利用 ---------------------------------------------
 register_nav_menu('mainmenu', 'メインメニュー');

// テーマテストへの対応 ---------------------------------------------
add_theme_support( 'automatic-feed-links' );
if ( ! isset( $content_width ) ) $content_width = 703;