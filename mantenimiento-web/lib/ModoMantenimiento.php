<?php

/* ======================================================================================
   @author     Carlos Doral Pérez (https://webartesanal.com)
   @version    0.3
   @copyright  Copyright &copy; 2018 Carlos Doral Pérez, All Rights Reserved
               License: GPLv2 or later
   ====================================================================================== */

namespace cdp_mweb;

/**
 *
 */
class ModoMantenimiento
{
    /**
     * Cadenas con las vars a almacenar en tabla wp_options
     */
    const WP_OPTION_MODO_MANTENIMIENTO_ACTIVO = 'cdp_mantenimiento_web_mma';
    const WP_OPTION_ID_GOOGLE_ANALYTICS = 'cdp_mantenimiento_web_ga';
    const WP_OPTION_MENSAJE_TEXTO = 'cdp_mantenimiento_web_mensaje_texto';
    const WP_OPTION_PLANTILLA = 'cdp_mantenimiento_plantilla';

	/**
	 *
	 */
	static function activar()
	{
		self::borrar_cache();
	    update_option( self::WP_OPTION_MODO_MANTENIMIENTO_ACTIVO, true );
        Mensajes::aviso( __( "Modo mantenimiento activado", 'cdp_mweb' ) );
	}
	
	/**
	 *
	 */
	static function desactivar()
	{
		self::borrar_cache();
        update_option( self::WP_OPTION_MODO_MANTENIMIENTO_ACTIVO, false );
        Mensajes::aviso( __( "Modo mantenimiento desactivado", 'cdp_mweb' ) );
    }

	/**
	 *
	 */
	static function borrar_cache()
	{
		global $file_prefix;
		if( function_exists( 'w3tc_pgcache_flush' ) ) 
			w3tc_pgcache_flush(); 
		if( function_exists( 'wp_cache_clean_cache' ) ) 
			wp_cache_clean_cache( $file_prefix, true );
    }

	/**
	 *
	 */
	static function esta_activo()
	{
	    return get_option( self::WP_OPTION_MODO_MANTENIMIENTO_ACTIVO );
	}

	/**
	 *
	 */
	static function dibujar_landing( $plantilla_original )
	{
		if( self::esta_activo() && !is_user_logged_in() )
		{
			global $mensaje, $plantilla;
			$mensaje = self::dame_mensaje_texto();
			$plantilla = self::dame_plantilla();
			return CDP_MANTENIMIENTO_DIR_FRONTAL . '/index.php';
		}
		return $plantilla_original;
	}

	/**
	 *
	 */
	static function dame_id_google_analytics()
	{
		return get_option( self::WP_OPTION_ID_GOOGLE_ANALYTICS, '' );
	}

	/**
	 *
	 */
	static function dame_mensaje_texto()
	{
		return get_option( self::WP_OPTION_MENSAJE_TEXTO, '' );
	}

	/**
	 *
	 */
	static function dame_plantilla()
	{
		return get_option( self::WP_OPTION_PLANTILLA, 1 );
	}

	/**
	 *
	 */
	static function actualizar_plantilla( $numero )
	{
		if( !is_numeric( $numero ) || $numero < 1 || $numero > 3 )
		{
			Mensajes::error( __( "Plantilla incorrecta", 'cdp_mweb' ) );
			return;
		}
		update_option( self::WP_OPTION_PLANTILLA, $numero );
		Mensajes::aviso( __( "Plantilla actualizada", 'cdp_mweb' ) );
	}

	/**
	 *
	 */
	static function actualizar_mensaje_texto( $mensaje )
	{
		$mensaje = str_replace( '<?php', '', $mensaje );
		$mensaje = str_replace( '<?=', '', $mensaje );
		$mensaje = str_replace( '<?', '', $mensaje );
		$mensaje = str_replace( '?>', '', $mensaje );
		update_option( self::WP_OPTION_MENSAJE_TEXTO, $mensaje );
		Mensajes::aviso( __( "Mensaje actualizado", 'cdp_mweb' ) );
	}

	/**
	 *
	 */
	static function actualizar_id_google_analytics( $id_ga )
	{
	    // Debe estar activo
	    if( !self::esta_activo() )
	    {
	        Mensajes::error( 
	            __( "Para cambiar el ID el servicio debe estar activo", 'cdp_mweb' )
	        );
	        return;
	    }
	    
		// Chequeo ID google analytics
		$id_ga = trim( $id_ga );
		if( !preg_match( '/^([0-9a-z_\-]+)|$/i', $id_ga ) )
		{
	        Mensajes::error( 
	            __( "Formato ID incorrecto", 'cdp_mweb' )
	        );
	        return;
	    }

		// Actualizo
		update_option( self::WP_OPTION_ID_GOOGLE_ANALYTICS, $id_ga );
	    Mensajes::aviso( __( "ID actualizado", 'cdp_mweb' ) );
	}
}

?>