<?php

/**
 * New/Edit Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php if ( bbp_is_reply_edit() ) : ?>

<div id="bbpress-forums">

	<?php bbp_breadcrumb(); ?>

<?php endif; ?>
	<div id="no-reply-<?php bbp_topic_id(); ?>" class="bbp-no-reply">
		<div class="bbp-template-notice">
			<p><?php _e( 'You cannot reply to this support ticket. Please open your own support ticket.', 'bbpress' ); ?></p>
		</div>
	</div>

<?php if ( bbp_is_reply_edit() ) : ?>

</div>

<?php endif; 

// todo: create new topic form populated with ticket link and short desc and then redirect on submisssion

?>
