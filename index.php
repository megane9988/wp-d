<?php get_header(); ?>
	<div class="row main-content">
		<div class="large-9 large-centered columns">
			<div class="row">
				<div class="large-2 columns mb"> <img alt="" src="http://1.gravatar.com/avatar/75e55614a2d05d8c7784779e76a1a3d9?s=192&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D96&amp;r=G" />
					<p> <a href="#"> hissy</a> </p>
				</div>
				<div class="large-10 columns">
					<?php if(is_archive()): ?>
						<h5 class="page-title">
							<?php if ( is_day() ) :
								printf( __( '" %s " の一覧', 'wp_d_2014' ), get_the_date() );
							elseif ( is_month() ) :
								printf( __( '" %s " の一覧', 'wp_d_2014' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'wp_d_2014' ) ) );
							elseif ( is_year() ) :
								printf( __( '" %s " の一覧', 'wp_d_2014' ), get_the_date( _x( 'Y', 'yearly archives date format', 'wp_d_2014' ) ) );
							elseif ( is_category() ) :
								printf( __( '" %s " の一覧', 'wp_d_2014' ), single_cat_title( '', false ) );
							elseif( is_tag() ) :
								printf( __( '" %s " の一覧', 'wp_d_2014' ), single_tag_title( '', false ) );
							else :
								_e( 'Archives', 'wp_d_2014' );
							endif; ?>
						</h5>
						<hr>
					<?php endif; ?>
					<?php while ( have_posts() ) : the_post(); ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<p><?php the_time('Y.m.d'); ?></p>
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
				</div>
				<hr>
				<?php endwhile;?>
				<div class="row">
					<div class="large-12 columns">
						<?php wp_d_2014_paging_nav(); ?>
					</div>
				</div>
				<?php if (is_single()){?>
					<div class="row">
						<div class="small-6 columns">
							<?php previous_post_link( '%link', '<span class="meta-nav button">' . _x( '&larr;前の記事', '', '' ) . '</span>' ); ?>
						</div>
						<div class="small-6 columns text-right">
							<?php next_post_link( '%link', '<span class="meta-nav button">' . _x( '次の記事&rarr;', '', '' ) . '</span>' ); ?>
						</div>
					</div>
				<?php }?>
			</div>
		</div>
	</div>
<?php get_footer(); ?>