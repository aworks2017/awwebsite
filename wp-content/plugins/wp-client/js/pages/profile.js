jQuery( document ).ready( function( $ ) {           

    jQuery( "#btnAdd" ).on( 'click', function() {

        var msg = '';

        var emailReg = /^([\w-+\.]+@([\w-]+\.)+[\w-]{2,})?$/;

        if ( jQuery( "#contact_name" ).val() == '' ) {
            msg += "Contact Name required.<br/>";
        }

        if ( jQuery( "#contact_email" ).val() == '' ) {
            msg += "Email required.<br/>";
        } else if ( !emailReg.test( jQuery( "#contact_email" ).val() ) ) {
            msg += "Invalid Email.<br/>";
        }

        if ( jQuery( "#contact_password" ).val() != '' ) {
            if ( jQuery( "#contact_password2" ).val() == '' ) {
                msg += "Confirm New Password required.<br/>";
            } else if ( jQuery( "#contact_password" ).val() != jQuery( "#contact_password2" ).val() ) {
                msg += "Passwords are not matched.<br/>";
            }
        }

        if ( msg != '' ) {
            if( jQuery( "#message" ).hasClass('message_green') ) {
                jQuery( "#message" ).removeClass('message_green');
                jQuery( "#message" ).addClass('message_red');
            } else {
                jQuery( "#message" ).addClass('message_red');
            }
            jQuery( "#message" ).html( msg );
            jQuery( "#message" ).show();
            return false;
        }
    });
    
    $( '.indicator-hint' ).html( wpc_password_protect.hint_message );
        
    $( 'body' ).on( 'keyup', '#contact_password, #contact_password2',
        function( event ) {
            checkPasswordStrength(
                $('#contact_password'),        
                $('#contact_password2'), 
                $('#pass-strength-result'),           
                $('#btnAdd'),    
                wpc_password_protect.blackList
            );
        }
    );
    
});