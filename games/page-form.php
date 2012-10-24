<?php

/*
 * This file creates the form needed for game statistics
 */
?>

<?php
    $fp_stm_options = get_option('fp_stm_admin_options');
    $fp_stm_last_img_url = wp_get_attachment_image_src($fp_stm_options['team_logo'],'thumbnail');
    
    wp_enqueue_style('fp-stm-page-form', plugins_url( 'page-form-css.css', __FILE__ ));
    
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_register_script( 'fp_stm_admin_js', plugins_url( '../admin/admin.js', __FILE__ ), array('jquery','media-upload','thickbox') );
    wp_enqueue_script('fp_stm_admin_js');
    wp_register_script( 'fp_stm_page_forms_js', plugins_url( 'page_forms.js', __FILE__ ), array('jquery','media-upload','thickbox') );
    wp_enqueue_script('fp_stm_page_forms_js');
    wp_enqueue_style('thickbox');
?>

<h4><?php _e('Against Team') ?></h4>

<table>
    
    <tr>
        <td><label><?php _e('Team Logo:') ?></label></td>
        <td>
            <div id="fp_stm_team_logo_admin"></div>
            <input class="upload" type="hidden" name="plugin_options[team_logo]" value="" />
            <input class="upload-button" type="button" name="wsl-image-add" value="<?php _e('Upload Image') ?>" />
            <input class="delete-button" type="button" name="" value="<?php _e('Delete image') ?>" />
        </td>
    </tr>
    
    <tr>
        <td><label><?php _e('Team Name:') ?></label></td>
        <td><input value='' name='plugin_options[team_abbr]' type='text' /></td>
    </tr>
    
    <tr>
        <td><label><?php _e('Team Abbreviation:') ?></label></td>
        <td><input value='' name='plugin_options[team_abbr]' type='text' /></td>
    </tr>
    
</table>

<h4><?php _e('End Score') ?></h4>
<table class="fp_stm_meta_page">
    <tr>
        <th class="fp_stm_first_col">
            <img src="<?php echo $fp_stm_last_img_url[0] ?>" class="fp_stm_admin_team_picture" />
            <h2><?php _e('Your Team'); ?></h2>
            <p>[<?php echo $fp_stm_options['team_abbr']; ?>] <?php echo $fp_stm_options['team_name']; ?></p>
        </th>
        <th>P.</th>
        <th class="fp_stm_last_col">
            <img src="<?php echo $fp_stm_last_img_url[0] ?>" class="fp_stm_admin_team_picture" />
            <h2><?php _e('Against Team') ?></h2>
            <p>[TT] Test Team</p>
        </th>
        <th></th>
    </tr>
    <tr class="fp_stm_row_periods">
        <td class="fp_stm_first_col"><input type="text" /></td>
        <td class="fp_stm_period_col">x</td>
        <td class="fp_stm_last_col"><input type="text" /></td>
        <td class="fp_stm_remove_col"><a href="#fp_stm_sectionid" class="button-secondary">-</a></td>
    </tr>
    <tr id="fp_stm_final_row">
        <td colspan="4">
            <a href="#fp_stm_sectionid" class="button-primary fp_stm_right" id="fp_stm_add_row_btn"><?php _e('Add row'); ?></a>
        </td>
    </tr>
</table>

<input type="hidden" value="" id="fp_stm_nbPeriods" name="fp_stm_nbPeriods" />
