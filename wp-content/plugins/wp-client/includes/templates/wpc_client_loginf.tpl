{$login_header}
<div class="main_loginform_block {$classes}">
	{if $src == 'assoc'}
    	<h1>Team Login</h1>
    {else}
    	<p>Welcome Text ro the client portal login page Welcome Text ro the client portal login page</p>
    {/if}
    <div id="login">
    {if $action == 'login'}
        {if !empty($msg_ve)}
            <p class="message">{$msg_ve}</p>
        {/if}
        <form method="post" action="{if !empty($login_url)}{$login_url}{/if}" id="loginform" name="loginform">
            {if !empty($somefields)}{$somefields}{/if}
            {if !empty($error_msg)}
                <p class="message wpc_error">{$error_msg}</p>
            {/if}

            <p>
                <label for="user_login">{if !empty($labels.username)}{$labels.username}{/if}<br>
                <input type="text" tabindex="10" size="20" value="" class="input" id="user_login" name="log"></label>
            </p>
            <p>
                <label for="user_pass">{if !empty($labels.password)}{$labels.password}{/if}<br>
                <input type="password" tabindex="20" size="20" value="" class="input" id="user_pass" name="pwd"></label>
            </p>
            {$do_action_login_form}
            
            {if $src == 'assoc'}
            <span>*If you cannot log in, ask your supervisor for help.*	</span>
            {else}
            <p class="forgetmenot"><label for="rememberme"><input type="checkbox" tabindex="90" value="forever" id="rememberme" name="rememberme"> {if !empty($labels.remember)}{$labels.remember}{/if}</label></p>
            {/if}
            
            <p class="submit">
                <input type="submit" tabindex="100" value="{$texts.login_button}" class="button-primary" id="wp-submit" name="wp-submit">
                <input type="hidden" value="" name="redirect_to">
            </p>
        </form>
        {if isset($lostpassword_href) && !empty($lostpassword_href)}
            <p id="nav">
                <label>
                    <a title="{$texts.lost_password_title}" href="{$lostpassword_href}">{$texts.lost_password}</a>
                </label>
            </p>
        {/if}
    {elseif $action == 'lostpassword' && isset($lostpassword_href) && !empty($lostpassword_href) }
        <form method="post" action="{if !empty($login_url)}{$login_url}{/if}" id="loginform" name="loginform">
            {if !empty($error_msg)}
                <p class="message wpc_error">{$error_msg}</p>
            {/if}
            <p>
                <label for="user_login">{if !empty($labels.email)}{$labels.email}{/if}<br>
                <input type="text" tabindex="10" size="35" value="" class="input" id="user_login" name="user_login"></label>
            </p>
            {$do_action_lostpassword_form}
            <p class="submit">
                <label>
                    <input type="submit" tabindex="100" value="{if !empty($labels.get_new_password)}{$labels.get_new_password}{/if}" class="button button-primary button-large" id="wp-submit" name="wp-submit">
                </label>
            </p>
        </form>
        <p id="nav">
            <label>
                <a title="{$texts.remember_password_title}" href="{$login_href}">{$texts.remember_password}</a>
            </label>
        </p>
    {elseif ( $action == 'rp' || $action == 'resetpass' ) && !empty($lostpassword_href) }
        <form method="post" action="{if !empty($login_url)}{$login_url}{/if}" id="loginform" name="loginform">
            {if !empty($error_msg)}
                <p class="message wpc_error">{$error_msg}</p>
            {/if}
            {if !in_array($error_msg, $check_invalid)}
                <input type="hidden" id="user_login" value="{if !empty($user_login)}{$user_login}{/if}" autocomplete="off" />
                <p>
                    <label for="pass1">{if !empty($labels.new_password)}{$labels.new_password}{/if}<br />
                    <input type="password" name="pass1" id="pass1" class="input" size="35" value="" autocomplete="off" /></label>
                </p>
                <p>
                    <label for="pass2">{if !empty($labels.confirm_new_password)}{$labels.confirm_new_password}{/if}<br />
                    <input type="password" name="pass2" id="pass2" class="input" size="35" value="" autocomplete="off" /></label>
                </p>

                <div id="pass-strength-result">{if !empty($labels.strength_indicator)}{$labels.strength_indicator}{/if}</div>
                <p class="description indicator-hint">{if !empty($labels.hint_indicator)}{$labels.hint_indicator}{/if}</p>
                {$do_action_resetpass_form}
                <br class="clear" />
                <p class="submit"><label><input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="{if !empty($labels.reset_password)}{$labels.reset_password}{/if}" /></label>
                </p>
            </form>
        {/if}
    {/if}
    </div>
</div>