<?php get_header(); ?>

<div class="row main-content">
	<div class="large-9 large-centered columns">
		<h5 class="page-title">
			<?php if ( is_day() ) :
						printf( __( '" %s " の一覧', 'wp_d' ), get_the_date() );
					elseif ( is_month() ) :
						printf( __( '" %s " の一覧', 'wp_d' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'wp_d' ) ) );
					elseif ( is_year() ) :
						printf( __( '" %s " の一覧', 'wp_d' ), get_the_date( _x( 'Y', 'yearly archives date format', 'wp_d' ) ) );
					elseif ( is_category() ) :
						printf( __( '" %s " の一覧', 'wp_d' ), single_cat_title( '', false ) );
					elseif( is_tag() ) :
						printf( __( '" %s " の一覧', 'wp_d' ), single_tag_title( '', false ) );
					else :
						_e( 'Archives', 'wp_d' );
					endif; ?>
		</h5>
		<hr>
		<?php $counter = 0;
			while ( have_posts() ) : the_post(); $counter++;?>
		<div class="row">
			<div class="large-2 columns show-for-large-up">
				<div class="row">
					<div class="large-12 small-3 columns">
						<?php
							$author_bio_avatar_size = apply_filters( 'wp-d_author_bio_avatar_size', 320 );
							echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
						?>
					</div>
					<div class="large-12 small-9 columns">
						<p><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php the_author(); ?></a></p>
					</div>
				</div>
			</div>
			<div class="large-10 columns mb">
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2> <a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
						</a> </h2>
					<date>
						<?php the_time('Y.m.d'); ?>
						<?php edit_post_link('編集','(',')'); ?>
					</date>
				</div>
			</div>
			<hr>
		</div>
		<?php
		if ($counter == 1) {do_action('wpdbones-ad-content-first') ;} 
		if ($counter == 2) {do_action('wpdbones-ad-content-above') ;} 
		if ($counter == 3) {do_action('wpdbones-ad-content-above') ;} 
		?>
		<?php endwhile;?>
		<div class="row">
			<div class="large-12 columns">
				<?php wp_d_paging_nav(); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
