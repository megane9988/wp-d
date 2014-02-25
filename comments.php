<?php
if (post_password_required()) {
 return;
}
?>
<div id="comments">
<?php if (have_comments()): ?>
		<h2 id="comments-count"><?php echo get_comments_number().' 件のコメント'; ?></h2>
		<ol id="comments-list">
				<?php wp_list_comments(array('avatar_size'=>48,'style'=>'ul','type'=>'comment')); ?>
		</ol>
<?php if ( get_comment_pages_count() > 1) : ?>
		<div class="row">
			<div class="large-12 columns">
				<div id="comments-pagination" class="row">
					<div class="small-6 columns">
						<?php previous_comments_link('&lt;&lt; 前のコメント'); ?>
					</div>
					<div class="small-6 columns text-right">
						<?php next_comments_link('次のコメント &gt;&gt;'); ?>
					</div>
				</div>
			</div>
		</div>
<?php endif; endif; ?>
<?php comment_form(); ?>
</div><!-- comments -->






