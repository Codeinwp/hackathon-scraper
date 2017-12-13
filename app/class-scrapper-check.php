<?php

require_once 'class-scrapper-parser.php';

class Scrapper_Check {

    private $url_list = '';

    private $results = array();

    private $slug_setting = array(
        'hestia' => array(
            'ids' => array( 'hestia_style-css', 'hestia_style-inline-css', 'hestia_fonts-css' ),
            'classes' => array( 'hestia-big-title-content', 'hestia-title', 'hestia-bottom-footer-content', 'hestia-features', 'hestia-testimonials', 'hestia-team ' ),
            'elem' => array( 'Theme Name','Hestia' ),
        ),
        'hestia-pro' => array(
            'ids' => array( 'hestia_style-css', 'hestia_style-inline-css', 'hestia_fonts-css' ),
            'classes' => array( 'hestia-title', 'hestia-bottom-footer-content', 'hestia-features', 'hestia-testimonials', 'hestia-work', 'hestia-team ' ),
            'elem' => array( 'Theme Name','Hestia Pro' ),
        ),
    );

    /**
     * Class constructor
     */
    public function __construct( $url_list ) {
        $this->url_list = $url_list;
    }

    public function checkTheme() {

        $results = array();

        foreach ( $this->url_list as $page ) {

            $parser = new Scrapper_Parser( $page['link'] );
            $parser->getContent();
            $parser->setDoc();

            $check_id = $parser->hasOneOfIds( $this->slug_setting[$page['slug']]['ids'] );
            $check_class = $parser->hasOneOfClass( $this->slug_setting[$page['slug']]['classes']  );
            $check_elem = $parser->getElementFromStyle( $this->slug_setting[$page['slug']]['elem'][0], $this->slug_setting[$page['slug']]['elem'][1]  );

            if ( $check_class && $check_id && $check_elem ) {
                array_push( $results, true );
            } else {
                array_push( $results, false );
            }

        }

        $this->results = $results;

        return $this;
    }

    public function to_array() {
        return $this->results;
    }

    public function to_json() {
        return json_encode( $this->results );
    }

}