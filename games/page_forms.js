jQuery('document').ready(function(){
    jQuery('#fp_stm_add_row_btn').click(function(){
        jQuery('#fp_stm_final_row').before('<tr class="fp_stm_row_periods"><td class="fp_stm_first_col"><input type="text" /></td><td class="fp_stm_period_col">x</td><td class="fp_stm_last_col"><input type="text" /></td><td class="fp_stm_remove_col"><a href="#fp_stm_sectionid" class="button-secondary">-</a></td></tr>');
        jQuery('.fp_stm_remove_col a').click(function() { fp_stm_removeRow( jQuery(this) ) } );
        fp_stm_setRowNumbers();
        return false;
    })
    
    jQuery('.fp_stm_remove_col a').click(function(){fp_stm_removeRow(jQuery(this))});
    
    fp_stm_setRowNumbers();
})

function fp_stm_setRowNumbers(){
    var currentRowNumber = 1;
    
    jQuery('.fp_stm_row_periods').each(function(){
        jQuery(this).find('.fp_stm_period_col').html(currentRowNumber);
        currentRowNumber++;
    })
}

function fp_stm_removeRow(objectToRemove){
    objectToRemove.parent().parent().remove();
    fp_stm_setRowNumbers();
    return false;
}