<?php

	/*
	 * On saving posts.
	 */

	add_action( 'save_post', 'fp_stm_saving_page' );

	function fp_stm_saving_page( $post_id ){
		
		global $post;

		update_post_meta( $post_id, 'fp_stm_nbPeriods', $_POST['fp_stm_nbPeriods'] );

		for( $i=1; $i<=$_POST['fp_stm_nbPeriods']; $i++ ){

			update_post_meta( $post_id, 'fp_stm_local_'.$i, $_POST['fp_stm_local_'.$i] );
			update_post_meta( $post_id, 'fp_stm_ennemy_'.$i, $_POST['fp_stm_ennemy_'.$i] );

		}

		//exit;
	}