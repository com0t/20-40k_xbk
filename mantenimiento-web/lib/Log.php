<?php

/* ======================================================================================
   @author     Carlos Doral Pérez (https://webartesanal.com)
   @version    0.1
   @copyright  Copyright &copy; 2018 Carlos Doral Pérez, All Rights Reserved
               License: GPLv2 or later
   ====================================================================================== */

namespace cdp_mweb;

/**
 *
 */
class Log
{
	/**
	 *
	 */
	static function texto( $texto )
	{
		if( !CDP_MANTENIMIENTO_LOG_ACTIVO )
			return;
		if( !file_exists( dirname( CDP_MANTENIMIENTO_FICHERO_LOG ) ) )
			if( !@mkdir( dirname( CDP_MANTENIMIENTO_FICHERO_LOG ), 0755, true ) )
			{
			    Mensajes::error( 
		            __( "No puedo crear dir log: ", 'cdp_mweb' ) . 
    		        dirname( CDP_MANTENIMIENTO_FICHERO_LOG )
			    );
			    return;
			}
		@file_put_contents( 
			CDP_MANTENIMIENTO_FICHERO_LOG, 
			'[' . date( 'Y-m-d H:i:s' ) . "] $texto\n", 
			FILE_APPEND | LOCK_EX
		);
	}

	/**
	 *
	 */
	static function error( $texto )
	{
	    Log::texto( '[x] ' . $texto );
	}
}

?>