		<div class="site-footer">
			<div class="row">
				<div class="large-3 columns">
					<?php dynamic_sidebar('footer01'); ?>
				</div>
				<div class="large-3 columns">
					<?php dynamic_sidebar('footer02'); ?>
				</div>
				<div class="large-3 columns">
					<?php dynamic_sidebar('footer03'); ?>
				</div>
				<div class="large-3 columns">
					<?php dynamic_sidebar('footer04'); ?>
				</div>
			</div>
			<div class="row">
				<div class="large-12 columns text-center">
					<p>
						Proudly powered by WordPress | Theme: <?php $wp_d_theme = wp_get_theme(); echo $wp_d_theme->get( 'Name' ); ?> by <?php echo $wp_d_theme->get( 'Author' ); ?>.
					</p>
				</div>
			</div>
		</div>
	<?php wp_footer(); ?>
	</body>
</html>