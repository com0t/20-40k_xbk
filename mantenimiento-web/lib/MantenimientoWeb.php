<?php

/* ======================================================================================
   @author     Carlos Doral Pérez (https://webartesanal.com)
   @version    0.4
   @copyright  Copyright &copy; 2018 Carlos Doral Pérez, All Rights Reserved
               License: GPLv2 or later
   ====================================================================================== */

namespace cdp_mweb;

/**
 *
 */
class MantenimientoWeb
{
    /**
     * Cadenas con las vars a almacenar en tabla wp_options
     */
    const WP_OPTION_CLAVE = 'cdp_mantenimiento_web_key';
    const WP_OPTION_ALERTAS_EMAIL = 'cdp_mantenimiento_web_email';
    const WP_OPTION_ACTIVO = 'cdp_mantenimiento_web_activo';
    const WP_OPTION_MENSAJES = 'cdp_mantenimiento_web_mensajes';
    
	/**
	 *
	 */
	static function activar_plugin()
	{
	    Mensajes::borrar();
	    RedirigirAConfiguracion::crear();
	}

	/**
	 *
	 */
	static function desactivar_plugin()
	{
	    MantenimientoWeb::desactivar_monitor_web();
	}

	/**
	 *
	 */
	static function desinstalar_plugin()
	{
	    MantenimientoWeb::eliminar_monitor_web();
	}

	/**
	 *
	 */
	static function generar_id()
	{
		if( is_admin() )
			return;
		echo "<!-- cdp_mantenimiento_web -->";
	}

	/**
	 *
	 */
	static function procesar_resultado( $resultado )
	{
	    $vdef = [ 
			'ok' => false, 
			'error' => __( 
				'Debido a la configuración PHP de su servidor no es posible realizar ' .
				'comunicaciones hacia el exterior. El plugin no estará operativo.',
				'cdp_mweb' 
			) ];
		if( is_object( $resultado ) && get_class( $resultado ) == 'WP_Error' )
		{
			$msg = '';
			foreach( $resultado->errors as $k => $v )
				$msg .= 
					( $msg ? ', ' : '' ) . 
					"$k => " . 
					is_array( $v ) ? implode( ',', $v ) : $v
					;
			$vdef['error'] = $msg;
		}
		else
	    if( is_array( $resultado ) && isset( $resultado['body'] ) )
	    {
	        $r = json_decode( $resultado['body'] );
	        if( is_array( $r ) )
	            return (object)$r;
	        if( is_object( $r ) )
	            return $r;
	    }
		else
		{
			$vdef['error'] = __( 'Se ha producido un error desconocido', 'cdp_mweb' );
		}
	    return (object)$vdef;
	}
	
	/**
	 *
	 */
	static function activar_monitor_web()
	{
        // Lanzo petición
        $resultado = 
            wp_remote_post( 
                CDP_MANTENIMIENTO_URL_SERVICIOS_WEB,
                [
                    'timeout' => 20,
                    'body' => 
                    [
                        'accion' => 'insertar_monitor',
                        'email' => MantenimientoWeb::dame_email_alertas(),
                        'url' => get_home_url(),
                        'clave' => MantenimientoWeb::generar_clave()
                    ]
                ]
            );
            
        // Compruebo si todo ok
        update_option( MantenimientoWeb::WP_OPTION_ACTIVO, true );
        
        // Analizo resultado
        $resultado = MantenimientoWeb::procesar_resultado( $resultado );
        if( $resultado->ok )
        {
            Mensajes::aviso( __( "Monitor activado", 'cdp_mweb' ) );
        }
        else
        {
            if( isset( $resultado->error ) )
                Mensajes::error( $resultado->error );
        }
	}
	
	/**
	 *
	 */
	static function generar_clave()
	{
	    $clave = md5( rand() . time() );
	    update_option( MantenimientoWeb::WP_OPTION_CLAVE, $clave );
	    return $clave;
	}
	
	/**
	 * 
	 */
	static function dame_clave()
	{
	    return get_option( MantenimientoWeb::WP_OPTION_CLAVE );
	}
	
	/**
	 *
	 */
	static function desactivar_monitor_web()
	{
        // Lanzo petición
        $resultado =
            wp_remote_post(
	            CDP_MANTENIMIENTO_URL_SERVICIOS_WEB,
	            [
    	            'timeout' => 20,
    	            'body' =>
    	            [
        	            'accion' => 'desactivar_monitor',
        	            'url' => get_home_url(),
        	            'clave' => get_option( MantenimientoWeb::WP_OPTION_CLAVE )
    	            ]
	            ]
           );
            
        // Actualizo bd
        update_option( MantenimientoWeb::WP_OPTION_ACTIVO, false );
        
        // Analizo resultado
        $resultado = MantenimientoWeb::procesar_resultado( $resultado );
        if( $resultado->ok )
        {
            Mensajes::aviso( __( "Monitor desactivado", 'cdp_mweb' ) );
        }
        else
        {
            if( isset( $resultado->error ) )
                Mensajes::error( $resultado->error );
        }
    }

    /**
     *
     */
    static function eliminar_monitor_web()
    {
        // Lanzo petición
        wp_remote_post(
            CDP_MANTENIMIENTO_URL_SERVICIOS_WEB,
            [
                'timeout' => 20,
                'body' =>
                [
                    'accion' => 'eliminar_monitor',
                    'url' => get_home_url(),
                    'clave' => get_option( MantenimientoWeb::WP_OPTION_CLAVE )
                ]
            ]
        );
        
        // Compruebo si todo ok
        update_option( MantenimientoWeb::WP_OPTION_ACTIVO, false );
    }
    
 	/**
	 *
	 */
	static function monitor_activo()
	{
	    return get_option( self::WP_OPTION_ACTIVO );
	}


	/**
	 *
	 */
	static function dame_email_alertas()
	{
	    $email = get_option( MantenimientoWeb::WP_OPTION_ALERTAS_EMAIL );
	    return $email ? $email : get_bloginfo( 'admin_email' );
	}

	/**
	 *
	 */
	static function actualizar_email_alertas( $email_list )
	{
	    //
	    if( !MantenimientoWeb::monitor_activo() )
	    {
	        Mensajes::error( 
	            __( "Para cambiar el email el servicio debe estar activo", 'cdp_mweb' )
	        );
	        return;
	    }
	    
		// Chequeo email
        foreach( explode( ',', $email_list ) as $email )
        {
            if( !preg_match( '/^[^@]+@.+$/i', trim( $email ) ) )
            {
                Mensajes::error( __( "Email incorrecto: ", 'cdp_mweb' ) . $email );
                return;
            }
        }
        $email_list = trim( $email_list );
        
		// Guardo en servidor remoto
		$resultado =
    		wp_remote_post(
        		CDP_MANTENIMIENTO_URL_SERVICIOS_WEB,
        		[
    	           	'timeout' => 20,
            		'body' =>
    	           	[
                		'accion' => 'actualizar_email',
                		'url' => get_home_url(),
                		'email' => $email_list,
                		'clave' => MantenimientoWeb::generar_clave()
            		]
        		]
		    );

		// Analizo resultado
		$resultado = MantenimientoWeb::procesar_resultado( $resultado );
		if( $resultado->ok )
		{
			update_option( MantenimientoWeb::WP_OPTION_ALERTAS_EMAIL, $email_list );
		    Mensajes::aviso( __( "Email actualizado", 'cdp_mweb' ) );
		}
		else
		{
	        Mensajes::error( $resultado->error );
		}
	}
}

?>