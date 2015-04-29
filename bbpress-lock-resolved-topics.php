<?php
/*
Plugin Name: bbPress Lock Resolved Topics
Plugin URI: http://wordpress.org/plugins/
Description: Disables the ability for non-topic authors to reply to a forum thread once it's resolved
Author: Chris Christoff
Version: 0.9
Author URI: http://www.chriscct7.com
*/

class bbPress_Lock_Resolved_Topics{

	function __construct() {
		add_filter( 'bbp_get_template_part', array( $this, 'dont_show_form_if_resolved' ), 8, 3 );
		add_filter( 'bbp_get_template_stack', array( $this, 'add_template' ), 10, 1 ); 
	}

	public function dont_show_form_if_resolved( $templates, $slug, $name ){
		if ( $slug === 'form' && $name === 'reply' ){
			if ( !function_exists( 'bbp_get_topic_id' ) ){
				return $templates;
			}

			$topic_id = bbp_get_topic_id();
			
			if ( $topic_id && !current_user_can( 'moderate' ) ){
				$status = get_post_meta( $topic_id, '_bbps_topic_status', true );
				if ( $status ){
					$value = $status;
				} else {
					$value = 1;
				}

				if ( $value === 2 || $value === 3 ){
					$user_id = get_the_author_meta( 'ID' );
					if ( get_current_user_id() !== $user_id ){
						return array( 0 => 'form-resolved.php', 1 => 'form.php' );
					}
				}
			}

		}
		return $templates;
	
	}

	public function add_template( $stack ){
		$stack[] = dirname( __FILE__)  . '/bbpress';
		return $stack;
	}
}

// load our class
$GLOBALS['bbpress_lock_resolved_topics'] = new bbPress_Lock_Resolved_Topics();
