<?php get_header(); ?>
<div class="row main-content">
	<div class="large-9 large-centered columns">
		<h5 class="page-title">
			<?php printf( __( '%s の検索結果', 'wp_d' ), '' . get_search_query() . '' ); ?>
		</h5>
		<hr>
		<?php while ( have_posts() ) : the_post(); ?>
		<div class="row">
			<div class="large-12 columns mb">
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2 class="entry-title"> <a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
						</a> </h2>
					<date class="published">
						<?php the_time('Y.m.d'); ?>
						<?php edit_post_link('編集','(',')'); ?>
					</date>
				</div>
			</div>
		</div>
		<hr>
		<?php endwhile;?>
		<div class="row">
			<div class="large-12 columns">
				<?php wp_d_paging_nav(); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>