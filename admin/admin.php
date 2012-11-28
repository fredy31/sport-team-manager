<?php

/*
 * Creates the managing administration
 */
    
    register_activation_hook(__FILE__, 'fp_stm_add_defaults_fn');
    
    /*
     * Adds default values on Plugin Activation.
     */
    function fp_stm_add_defaults_fn(){
         $arr = array("win_points"=>"Win", "comb_inn" => "Combined");
         update_option('fp_stm_admin_options_group', $arr);
    }
    
    add_action( 'admin_menu', 'fp_stm_add_options_menu' );
    
    /*
     * Registers the options page to the admin menu.
     */
    function fp_stm_add_options_menu(){
        add_menu_page( __('Sports Team Manager'), __('Sports Team Manager'), 'edit_posts', 'stm_options_page', 'fp_stm_build_options_page', NULL, 100 );
        add_action( 'admin_init', 'fp_stm_register_admin_settings' );
    }

    /*
     * Creates the Admin Options page.
     *
     */
    function fp_stm_build_options_page(){
        //Add JS needed to run the admin
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_register_script( 'fp_stm_admin_js', plugins_url( 'admin.js', __FILE__ ), array('jquery','media-upload','thickbox') );
        wp_enqueue_script('fp_stm_admin_js');
        wp_enqueue_style('thickbox');
        ?>
        <div class="wrap">
            <div class="icon32" id="icon-options-general"><br></div>
            <h2><?php _e('Sports Team Manager') ?></h2>
            <form method="post" action="options.php">
                <?php
                    settings_fields( 'fp_stm_admin_options_group' );
                    //do_settings_fields( 'fp_stm_admin_options_group',  'fp_stm_main_settings' );
                    do_settings_sections(__FILE__);
                    submit_button();
                ?>
            </form>
        </div>
        <?php
    }
    
    /*
     *  Creates admin settings. Based off tutorials:
     *      http://www.presscoders.com/2010/05/wordpress-settings-api-explained/
     *      http://ottopress.com/2009/wordpress-settings-api-tutorial/
     *  Contains:
     *      Round win or score every round?
     *      Determine winner by number of innings won or innings score combined?
     */
    function fp_stm_register_admin_settings(){
        register_setting( 'fp_stm_admin_options_group', 'fp_stm_admin_options', 'fp_stm_general_settings_validate' );
        
        add_settings_section('fp_stm_main_settings', __('General Plugin Settings'), 'fp_stm_main_settings', __FILE__);
        
        add_settings_field('fp_stm_team_logo', __('Team logo'), 'fp_stm_show_team_logo', __FILE__, 'fp_stm_main_settings' );
        
        add_settings_field('fp_stm_team_name', __('Team Name'), 'fp_stm_show_team_name', __FILE__, 'fp_stm_main_settings' );
        add_settings_field('fp_stm_team_abbr', __('Team Abbreviation'), 'fp_stm_show_team_abbr', __FILE__, 'fp_stm_main_settings' );

        //Period options        
        add_settings_field('fp_stm_win_or_points', __('Win or Number of points?'), 'fp_stm_show_win_or_points', __FILE__, 'fp_stm_main_settings' );
        add_settings_field('fp_stm_combine_or_innings', __('Win by combined points or innings won?'), 'fp_stm_show_combine_or_innings', __FILE__, 'fp_stm_main_settings' );

        //Player stats options
        add_settings_field('fp_stm_stats_perPeriod_completeGame', __('Player stats per period or per full game'), 'fp_stm_show_stats_perPeriod_completeGame', __FILE__, 'fp_stm_main_settings' );
    }
    
    /*
     * Adds a text before the options on the option page.
     */
    function fp_stm_main_settings(){
        echo '<p>' . __('Here are the main settings of the plugin') . '</p>';
    }
    
    /*
     * Creates the team logo field (image)
     */
    function fp_stm_show_team_logo(){
        $options = get_option('fp_stm_admin_options');
        $fp_stm_last_img_url = wp_get_attachment_image_src($options['team_logo'],'thumbnail');
        if(isset($fp_stm_last_img_url[0])){
            echo '<div id="fp_stm_team_logo_admin"><img src="'.$fp_stm_last_img_url[0].'" /></div>';
        }else{
            echo '<div id="fp_stm_team_logo_admin" style="display:none;"></div>';
        }
        echo '  <input class="upload" type="hidden" name="plugin_options[team_logo]" value="'.$fp_stm_last_img_url[0].'" />
                <input class="upload-button" type="button" name="wsl-image-add" value="'.__('Upload Image').'" />
                <input class="delete-button" type="button" name="" value="'.__('Delete image').'" />';
    }
    
    /*
     * Creates the Win or Score Field (Radio Button)
     */
    function fp_stm_show_team_name(){
        $options = get_option('fp_stm_admin_options');
	echo "<label><input value='".$options["team_name"]."' name='plugin_options[team_name]' type='text' /></label><br />";
    }
    
    /*
     * Creates the Win or Score Field (Radio Button)
     */
    function fp_stm_show_team_abbr(){
        $options = get_option('fp_stm_admin_options');
	   echo "<label><input value='".$options["team_abbr"]."' name='plugin_options[team_abbr]' type='text' /></label><br />";
    }
    
    /*
     * Creates the Win or Score Field (Radio Button)
     */
    function fp_stm_show_win_or_points(){
        $options = get_option('fp_stm_admin_options');
    	$items = array("Win", "Points");
    	foreach($items as $item) {
    		$checked = ($options['win_points']==$item) ? ' checked="checked" ' : '';
    		echo "<label><input ".$checked." value='$item' name='plugin_options[win_points]' type='radio' />$item</label><br />";
    	}
    }
    
    /*
     * Creates the Combined or Innings Field (Radio Button)
     */
    function fp_stm_show_combine_or_innings(){
        $options = get_option('fp_stm_admin_options');
    	$items = array("Combined", "Innings");
    	foreach($items as $item) {
    		$checked = ($options['comb_inn']==$item) ? ' checked="checked" ' : '';
    		echo "<label><input ".$checked." value='$item' name='plugin_options[comb_inn]' type='radio' />$item</label><br />";
    	}
    }

    /*
     * Creates the full game or per period (player stats) field (Radio button)
     *
     */

    function fp_stm_show_stats_perPeriod_completeGame(){
        $options = get_option('fp_stm_admin_options');
        $items = array("Per period", "Full game");
        foreach($items as $item) {
            $checked = ($options['period_game']==$item) ? ' checked="checked" ' : '';
            echo "<label><input ".$checked." value='$item' name='plugin_options[period_game]' type='radio' />$item</label><br />";
        }
    }
    
    /*
     * Validates the outputs sent to the options.php page
     */
    function fp_stm_general_settings_validate($input){
        // Check our textbox option field contains no HTML tags - if so strip them out
        
        $_POST['plugin_options']['team_logo'] = get_attachment_id_from_src($_POST['plugin_options']['team_logo']);
        
	return $_POST['plugin_options']; // return validated input
    }
    
    /*
     * Gives out ID of the image when is uploaded (makes it easier to manipulate the image afterwards)
     * 
     */    
    function get_attachment_id_from_src ($image_src) {

        global $wpdb;
        $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
        $id = $wpdb->get_var($query);
        return $id;

    }
    
?>
