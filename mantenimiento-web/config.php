<?php

    // Constantes a editar en función del servidor DESARROLLO/PRODUCCION
	define( 
        'CDP_MANTENIMIENTO_MODO_DESARROLLO', 
        0
    );

    // Constantes no editables en función del modo de desarrollo
	define( 
        'CDP_MANTENIMIENTO_DIR_RAIZ', 
        dirname( __FILE__ ) . '/' 
    );
    define( 
        'CDP_MANTENIMIENTO_FICHERO_PLUGIN', 
        dirname( __FILE__ ) . '/mantenimiento-web.php' 
    );
	define( 
        'CDP_MANTENIMIENTO_URL_RAIZ', 
        plugins_url( '/', __FILE__ ) 
    );
    define( 
        'CDP_MANTENIMIENTO_DIR_FRONTAL',
        CDP_MANTENIMIENTO_DIR_RAIZ . '/frontal'
    );
    define( 
        'CDP_MANTENIMIENTO_URL_FRONTAL', 
        CDP_MANTENIMIENTO_URL_RAIZ . '/frontal'
    );
	define( 
        'CDP_MANTENIMIENTO_LOG_ACTIVO', 
        0
    );
	define( 
        'CDP_MANTENIMIENTO_DIR_LOG', 
        CDP_MANTENIMIENTO_DIR_RAIZ . '/logs' 
    );
	define( 
        'CDP_MANTENIMIENTO_FICHERO_LOG', 
        CDP_MANTENIMIENTO_DIR_LOG . '/' . date( 'Y-m-d' ) . '.txt' 
    );
	
    // Mostrar errores, sólo en desarrollo
    if( CDP_MANTENIMIENTO_MODO_DESARROLLO )
    {
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );
        ini_set( "log_errors", 1 );
        ini_set( "error_log", CDP_MANTENIMIENTO_DIR_LOG . '/php-error.log' );
        date_default_timezone_set( 'Europe/Madrid' );
    }

    // Autocarga de clases
    spl_autoload_register( function( $class ) {
        if( class_exists( $class ) )
            return;
        if( strpos( $class, "cdp_mweb\\" ) !== 0 )
            return;
        $filename = 
            dirname( __FILE__ ) . 
            '/lib/' . 
            substr( $class, strlen( "cdp_mweb\\" ) ) . '.php'
            ;
        require_once $filename;
    } );

?>