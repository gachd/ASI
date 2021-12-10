<?php

if (!function_exists('ip_hosting')) {

    /**
     * Envia la ip del hosting al servidor,
     * Esto debe cambiar si la ip del servidor cambia
     *  @return ip_hosting  */

    function ip_hosting()
    {
        $ip_hosting = "186.64.118.200";
        return $ip_hosting;
    }
}

if (!function_exists('es_localhost')) {

    /**
     * Envia la ip del hosting al servidor,
     * Esto debe cambiar si la ip del servidor cambia
     *  @return booleano   */

    function es_localhost()
    {
        if ($_SERVER['SERVER_NAME'] == 'localhost' or $_SERVER['SERVER_ADDR'] == '127.0.0.1') {

            return true;
        } else {
            return false;
        }
    }
}
