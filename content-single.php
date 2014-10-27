<?php
/**
 * @package _s_foudation
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="eyecatch">
			<?php
			if (has_post_thumbnail()) {
				the_post_thumbnail();
			} ?>
	</div><!-- /.eyecatch -->
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php _s_foudation_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', '_s_foudation_foudation' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php _s_foudation_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
