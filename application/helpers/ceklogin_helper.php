<?php

function check_login(){

    $CI         = & get_instance();
    $session    = $CI->session->userdata('status_login');
    if ($session != 'admin'){

        redirect('auth');
    }

}



function check_log(){

    $CI         = & get_instance();
    $session    = $CI->session->userdata('status_login');
    if ($session == 'admin'){

        redirect('dashboard');
    }

}




