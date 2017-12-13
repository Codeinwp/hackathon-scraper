<?php
/**
 * The class for fetching and processing links form a csv file.
 *
 * @link       https://themeisle.com
 * @since      1.0.0
 *
 * @package    Scrapper
 */

/**
 * Class Link_Grabber
 *
 * @since   1.0.0
 * @link       https://themeisle.com
 */
class Link_Grabber {

	/**
	 * Stores the path to the loaded file.
	 *
	 * @since   1.0.0
	 * @access  private
	 * @var     string $path Stores the path to the file.
	 */
	private $path;

	/**
	 * Flag to specify if the first line should be skipped.
	 * Useful if first line is header info.
	 *
	 * @since   1.0.0
	 * @access  private
	 * @var     bool $skip_first_line Flag, if first line should be skipped.
	 */
	private $skip_first_line = true;

	/**
	 * Stores the link results.
	 *
	 * @since   1.0.0
	 * @access  private
	 * @var     array $links The results.
	 */
	private $links = array();

	/**
	 * Link_Grabber constructor.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @param   string $file_name The file name.
	 *
	 * @throws Exception If file is not usable.
	 */
	public function __construct( $file_name = 'hestia_db.csv' ) {

		$this->set_path( $file_name );
	}

	/**
	 * Defines the path to the desired file.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @param $file_name The file name.
	 *
	 * @return bool
	 * @throws Exception If file is not a valid format.
	 */
	public function set_path( $file_name ) {
		$parts = explode( '.', $file_name );
		if ( !empty( $parts ) && $parts[ sizeof( $parts ) - 1 ] == 'csv' ) {
			$this->path = ROOT . '/csv/' . $file_name;
			return true;
		}
		throw new Exception( 'File passed to Link_Grabber is not a vlaid format. Accepted formats are ( .csv );' );
	}

	/**
	 * Getter for path variable.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return string
	 */
	public function get_path() {
		return $this->path;
	}

	/**
	 * Defines the links array.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @param   bool $with_slugs Flag to specify if the slug should be returned too.
	 *
	 * @return $this
	 * @throws Exception If can't open file for read.
	 */
	public function get_links( $with_slugs = true ) {
		if( ! $handle = @fopen( $this->path, "r" ) ) {
			throw new Exception( 'Unable to open specified file: ' . $this->path );
		}

		if ( $this->skip_first_line ) {
			//Adding this line will skip the reading of th first line from the csv file and the reading process will begin from the second line onwards
			fgetcsv( $handle );
		}

		$links = array();
		while ( ( $data = fgetcsv( $handle, 1000, "," ) ) !== false ) {
			$item['link'] = $data[0];
			if ( $with_slugs ) {
				$item['slug'] = $data[1];
			}
			array_push( $links, $item );
		}
		$this->links = $links;

		return $this;
	}

	/**
	 * Utility method to slice the results.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @param   int $length The desired length from start or end.
	 *
	 * @return $this
	 */
	public function slice( $length = 0 ) {
		$links = $this->links;
		$offset = 0;
		if ( $length < 0 ) {
			$offset = $length;
			$length = $length * ( -1 );
		}
		if ( $length != 0 ) {
			$links = array_slice( $this->links, $offset, $length );
		}
		$this->links = $links;

		return $this;
	}

	/**
	 * Utility method to return results as array.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return array
	 */
	public function to_array() {
		return $this->links;
	}

	/**
	 * Utility method to return results as json.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @return string
	 */
	public function to_json() {
		return json_encode( $this->links );
	}

}