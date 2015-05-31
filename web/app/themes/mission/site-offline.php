<?php

/*
 * Tmplate: Site Offline Page
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */





if (!class_exists('Timber')) {
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
    return;
}

$offline_args = array(
    'post_name' => 'site-offline',
    'post_type' => 'page'
);

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$templates = array('offline.twig');
Timber::render($templates, $context);

