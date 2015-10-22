
jQuery( document ).ready( function( $ ) {

//   jQuery( "#message" ).hide();

    jQuery( "#update_user" ).on( 'click', function() {

        var msg = '';

        var emailReg = /^([\w-+\.]+@([\w-]+\.)+[\w-]{2,})?$/;

        if ( jQuery( "#user_login" ).val() == '' ) {
            msg += "A username is required.<br/>";
        }

        if ( jQuery( "#email" ).val() == '' ) {
            msg += "Email required.<br/>";
        } else if ( !emailReg.test( jQuery( "#email" ).val() ) ) {
            msg += "Invalid Email.<br/>";
        }


        if ( jQuery( '#update_password' ).length == 0 || jQuery( "#update_password" ).is(':checked') ) {
            if ( jQuery( "#pass1" ).val() == '' ) {
                msg += "Password required.<br/>";
            } else if ( jQuery( "#pass2" ).val() == '' ) {
                msg += "Confirm Password required.<br/>";
            } else if ( jQuery( "#pass1" ).val() != jQuery( "#pass2" ).val() ) {
                msg += "Passwords are not matched.<br/>";
            }
        }


        if ( msg != '' ) {
            jQuery( "#message" ).html( msg );
            jQuery( "#message" ).show();
            return false;
        }
    });        

    jQuery("#update_password").click( function() {
        if( jQuery(this).is(':checked') || jQuery(this).attr('checked') || jQuery(this).attr('checked') == 'checked' ) {
            jQuery(".passwords_block").show();
        } else {
            jQuery(".passwords_block").hide();
        }
        //if(  )
    });
    
    $( '.indicator-hint' ).html( wpc_password_protect.hint_message );
        
    $( 'body' ).on( 'keyup', '#pass1, #pass2',
        function( event ) { 
            checkPasswordStrength(
                $('#pass1'),        
                $('#pass2'), 
                $('#pass-strength-result'),           
                $('#update_user'),    
                wpc_password_protect.blackList
            );
        }
    );

});