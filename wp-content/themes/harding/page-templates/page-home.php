<?php
/**
 * Template Name: Home
 * @package WordPress
 */

get_header(); ?>

<section class="hero-section">

<?php

	$popular = new WP_Query(
		array(
			'posts_per_page'=>5,
			'order'=>'DESC',
			'category_name' => 'highlight'
		)
	);
	$popularCount = 0;
	$popularIDs = array();
	while ($popular->have_posts()) : $popular->the_post();
		$popularCount++;
		$popularIDs[] = get_the_ID();

		?>

		<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
			<figure>
				<?php the_post_thumbnail(); ?>
				<figcaption>
					<span class="caption-wrapper">
						<?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?>
					</span>
					<footer>
						<small>
							<?php featuredImgAttribution(); ?>
						</small>
					</footer>
				</figcaption>
			</figure>
		<?php endif; ?>
		<h1><?php the_title(); ?></h1>
		<?php

	endwhile; wp_reset_postdata();


?>

</section>

<?php get_footer(); ?>