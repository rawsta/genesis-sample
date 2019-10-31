<?php
/**
 * Branding of Backend and Login
 *
 * @package      Raw Child
 * @author       rawsta
 * @since        1.0.0
 * @license      GPL-2.0+
**/

// Login Logo URL
function raw_child_login_headerurl( $url ) {
    return esc_url( home_url() );
}
add_filter( 'login_headerurl', 'raw_child_login_headerurl' );

// Login Logo Title
function raw_child_login_headertext() {
    // $logotitle = get_bloginfo($show = 'name', $filter = 'raw' );
    // return $logotitle;
    return 'Back to Start';
}
add_filter( 'login_headertext', 'raw_child_login_headertext' );

/**
 * Login Logo
 *
 */
function raw_child_login_logo() {

        $logo_path = '/images/logo.svg';
        if( ! file_exists( get_stylesheet_directory() . $logo_path ) )
            return;
        $logo = get_stylesheet_directory_uri() . $logo_path;
    ?>
    <style type="text/css">
        .login h1 a {
            background-image: url(<?php echo $logo;?>);
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center center;
            display: block;
            overflow: hidden;
            text-indent: -9999em;
            width: 312px;
            height: 100px;
        }
        .login label {
            color: #454545;
            display: block;
            margin-bottom: 1em;
            font-weight: bold;
        }

        .login form .input {
            font-weight: normal;
        }

        .login #backtoblog a,
        .login #nav a {
            color: #830000;
        }

        .wp-core-ui .button-primary {
            background: #830000;
        }
    </style>
    <?php
}
add_action( 'login_head', 'raw_child_login_logo' );

// Remember Me always
add_filter( 'login_footer', 'raw_child_remember_me' );

add_action( 'init', 'raw_child_remember_me' );
function raw_child_remember_me() {
    echo "<script>document.getElementById('rememberme').checked = true;</script>";
}
