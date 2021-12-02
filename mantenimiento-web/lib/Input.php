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
class Input
{
	/**
	 *
	 */
	static function post( $var_name, $vdef = null )
	{
	    if( isset( $_POST[$var_name] ) )
	        return trim( $_POST[$var_name] );
	    return $vdef;
	}

	/**
	 *
	 */
	static function get( $var_name, $vdef = null )
	{
	    if( isset( $_GET[$var_name] ) )
	        return trim( $_GET[$var_name] );
        return $vdef;
	}
}

?>