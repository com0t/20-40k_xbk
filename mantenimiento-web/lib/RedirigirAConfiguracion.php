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
class RedirigirAConfiguracion
{
    /**
     * 
     */
    private static $redirigir;
    
    /**
     * 
     */
    static function crear()
    {
        RedirigirAConfiguracion::$redirigir = new RedirigirAConfiguracion(); 
    }
    
	/**
	 * Redirijo cuando el loop del admin haya terminado
	 */
	function __destruct()
	{
	    wp_safe_redirect( admin_url( 'tools.php?page=cdp_mantenimiento_web' ) );
	    exit;
	}
}

?>