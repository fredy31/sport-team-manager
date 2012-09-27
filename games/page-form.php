<?php

/*
 * This file creates the form needed for game statistics
 */
?>

<?php
    $fp_stm_options = get_option('fp_stm_admin_options');
    $fp_stm_last_img_url = wp_get_attachment_image_src($fp_stm_options['team_logo'],'thumbnail');
    
    wp_enqueue_style('fp-stm-page-form', plugins_url( 'page-form-css.css', __FILE__ ));
?>

<table class="fp_stm_meta_page">
    <tr>
        <th class="fp_stm_first_col">
            <img src="<?php echo $fp_stm_last_img_url[0] ?>" class="fp_stm_admin_team_picture" />
            <h2><?php _e('Your Team'); ?></h2>
            <p>[<?php echo $fp_stm_options['team_abbr']; ?>] <?php echo $fp_stm_options['team_name']; ?></p>
        </th>
        <th>P.</th>
        <th class="fp_stm_last_col"><h2><?php _e('Ennemy Team') ?></h2></th>
    </tr>
    
</table>
