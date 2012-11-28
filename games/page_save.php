<?php

	/*
	 * On saving posts.
	 */

	add_action( 'save_post', 'fp_stm_saving_page' );

	function fp_stm_saving_page( $post_id ){
		
		global $post;

		update_post_meta( $post_id, 'fp_stm_nbPeriods', $_POST['fp_stm_nbPeriods']-1 );

		for( $i=1; $i<=$_POST['fp_stm_nbPeriods']-1; $i++ ){

			if( $_POST['fp_stm_type'] == "points" ){
				update_post_meta( $post_id, 'fp_stm_local_'.$i, $_POST['fp_stm_local_'.$i] );
				update_post_meta( $post_id, 'fp_stm_ennemy_'.$i, $_POST['fp_stm_ennemy_'.$i] );
			}else{
				update_post_meta( $post_id, 'fp_stm_'.$i, $_POST['fp_stm_'.$i] );
			}

		}

		//exit;
	}