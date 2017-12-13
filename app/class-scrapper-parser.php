<?php
class Scrapper_Parser {

    /**
     * The target website url to parse
     * @var string
     */
    public $target_url = '';

    /**
     * Grabbed html content from target website
     * @var text
     */
    public $content = null;

    /**
     * DOMDocument instance
     * @var object
     */
    private $doc;

    /**
     * cUrl options
     * @var Array
     */
    private $curl_options = array(
        CURLOPT_RETURNTRANSFER => true, // return web page
        CURLOPT_HEADER => false, // don't return headers
        CURLOPT_FOLLOWLOCATION => true, // follow redirects
        CURLOPT_ENCODING => "", // handle all encodings
        CURLOPT_USERAGENT => "spider", // who am i
        CURLOPT_AUTOREFERER => true, // set referrer on redirect
        CURLOPT_CONNECTTIMEOUT => 60, // timeout on connect
        CURLOPT_TIMEOUT => 120, // timeout on response
        CURLOPT_MAXREDIRS => 5, // stop after 10 redirects
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false
    );

    /**
     * Class constructor
     * @param string $url Target Url to parse
     */
    public function __construct( $url ) {
        $this->_isCurl();
        $this->target_url = $url;
    }

    /**
     * The class destructor.
     *
     * Explicitly clears Parser object from memory upon destruction.
     */
    public function __destruct() {
        unset( $this );
    }

    private function _isCurl() {
        if ( ! function_exists('curl_version' ) ) {
            die( 'cUrl library is not enabled on this server.' );
        }
    }

    /**
     * A public function to grab and return content
     * @params boolean $grab, flag to perform real time grab or use class content
     * @returned text $content, truncated text
     */
    public function getContent( $grab = true ) {
        if ( $grab )
            $this->content = $this->grabContent();
        return $this->content;
    }

    /**
     * Extract style.css file
     * @returned string $style_link, style.css link file
     */
    private function getStyleCssFile()  {

        if ( $this->doc == null ) {
            return false;
        }

        $links = $this->doc->getElementsByTagName('link');

        foreach ( $links as $link ) {
            if( $link->getAttribute( 'type' ) == 'text/css' ) {
                if ( preg_match("/\/style.css/",$link->getAttribute( 'href' ) ) ) {
                    return $link->getAttribute( 'href' );
                }
            }
        }

        return '';
    }

    /**
     * Check if file has key: value elements
     * @params string $key, key to find
     * @params string $value, value to find
     * @returned boolean, wheter the key => value elements were found
     */
    public function getElementFromStyle( $key = null, $value = null ) {

        $url = $this->getStyleCssFile();

        if ( ! empty( $url ) ) {
            $content = $this->grabContent( $url );

            $pattern = "/" . $key . ":(.*)" . $value . "/";
            if ( preg_match( $pattern, $content ) ) {
                return true;
            }
        }

        return false;
    }

    /**
     * A private method grabs website content using cUrl
     * And put content it into a class variable
     * Can be replace by file_get_contents() but it's very slow, cpu intensive
     * and does not handle redirects, caching, cookies, etc.
     */
    private function grabContent( $url = null ) {

        $content = null;

        $curl_url = $this->target_url;

        if ( ! empty( $url ) ) {
            $curl_url = $url;
        }
        try {
            $ch = curl_init( $curl_url );

            curl_setopt_array($ch, $this->curl_options);

            $content = curl_exec($ch);
            if ($this->content === FALSE) {
                throw new Exception();
            }
        } catch (Exception $e) {
            $this->message = 'Unable to grab site contents';
        }
        curl_close($ch);

        return $content;
    }

    /**
     * Set the DOMDocument
     */
    public function setDoc() {
    	if ( $this->content ) {
		    $doc = new DOMDocument();
		    libxml_use_internal_errors(true);
		    $doc->loadHTML( $this->content );
		    libxml_clear_errors();
		    $this->doc = $doc;
	    }
    }

    /**
     * Check if file has class from classes list
     * @params array $class_list, list of ids to look for
     * @returned boolean, wheter one of the classes was found
     */
    public function hasOneOfClass( $class_list = array() ) {
	    if ( empty( $class_list ) ) {
		    return false;
	    }

	    if ( $this->doc == null ) {
		    return false;
	    }

	    $finder = new DomXPath( $this->doc );
	    foreach ( $class_list as $element_class ) {
		    $nodes = $finder->query( "//*[contains(@class, '$element_class')]" );
		    if( $nodes->length > 0 ) {
		    	return true;
		    }
	    }
	    return false;
    }

    /**
     * Check if file has id from ids list
     * @params array $id_list, list of ids to look for
     * @returned boolean, wheter one of the ids was found
     */
    public function hasOneOfIds( $id_list = array() ) {
    	if ( empty( $id_list ) ) {
    		return false;
	    }

	    if ( $this->doc == null ) {
    		return false;
	    }

	    foreach ( $id_list as $element_id ) {
		    if ( $this->doc->getElementById( $element_id ) != null ) {
		    	return true;
		    }
	    }
	    return false;
    }
}
