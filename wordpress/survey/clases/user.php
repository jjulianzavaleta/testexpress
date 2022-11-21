<?php
include 'conexion.php';

if ($_SERVER['SERVER_NAME'] == "localhost"){
    include 'C:/xampp/htdocs/wordpress/wp-load.php';
} else {
    include '/var/www/xpress.chimuagropecuaria.com.pe/public_html/wp-load.php';
}

class User extends Database{
    private $nombre;
    private $username;

    public function userExists($user, $pass){

        $user_login     = esc_attr($user);
        $user_password  = esc_attr($pass);

        
        $creds = array();
        $creds['user_login'] = $user_login;
        $creds['user_password'] = $user_password;
        $creds['remember'] = true;

        $user = wp_signon( $creds, false );

        $isAdmin = $user->caps['administrator'];

        if($isAdmin){
            return true;
        } else {
            return false;
        }
    }

    public function setUser($user){
        $userObj = get_user_by('login', $user);

        $this->nombre = get_user_meta($userObj->ID, 'first_name', true);
        $this->usename = $userObj->display_name;
    }

    public function getNombre(){
        return $this->nombre;
    }
}

?>