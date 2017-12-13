<?php
class Link_Grabber {

	private $path;

	public function __construct( $file_name = 'hestia_db.csv' ) {

		$this->path = ROOT . 'csv/' . $file_name ;


	}

}