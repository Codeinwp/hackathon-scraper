<?php

require_once 'app/class-scrapper-link-grabber.php';
require_once 'app/class-scrapper-parser.php';

define( 'ROOT', dirname( __FILE__ ) );


$grabber = new Link_Grabber();

$test_links = $grabber->get_links()->slice(1 )->to_array();

foreach ( $test_links as $page ) {
	$parser = new Scrapper_Parser( $page['link'] );
	$content = $parser->getContent();


	$doc = new DOMDocument();
	libxml_use_internal_errors(true);
	$doc->loadHTML( $content );
	libxml_clear_errors();

    $xpath = new DOMXPath($doc);

    $doc = $xpath->query('//head')->item(0);

    $links = $doc->getElementsByTagName('link');

    foreach ( $links as $link ) {
        if( $link->getAttribute( 'type' ) == 'text/css' ) {
            echo $link->getAttribute( 'href' ).'<br>';
            preg_match("/\/style.css/", $link->getAttribute( 'href' ), $match_title);
            //echo $match_title;
        }
    }
}

