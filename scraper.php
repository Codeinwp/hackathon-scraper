<?php

require_once 'app/class-scrapper-link-grabber.php';
require_once 'app/class-scrapper-parser.php';

define( 'ROOT', dirname( __FILE__ ) );


$grabber = new Link_Grabber();
print_r( $grabber->get_links()->slice(5 )->to_array() );
print_r( $grabber->get_links()->slice(-2 )->to_json() );

$parser = new Scrapper_Parser( 'http://morshed-alam.com/' );

$content = $parser->getContent();

