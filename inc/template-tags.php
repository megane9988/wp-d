<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package _s_foudation
 */

if ( ! function_exists( '_s_foudation_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function _s_foudation_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', '_s_foudation_foudation' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', '_s_foudation_foudation' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', '_s_foudation_foudation' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( '_s_foudation_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function _s_foudation_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<hr>
	<nav class="navigation post-navigation" role="navigation">
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( 'Prev : %title', 'Previous post link', '_s_foudation_foudation' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( 'Next : %title', 'Next post link',     '_s_foudation_foudation' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( '_s_foudation_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function _s_foudation_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( '%s', 'post date', '_s_foudation_foudation' ),
		$time_string
	);

	echo '<span class="posted-on">' . $posted_on . '</span>';

}
endif;

if ( ! function_exists( '_s_foudation_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function _s_foudation_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ' ', '_s_foudation_foudation' ) );
		if ( $categories_list && _s_foudation_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( '%1$s', '_s_foudation_foudation' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ' ', '_s_foudation_foudation' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( ' %1$s', '_s_foudation_foudation' ) . '</span>', $tags_list );
		}
	}


	edit_post_link( __( ' [Edit]', '_s_foudation_foudation' ), '<span class="edit-link">', '</span>' );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function _s_foudation_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( '_s_foudation_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( '_s_foudation_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so _s_foudation_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so _s_foudation_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in _s_foudation_categorized_blog.
 */
function _s_foudation_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( '_s_foudation_categories' );
}
add_action( 'edit_category', '_s_foudation_category_transient_flusher' );
add_action( 'save_post',     '_s_foudation_category_transient_flusher' );
