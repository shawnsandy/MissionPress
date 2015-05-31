<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of ms-theme-config
 *
 * @author studio-mac
 */
include_once get_template_directory() . '/package/kirki/kirki.php';


    
   class MS_ThemeConfig {
//put your code here
    
    public function __construct() {
        
    }
    
    public static function factory() {
        return new MS_ThemeConfig(); 
    }
    
    
} 


