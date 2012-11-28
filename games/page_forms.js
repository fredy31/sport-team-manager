jQuery('document').ready(function(){
    jQuery('#fp_stm_add_row_btn').click(function(){
        //jQuery('#fp_stm_final_row').before('<tr class="fp_stm_row_periods"><td class="fp_stm_first_col"><input type="text" /></td><td class="fp_stm_period_col">x</td><td class="fp_stm_last_col"><input type="text" /></td><td class="fp_stm_remove_col"><a href="#fp_stm_sectionid" class="button-secondary">-</a></td></tr>');

        var fp_stm_row = '<tr class="fp_stm_row_periods">';
        fp_stm_row += jQuery('#fp_stm_row_model').html();
        fp_stm_row += '</tr>';

        jQuery('#fp_stm_final_row').before( fp_stm_row );
        jQuery('.fp_stm_remove_col a').click(function() { fp_stm_removeRow( jQuery(this) ) } );
        fp_stm_setRowNumbers();
        return false;
    })
    
    jQuery('.fp_stm_remove_col a').click(function(){fp_stm_removeRow(jQuery(this))});
    
    fp_stm_setRowNumbers();
})

function fp_stm_setRowNumbers(){
    var currentRowNumber = 0;
    
    jQuery('.fp_stm_row_periods').each(function(){
        jQuery(this).find( '.fp_stm_period_col' ).html( currentRowNumber );

        jQuery(this).find( '.fp_stm_first_col input' ).attr( 'id', 'fp_stm_local_' + currentRowNumber )
        jQuery(this).find( '.fp_stm_last_col input' ).attr( 'id', 'fp_stm_ennemy_' + currentRowNumber )

        if(jQuery('#fp_stm_type').val()=="win"){
            jQuery(this).find( '.fp_stm_first_col input' ).attr( 'name', 'fp_stm_' + currentRowNumber )
            jQuery(this).find( '.fp_stm_last_col input' ).attr( 'name', 'fp_stm_' + currentRowNumber )
        }else{
            jQuery(this).find( '.fp_stm_first_col input' ).attr( 'name', 'fp_stm_local_' + currentRowNumber )
            jQuery(this).find( '.fp_stm_last_col input' ).attr( 'name', 'fp_stm_ennemy_' + currentRowNumber )
        }

        currentRowNumber++;
    })

    jQuery('#fp_stm_nbPeriods').val(currentRowNumber);

}

function fp_stm_removeRow(objectToRemove){
    objectToRemove.parent().parent().remove();
    fp_stm_setRowNumbers();
    return false;
}