<?php

require_once 'app/class-scrapper-link-grabber.php';
require_once 'app/class-scrapper-parser.php';
require_once 'app/class-scrapper-check.php';

define( 'ROOT', dirname( __FILE__ ) );

$grabber = new Link_Grabber();

$test_links = $grabber->get_links()->slice(1 )->to_array();

$scrapper_check = new Scrapper_Check( $test_links );

$result = $scrapper_check->checkTheme()->to_array();

var_dump($result);



