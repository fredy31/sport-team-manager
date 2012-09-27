jQuery(document).ready(function() {

    var uploadID = ''; /*setup the var in a global scope*/

    jQuery('.upload-button').click(function() {
        uploadID = jQuery(this).prev('input'); /*set the uploadID variable to the value of the input before the upload button*/
        formfield = jQuery('.upload').attr('name');
        tb_show('', 'media-upload.php?type=image&amp;amp;amp;TB_iframe=true');
        return false;
    });

    window.send_to_editor = function(html) {
        imgurl = jQuery('img',html).attr('src');
        uploadID.val(imgurl); /*assign the value of the image src to the input*/
        jQuery('#fp_stm_team_logo_admin').html('<img src="' + imgurl + '" />');
        tb_remove();
        jQuery('#fp_stm_team_logo_admin').css('display','block');
    };
    
    jQuery('.delete-button').click(function(){
        jQuery('.upload').val('');
        jQuery('#fp_stm_team_logo_admin').css('display','none');
    })
});