<?php

require_once 'app/class-scrapper-link-grabber.php';
require_once 'app/class-scrapper-parser.php';

define( 'ROOT', dirname( __FILE__ ) );


$grabber = new Link_Grabber();

$test_links = $grabber->get_links()->slice(1 )->to_array();

foreach ( $test_links as $page ) {
	$parser = new Scrapper_Parser( $page['link'] );
	$content = $parser->getContent();
	$parser->setDoc();

	print_r( $parser->hasOneOfIds( array( 'carousel-hestia-generic' ) ) );
	print_r( $parser->hasOneOfClass( array( 'hestia-title' ) ) );

	print_r( $parser->getElementFromStyle( 'Theme Name','Hestia' ) );

}

