<?php
// cssとjsの読み込み ---------------------------------------------
function wp_d_styles() {
wp_enqueue_style( 'wp_d', get_bloginfo( 'stylesheet_directory') . '/stylesheets/app.css?1420202', array(), null, 'all');
wp_enqueue_script( 'foundation_js', get_bloginfo( 'stylesheet_directory') . '/bower_components/foundation/js/foundation.min.js', array('jquery'), false, true );
wp_enqueue_script( 'app_js', get_bloginfo( 'stylesheet_directory') . '/js/app.js', array(), false, true );
}
add_action( 'wp_enqueue_scripts', 'wp_d_styles');

// titleタグ内を適切に表示 (twentyfourteenから流用)---------------------------------------------
function wp_d_wp_title( $title, $sep ) {
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
		$title = "$title $sep " . sprintf( __( 'Page %s', 'wp_d' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'wp_d_wp_title', 10, 2 );

// ページナビゲーション (twentyfourteenから流用)----------------------------------------------
if ( ! function_exists( 'wp_d_paging_nav' ) ) :
function wp_d_paging_nav() {
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
		'prev_text' => __( '&larr; 前へ', 'wp_d' ),
		'next_text' => __( '次へ &rarr;', 'wp_d' )
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

// ソーシャルボタンの導入 ---------------------------------------------
function SocialButtonVertical()
{ ?>
	<ul>
	<li>
		<a href="http://b.hatena.ne.jp/entry/" class="hatena-bookmark-button"
		data-hatena-bookmark-layout="vertical-balloon"
		data-hatena-bookmark-url="<?php the_permalink(); ?>">
			<img src="http://b.st-hatena.com/images/entry-button/button-only.gif"
				alt="このエントリーをはてなブックマークに追加" width="20" height="20"
				style="border: none">
		</a>
	</li>
	<li>
			<a href="https://twitter.com/share" class="twitter-share-button"
		data-lang="en"
		data-url="<?php the_permalink(); ?>"
		data-text="<?php the_title(); ?>"
		data-count="vertical"
			>Tweet</a>
	</li>
	<li>
			<div class="g-plusone" data-size="tall" data-href="<?php the_permalink(); ?>"></div>
	</li>
	<li>
			<div class="fb-like"
		data-href="<?php the_permalink(); ?>"
		data-layout="box_count"
		data-send="false"
		data-width="450"
		data-show-faces="false">
			</div>
	</li>
	</ul>
<?php }

// ソーシャルボタンの導入 ---------------------------------------------
function wp_d_bookmarks(){
	?>
<script>(function(w,d){
	w._gaq=[["_setAccount","UA-33477429-1"],["_trackPageview"]];
	w.___gcfg={lang:"ja"};
	var s,e = d.getElementsByTagName("script")[0],
	a=function(u,f){if(!d.getElementById(f)){s=d.createElement("script");
	s.src=u;if(f){s.id=f;}e.parentNode.insertBefore(s,e);}};
	a(("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js","ga");
	a("https://apis.google.com/js/plusone.js");
	a("//b.st-hatena.com/js/bookmark_button_wo_al.js");
	a("//platform.twitter.com/widgets.js","twitter-wjs");
	a("//connect.facebook.net/ja_JP/all.js#xfbml=1","facebook-jssdk");
})(this, document);</script>
	<?php
}
add_action('wp_footer', 'wp_d_bookmarks');


// アドセンス設定 ---------------------------------------------
function wpdbones_ad_content_first(){
if ( !is_admin() ) :?>
<div class="row">
	<div class="large-12 columns">
		<div class="prime-banner-top text-center">
			<div class="adtxt">スポンサードリンク</div>
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- レスポンシブ -->
			<ins class="adsbygoogle"
			     style="display:block"
			     data-ad-client="ca-pub-2866035444666228"
			     data-ad-slot="7284098701"
			     data-ad-format="auto"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		</div>
	</div>
</div>
<?php endif;
}

function wpdbones_ad_content_above(){
if ( !is_admin() ) :?>
<div class="row">
	<div class="large-12 columns">
		<div class="prime-banner-top text-center">
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- レスポンシブ -->
			<ins class="adsbygoogle"
			     style="display:block"
			     data-ad-client="ca-pub-2866035444666228"
			     data-ad-slot="7284098701"
			     data-ad-format="auto"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		</div>
	</div>
</div>
<?php endif;
}

function wpdbones_ad_content_below(){
if ( !is_admin() ) :?>
<div class="row">
	<div class="large-12 columns">
		<div class="prime-banner-bottom text-center">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- レスポンシブ -->
		<ins class="adsbygoogle"
		     style="display:block"
		     data-ad-client="ca-pub-2866035444666228"
		     data-ad-slot="7284098701"
		     data-ad-format="auto"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
		</div>
	</div>
</div>
<?php endif;
}
add_action( 'wpdbones-ad-content-first', 'wpdbones_ad_content_first' );
add_action( 'wpdbones-ad-content-above', 'wpdbones_ad_content_above' );
add_action( 'wpdbones-ad-content-below', 'wpdbones_ad_content_below' );