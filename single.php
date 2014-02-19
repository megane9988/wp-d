<?php get_header(); ?>

<div class="row main-content">
	<div class="large-9 large-centered columns">
		<?php while ( have_posts() ) : the_post(); ?>
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
			<div class="large-10 columns">
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="entry-title"> 
						<?php the_title(); ?>
					</h1>
					<date class="published">
						<?php the_time('Y.m.d'); ?> | 
					</date>
					<?php the_category(' | '); ?>
					<?php the_tags('', ' | '); ?>
					<?php edit_post_link('編集','(',')'); ?>
					<div class="sbver">
						<div class="social">
							<?php SocialButtonVertical(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="large-10 large-centered columns">
				<?php do_action('wpdbones-ad-content-first'); ?>
				<?php the_content(); ?>
				<?php wp_link_pages('before=<div class="link-page mb">&after=</div>&next_or_number=number&pagelink=<span class="page-numbers">%</span>'); ?>
				<div class="sbver">
					<div class="social">
						<?php SocialButtonVertical(); ?>
					</div>
				</div>
			</div>
		</div>
		<?php endwhile;?>
		<div class="row">
			<div class="large-12 columns">
				<div class="row">
					<div class="small-6 columns">
						<?php previous_post_link( '%link', '<span class="meta-nav button small">' . _x( '&larr;前の記事', '', '' ) . '</span>' ); ?>
					</div>
					<div class="small-6 columns text-right">
						<?php next_post_link( '%link', '<span class="meta-nav button small">' . _x( '次の記事&rarr;', '', '' ) . '</span>' ); ?>
					</div>
				</div>
				<?php do_action('wpdbones-ad-content-below'); ?>
			</div>
		</div>
		<?php comments_template(); ?>
		<hr>
		<div class="row">
			<div class="large-12 columns">
				<?php wp_d_paging_nav(); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
