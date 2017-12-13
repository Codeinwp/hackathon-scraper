<?php

require_once 'app/class-scrapper-link-grabber.php';
require_once 'app/class-scrapper-parser.php';

define( 'ROOT', dirname( __FILE__ ) );


$grabber = new Link_Grabber();
$test_links = $grabber->get_links()->slice(1 )->to_array();

//print_r( $test_links );
//
foreach ( $test_links as $page ) {
	$parser = new Scrapper_Parser( $page['link'] );
	$content = $parser->getContent();

	$doc = new DOMDocument();
	libxml_use_internal_errors(true);
	$doc->loadHTML( $content );
	libxml_clear_errors();

	print_r( $doc->getElementById('carousel-hestia-generic') );
}