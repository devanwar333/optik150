<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function initialize_pagination($config) {
    // Load the CI instance
    $CI =& get_instance();
    
    
    $default_config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';
    $default_config['full_tag_close'] = '</ul></nav>';
    $default_config['num_tag_open'] = '<li class="page-item">';
    $default_config['num_tag_close'] = '</li>';
    $default_config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
    $default_config['cur_tag_close'] = '</a></li>';
    $default_config['next_link'] = 'Next';
    $default_config['next_tag_open'] = '<li class="page-item">';
    $default_config['next_tag_close'] = '</li>';
    $default_config['prev_link'] = 'Previous';
    $default_config['prev_tag_open'] = '<li class="page-item">';
    $default_config['prev_tag_close'] = '</li>';
    $default_config['first_link'] = 'First';
    $default_config['first_tag_open'] = '<li class="page-item">';
    $default_config['first_tag_close'] = '</li>';
    $default_config['last_link'] = 'Last';
    $default_config['last_tag_open'] = '<li class="page-item">';
    $default_config['last_tag_close'] = '</li>';
    $default_config['next_tag_open'] = '<li class="page-item">';
    $default_config['next_tag_close'] = '</li>';
    $default_config['prev_tag_open'] = '<li class="page-item">';
    $default_config['prev_tag_close'] = '</li>';
    $default_config['attributes'] = array('class' => 'page-link');
    
    // Merge with custom config
    $config = array_merge($default_config, $config);

    // Initialize pagination
    $CI->pagination->initialize($config);
}
