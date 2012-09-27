<?php

/*
 * Creates all metas needed to store the informations of every game.
 */

    //Add the box for scoring.
    add_action( 'add_meta_boxes', 'fp_stm_add_score_box' );
    add_action( 'save_post', 'fp_stm_save_postdata' );
    
    function fp_stm_add_score_box() {
        add_meta_box( 
            'fp_stm_sectionid',
            __( 'Game scoreboard', 'fp_stm_score_box' ),
            'fp_stm_inner_score_box',
            'stm_games' 
        );
    }
    
    function fp_stm_inner_score_box( $post ) {

        // Use nonce for verification
        wp_nonce_field( plugin_basename( __FILE__ ), 'fp_stm_noncename' );

        // The actual fields for data entry
        require 'page-form.php';
    }

    /* When the post is saved, saves our custom data */
    function fp_stm_save_postdata( $post_id ) {
    // verify if this is an auto save routine. 
        // If it is our form has not been submitted, so we dont want to do anything
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
            return;

        // verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times

        if ( !wp_verify_nonce( $_POST['fp_stm_noncename'], plugin_basename( __FILE__ ) ) )
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

        $mydata = $_POST['fp_stm_new_field'];

        // Do something with $mydata 
        // probably using add_post_meta(), update_post_meta(), or 
        // a custom table (see Further Reading section below)
    }
    
?>
