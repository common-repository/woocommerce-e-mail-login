<?php
/*
 * Plugin Name: WooCommerce E-mail Login
 * Plugin URI: https://www.mikaeldui.se/woocommerce-email-login
 * Description:  Enables you and your customers to login with your e-mail address as well as your username.
 * Version: 1.0
 * Author: Mikael Dúi Bolinder
 * Author URI: https://www.mikaeldui.se/
 * License: GPL2
 */

/**
 // Allow customers to login with their email address or username
**/
add_filter('authenticate', 'wc_email_login_allow', 20, 3);

/**
 * internet_allow_email_login filter to the authenticate filter hook, to fetch a username based on entered email
 * @param  obj $user
 * @param  string $username [description]
 * @param  string $password [description]
 * @return boolean
 */
function wc_email_login_allow( $user, $username, $password ) {
    if ( is_email( $username ) ) {
        $user = get_user_by_email( $username );
        if ( $user ) $username = $user->user_login;
    }
    return wp_authenticate_username_password( null, $username, $password );
}