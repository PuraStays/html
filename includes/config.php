<?php
	/**
	 * Configuration file based on different enviornment
	 * dev -> development, prod -> production, test -> test
	 */	
	define( 'ENV', 'prod'); //dev -> development, prod -> production, test -> test

	if ( ENV == 'dev' ) {
		define( 'STATIC_ROOT', 'http://localhost/purastays/pura_web' );
		define( 'PURA_HOST', '127.0.0.1' );
		define( 'PURA_USER', 'root');
		define( 'PURA_PASSWORD', 'root');
		define( 'PURA_DATABASE', 'purastays');
	}

	if ( ENV == 'prod' ) {
		define( 'STATIC_ROOT', 'http://www.purastays.com' );
		define( 'PURA_HOST', '52.76.246.184' );
		define( 'PURA_USER', 'sanghu');
		define( 'PURA_PASSWORD', 'sanghu');
		define( 'PURA_DATABASE', 'purastays');
	}

?>
