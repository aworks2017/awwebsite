jQuery(document).ready(function() {
    jQuery('.custom_datepicker_field').datepicker({
        showAnim : 'slideDown',
        showOn: "button",
        buttonImage: wpc_custom_fields.plugin_url + "images/calendar.gif",
        buttonImageOnly: true,
        buttonText: wpc_custom_fields.buttonText,
        onSelect : function() {
            var d = jQuery(this).datepicker('getDate');
            d.setHours(0, -d.getTimezoneOffset(), 0, 0);
            jQuery(this).nextUntil('input[type="hidden"]').next().val( d.getTime() / 1000 );
        }
    });
    jQuery('.custom_datepicker_field').datepicker( "option", wpc_custom_fields.regional );

    jQuery('.custom_datepicker_field').each(function() {
        var obj = jQuery(this);
        jQuery(this).nextUntil('input[type="hidden"]').next().change(function() {
            var time = jQuery(this).val();
            if( time != '' && time * 1 > 0 ) {
                var d = new Date();
                d.setTime( ( time * 1 + d.getTimezoneOffset()*60 ) * 1000 );
                obj.datepicker( "setDate", d );
            } else {
                obj.val('');
            }
        });
        jQuery(this).nextUntil('input[type="hidden"]').next().trigger('change');
    });

    jQuery('.custom_datepicker_field').change(function() {
        var value = jQuery(this).val();
        if( value != '' ) {
            var d = jQuery(this).datepicker('getDate');
            d.setHours(0, -d.getTimezoneOffset(), 0, 0);
            value = d.getTime() / 1000;
        } else {
            value = '';
        }
        jQuery(this).nextUntil('input[type="hidden"]').next().val( value );
    });

    jQuery('.custom_datepicker_field').keypress(function (event) {
        var key = event.which || event.keyCode;
        if (key <= 13) {
            return true;
        }
        return false;
    });

    jQuery('.custom_datepicker_field').click(function (event) {
        jQuery(this).next().trigger('click');
    });
});

function change_datepicker_field( obj ) {

}