<div class="post-wrap clear-both type-image">
	<!-- if there is a features image -->
	<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
		<?php the_post_thumbnail('small-thumbnail'); ?>
	</a>

	<h2>
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
			<?php the_title(); ?>
		</a>
	</h2>
	<div class="basic-info-wrap">
		<p>
			<?php echo wp_trim_words( get_the_content(''), 15, '...' ); ?>
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
				více
			</a>
			<br />
			<small>
				<?php the_time('F jS, Y'); ?> &#8226; <?php the_author_posts_link(); ?>
			</small>
		</p>
	</div>
</div>