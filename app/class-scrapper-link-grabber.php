<?php
class Link_Grabber {

	private $path;

	private $skip_first_line = true;

	private $links = array();

	public function __construct( $file_name = 'hestia_db.csv' ) {

		$this->set_path( $file_name );
	}

	public function set_path( $file_name ) {
		$parts = explode( '.', $file_name );
		if ( !empty( $parts ) && $parts[ sizeof( $parts ) - 1 ] == 'csv' ) {
			$this->path = ROOT . '/csv/' . $file_name;
			return true;
		}
		throw new Exception( 'File passed to Link_Grabber is not a vlaid format. Accepted formats are ( .csv );' );
	}

	public function get_path() {
		return $this->path;
	}

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

	public function to_array() {
		return $this->links;
	}

	public function to_json() {
		return json_encode( $this->links );
	}

}