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
				<?php echo pad_add_author('') ?>
				<div class="sbver">
					<div class="social">
						<?php SocialButtonVertical(); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
		  <div class="small-12 medium-6 large-6 columns">
				<div class="green">
					<!-- EBiS 3pas tag version 0.00 start -->
					<script type="text/javascript">
						var ebis_proto= (location.protocol == 'http:')
							 ? 'http://'
							 : 'https://';
						var ebis_argument  = "sRrG93Nh";
						var ebis_tag       = "tag5538ade07cfa8";
						var ebis_alt_img   = encodeURIComponent("");
						var ebis_alt_link  = encodeURIComponent("");
						var ebis_width     = 300;
						var ebis_height    = 250;

						var ebis_ifhtml='<iframe src="%SRC%" noresize="noresize" scrolling="no" hspace="0" vspace="0" frameborder="0" marginheight="0" marginwidth="0" width="'+ebis_width+'" height="'+ebis_height+'" ></iframe>';

						var ebis_amp = "\x26";
						var ebis_ifsrc = ebis_proto + "as.ebis.ne.jp/resolv.php";
							ebis_ifsrc += "?argument=" + ebis_argument;
							ebis_ifsrc += ebis_amp + "tag_id="   + ebis_tag;
							ebis_ifsrc += ebis_amp + "width="    + ebis_width;
							ebis_ifsrc += ebis_amp + "height="   + ebis_height;
							ebis_ifsrc += ebis_amp + "alt_img="  + ebis_alt_img;
							ebis_ifsrc += ebis_amp + "alt_link=" + ebis_alt_link;

						document.write(ebis_ifhtml.replace("%SRC%",ebis_ifsrc));
					</script>
					<noscript>
					<iframe src="https://as.ebis.ne.jp/resolv.php?html=1&argument=sRrG93Nh&tag_id=tag5538ade07cfa8" noresize="noresize" scrolling="no" hspace="0" vspace="0" frameborder="0" marginheight="0" marginwidth="0" width="300" height="250" ></iframe>
					</noscript>
					<!-- EBiS 3pas tag end -->
				</div>
		  </div>
		  <div class="small-12 medium-6 large-6 columns">
				<?php do_action('wpdbones-ad-content-below'); ?>
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