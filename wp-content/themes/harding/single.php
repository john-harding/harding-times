<?php get_header(); ?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=1062012970508802";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<?php
$topLevelCategory = get_top_category();

	function displayTrendingItem($displayCategory = false) {
		?>
			<li>
				<a href="<?php the_permalink(); ?>">
				<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
					<figure class="post-thumb" style="background-image: url(<?php the_post_thumbnail_url('thumbnail'); ?>);">
					</figure><?php endif;

						if ($displayCategory) {
							echo '<span class="post-category">' . get_top_category(get_the_category())->name . '</span>';
						}

					?><span><?php the_title(); ?></span>
				</a>
			</li>
		<?php
	}
?>
	<main role="main">
	<section class="article-wrapper">

	<?php if (have_posts()): while (have_posts()) : the_post();

		$postPermalink = get_permalink();
		$postTitle = get_the_title();
	 ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="category"><?php echo '<a href="' . site_url() . '/' . $topLevelCategory->slug . '" rel="category">' . $topLevelCategory->name . '</a>'; ?></div>
			<h1>
				<?php echo $postTitle; ?>
			</h1>

			<div class="author-info">
				<span class="author">By <?php the_author_posts_link(); ?></span><span class="date"><?php the_time('F j, Y'); ?></span>
			</div>

			<div class="article-content">

				<div class="social-share">
					<ul>
						<li>
							<a class="share-icon share-icon--facebook" href="https://www.facebook.com/dialog/share?app_id=1838367689732626&amp;display=popup&amp;href=<?php echo urlencode($postPermalink); ?>" target="_blank" rel="nofollow">
								<i class="fa fa-facebook"></i>
							</a>
						</li>
						<li>
							<a class="share-icon share-icon--twitter" href="https://twitter.com/share?url=<?php echo urlencode($postPermalink); ?>&amp;text=<?php echo urlencode($postTitle); ?>&amp;via=hardingtimes" target="_blank">
								<i class="fa fa-twitter" rel="nofollow"></i>
							</a>
						</li>
						<li>
							<a class="share-icon share-icon--reddit" href="https://www.reddit.com/submit?url=<?php echo urlencode($postPermalink); ?>&amp;title=<?php echo urlencode($postTitle); ?>" target="_blank" rel="nofollow">
								<i class="fa fa-reddit-alien"></i>
							</a>
						</li>
						<li>
							<a class="share-icon share-icon--email" href="mailto:?subject=<?php echo urlencode($postTitle); ?>&amp;body=<?php echo urlencode($postPermalink); ?>" target="_blank" rel="nofollow">
								<i class="fa fa-envelope"></i>
							</a>
						</li>
					</ul>
				</div>

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

				<div class="harding-content">
					<?php the_content(); ?>
				</div>
<!-- 
<?php echo $postPermalink; ?>
 --> 
				<div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-numposts="3"></div>
			</div>
			<div class="harding-sidebar">
				<ul class="popular-posts">
					<h3>Trending News</h3>
					<?php $popular = new WP_Query(
						array(
							'post__not_in' => array(get_the_ID()),
							'posts_per_page'=>5,
							'meta_key'=>'popular_posts',
							'orderby'=>'meta_value_num',
							'order'=>'DESC',
							'category_name' => $topLevelCategory->name,
							'date_query' => array(
								array(
									'after' => '1 week ago'
								)
							) 
						));
					$popularCount = 0;
					$popularIDs = array();
					while ($popular->have_posts()) : $popular->the_post();
						$popularCount++;
						$popularIDs[] = get_the_ID();

						displayTrendingItem();
					endwhile; wp_reset_postdata();

					if($popularCount < 5) {
						$otherPosts = new WP_Query(
							array(
								'post__not_in' => $popularIDs,
								'posts_per_page'=> (5 - $popularCount),
								'meta_key'=>'popular_posts',
								'orderby'=>'meta_value_num',
								'order'=>'DESC',
								'date_query' => array(
									array(
										'after' => '2 week ago'
									)
								)
							));
						while ($otherPosts->have_posts()) : $otherPosts->the_post();
							displayTrendingItem(true);
						endwhile; wp_reset_postdata();
					}
					?>
				</ul>
			</div>
		</article>
		<!-- /article -->

	<?php endwhile; ?>

	<?php else: ?>

		<!-- article -->
		<article>

			<h1><?php _e( 'There was a problem finding the article you\'re looking for.' ); ?></h1>

		</article>
		<!-- /article -->

	<?php endif; ?>

	</section>
	<!-- /section -->
	</main>

<?php get_footer(); ?>
