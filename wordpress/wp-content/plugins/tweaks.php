<?php
/*
  Plugin Name: Sam's Tweaks
  Version:     0
  Description: any little addons to make wordpress work right
*/

add_filter( 'pre_http_request', '__return_true', 100 );

add_action( 'add_meta_boxes', 'extrameta_add_custom_box' );
add_action( 'save_post', 'extrameta_save_postdata' );

function extrameta_add_custom_box() {
    $dd_titlefiller = (get_post_meta($post->ID, 'display_date', true)) ? get_post_meta($post->ID, 'display_date', true) : 'not set';
    add_meta_box(
    	'display_date',
        __( 'actual post date : ' . $dd_titlefiller, 'displaydate_textdomain' ),
        'displaydate_box',
        'post'
    );
}

function displaydate_box( $post ) {
    wp_nonce_field( plugin_basename( __FILE__ ), 'extrameta_noncename' );

    if (get_post_meta($post->ID, 'display_date', true)) $displaydate_filler = get_post_meta($post->ID, 'display_date', true); // show what's already set
	echo
		'<label for="display_date">
			actual display date -- format: mm dd yyyy +oooo<br>(oooo) is the time zone offset, so for nyc it\'d be -0500.<br><br>
		</label>';
	echo '<input type="text" id="display_date" name="display_date" value="' . $displaydate_filler . '"size="50" maxlength="50" /><br/>';

}

function extrameta_save_postdata( $post_id ) {

	// verify if this is an auto save routine.
	// If it is our form has not been submitted, so we dont want to do anything
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( !wp_verify_nonce( $_POST['extrameta_noncename'], plugin_basename( __FILE__ ) ) )
        return;


	// Check permissions
	if ( 'page' == $_POST['post_type'] )
        {
            if ( !current_user_can( 'edit_page', $post_id ) )
                return;
        }
	else
        {
            if ( !current_user_can( 'edit_post', $post_id ) )
                return;
        }

	// OK, we're authenticated: we need to find and save the data


    $the_displaydate = array($_POST['display_date'], 'display_date');
    $metas = array($the_displaydate);

    foreach ($the_displaydate as $item) {
        if ($item[0]) {
            if ($item[0] === 'REMOVE') delete_post_meta($post_id, $item[1]);
            else update_post_meta($post_id, $item[1], $item[0]);
        }
    }
}



?>