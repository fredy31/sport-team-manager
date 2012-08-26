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
        register_setting( 'fp_stm_admin_options_group', 'fp_stm_admin_options_group', 'fp_stm_general_settings_validate' );
        
        add_settings_section('fp_stm_main_settings', __('General Plugin Settings'), 'fp_stm_main_settings', __FILE__);
        
        add_settings_field('fp_stm_win_or_points', __('Win or Number of points?'), 'fp_stm_show_win_or_points', __FILE__, 'fp_stm_main_settings' );
        add_settings_field('fp_stm_combine_or_innings', __('Win by combined points or innings won?'), 'fp_stm_show_combine_or_innings', __FILE__, 'fp_stm_main_settings' );
    }
    
    /*
     * Adds a text before the options on the option page.
     */
    function fp_stm_main_settings(){
        echo __('<p>Here are the main settings of the plugin</p>');
    }
    
    /*
     * Creates the Win or Score Field (Radio Button)
     */
    function fp_stm_show_win_or_points(){
        $options = get_option('fp_stm_admin_options_group');
                    print_r($options);
	$items = array("Win", "Points");
	foreach($items as $item) {
		$checked = ($options['win_points']==$item) ? ' checked="checked" ' : '';
		echo "<label><input ".$checked." value='$item' name='plugin_options[win_points]' type='radio' /> $item</label><br />";
	}
    }
    
    /*
     * Creates the Combined or Innings Field (Radio Button)
     */
    function fp_stm_show_combine_or_innings(){
        $options = get_option('fp_stm_admin_options_group');
	$items = array("Combined", "Innings");
	foreach($items as $item) {
		$checked = ($options['comb_inn']==$item) ? ' checked="checked" ' : '';
		echo "<label><input ".$checked." value='$item' name='plugin_options[comb_inn]' type='radio' /> $item</label><br />";
	}
    }
    
    /*
     * Validates the outputs sent to the options.php page
     */
    function fp_stm_general_settings_validate($input){
        // Check our textbox option field contains no HTML tags - if so strip them out
	$input['text_string'] =  wp_filter_nohtml_kses($input['text_string']);	
	return $input; // return validated input
    }
    
?>
