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
 * @author carlosdoral
 *
 */
class Mensajes
{
    /**
     *
     */
    private static function agregar( $tipo, $texto )
    {
        $mensajes = unserialize( get_option( MantenimientoWeb::WP_OPTION_MENSAJES ) );
        if( !is_array( $mensajes ) )
            $mensajes = [];
        $mensajes[] = [ 'tipo' => $tipo, 'texto' => $texto ];
        update_option( MantenimientoWeb::WP_OPTION_MENSAJES, serialize( $mensajes ) );
    }
    
    /**
     * 
     */
    static function aviso( $texto )
    {
        Mensajes::agregar( 'aviso', $texto );
    }

    /**
     *
     */
    static function error( $texto )
    {
        Mensajes::agregar( 'error', $texto );
    }

    /**
     *
     */
    static function dame()
    {
        $mensajes = unserialize( get_option( MantenimientoWeb::WP_OPTION_MENSAJES ) );
        update_option( MantenimientoWeb::WP_OPTION_MENSAJES, serialize( [] ) );
        return is_array( $mensajes ) ? $mensajes : [];
    }
    
    /**
     *
     */
    static function borrar()
    {
        update_option( MantenimientoWeb::WP_OPTION_MENSAJES, serialize( [] ) );
    }    
}

?>