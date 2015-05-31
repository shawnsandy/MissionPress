<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Theme customizer defaults
 */

$cutomizer = MpLoader\Customizer\Setup::factory();
$settings = MpLoader\Customizer\Settings::add_section('bj_settings', 'Settings', 'Theme settings',5);
$mission_settings = MpLoader\Customizer\Settings::factory();
$mission_settings::add_option($settings, 'site_offline', 'Put Site Offline')->set_control_type('checkbox')->customizer();
