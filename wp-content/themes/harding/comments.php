	<?php// if (post_password_required()) : ?>
	<?php// _e( 'Post is password protected. Enter the password to view any comments.', 'html5blank' ); ?>

	<?php// return; endif; ?>

<?php //if (have_comments()) : ?>
	<?php// comments_number(); ?>
		<?php //wp_list_comments('type=comment&callback=html5blankcomments'); // Custom callback in functions.php ?>
<?php //elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
<?php //endif; ?>
<?php //comment_form(); ?>