<?php get_header(); ?>

<div class="row main-content">
	<div class="large-9 large-centered columns">
		<?php while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h2><?php the_title(); ?></h2>
			</div>
			<?php the_content(); ?>
			<?php if (!is_page()){?>
			<ul class="no-bullet post-meta">
				<?php
						$cats = get_the_category(); 
						foreach( $cats as $cat) { 
							echo '<li><span class="secondary radius label">';
							echo $cat->cat_name . '</span></li>'; 
						}
						$posttags = get_the_tags(); 
						if ($posttags) { 
							foreach($posttags as $tag) { 
							echo '<li><span class="secondary radius label">';
							echo $tag->name . '</span></li>'; 
							} 
						} 
						?>
			</ul>
			<?php }?>
			<?php edit_post_link('編集','(',')'); ?>
			<?php wp_link_pages( ); ?>
		<?php endwhile;?>
		<?php comments_template(); ?>
	</div>
</div>
<?php get_footer(); ?>
