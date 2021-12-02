<?php

/* ======================================================================================
   @author     Carlos Doral Pérez (https://webartesanal.com)
   @version    0.2
   @copyright  Copyright &copy; 2018 Carlos Doral Pérez, All Rights Reserved
               License: GPLv2 or later
   ====================================================================================== */

namespace cdp_mweb;

/**
 *
 */
class AdminWP
{
    /**
     * 
     */
    private static $nombre_plugin;
    
	/**
	 *
	 */
	static function init()
	{
	    AdminWP::crear_menu();
	    add_filter( 'plugin_action_links', [ __CLASS__, 'enlace_configuracion' ], 10, 2 );
	}

	/**
	 *
	 */
	static function crear_menu()
	{
		wp_enqueue_style( 
			'admin-estilos', 
			CDP_MANTENIMIENTO_URL_RAIZ . '/css/admin.css', 
			false 
		);
		add_submenu_page
		(
			'tools.php',
			'Mantenimiento Web',
			'Mantenimiento Web',
			'manage_options',
			'cdp_mantenimiento_web',
			array( __CLASS__, 'vista_configuracion' )
		);
	}

	/**
	 * 
	 */
	static function enlace_configuracion( $enlaces, $archivo )
	{
	    // Sólo añado enlaces a mi plugin
	    if( !self::$nombre_plugin )
	        self::$nombre_plugin = 
	           plugin_basename( 
	               CDP_MANTENIMIENTO_DIR_RAIZ . '/mantenimiento-web.php' 
	           );
        if( $archivo != self::$nombre_plugin )
            return $enlaces;
        
        // Procedo
        $enlace = [
            sprintf(
                "<a href=\"%s\">%s</a>",
                admin_url( 'tools.php?page=cdp_mantenimiento_web' ),
                __( 'Configuración', 'cdp_mweb' )
            ) ];
        return array_merge( $enlace, $enlaces );
	}
	
	/**
	 *
	 */
	static function vista_configuracion()
	{
	    // Sólo sesión admin
	    if( !is_admin() )
	        return;
	    
	    //
	    // Acciones MODO MANTENIMIENTO
	    // 
	    $mensajes_modo_mantenimiento = [];
		if( Input::post( 'cdp_guardar_modo_mantenimiento' ) )
		{
		    //
		    $algun_cambio = false;

		    // Alta/baja modo mantenimiento
		    if( Input::post( 'modo_mantenimiento_activo' ) && ModoMantenimiento::esta_activo() )
		    {
		        ;
		    }
		    else
	        if( !Input::post( 'modo_mantenimiento_activo' ) && !ModoMantenimiento::esta_activo() )
	        {
	            ;
	        }
		    else
		    {
		        if( @$_POST['modo_mantenimiento_activo'] )
		            ModoMantenimiento::activar();
	            else
	                ModoMantenimiento::desactivar();
                $algun_cambio = true;
		    }
			
			// Guardo ID GA
			$id_ga = ModoMantenimiento::dame_id_google_analytics();
			if( $id_ga != Input::post( 'id_google_analytics' ) )
			{
			    ModoMantenimiento::actualizar_id_google_analytics(
			        Input::post( 'id_google_analytics' )
		        );
			    $algun_cambio = true;
			}

			// Guardo mensaje
			$mensaje = ModoMantenimiento::dame_mensaje_texto();
			if( $mensaje != Input::post( 'mensaje_texto' ) )
			{
			    ModoMantenimiento::actualizar_mensaje_texto(
			        Input::post( 'mensaje_texto' )
		        );
			    $algun_cambio = true;
			}

			// Guardo plantilla
			$plantilla = ModoMantenimiento::dame_plantilla();
			if( $plantilla != Input::post( 'plantilla' ) )
			{
			    ModoMantenimiento::actualizar_plantilla(
			        Input::post( 'plantilla' )
		        );
			    $algun_cambio = true;
			}

			// Ningún cambio
			if( !$algun_cambio )
    			Mensajes::aviso( __( "No se ha realizado ningún cambio", 'cdp_mweb' ) );

    		// Obtengo mensajes
    		$mensajes_modo_mantenimiento = Mensajes::dame();
		}

		// Url plugin
		$url = admin_url() . 'admin.php?page=cdp_mantenimiento_web';
?>
<div class="cdp-mweb-admin-contenedor">
<form method="post" action="<?php echo $url?>">
<h2><?php _e( 'Configuración del plugin Mantenimiento Web', 'cdp_mweb' )?></h2>
<p><?php _e( 'Este plugin pone tu web modo privado haciendo que sólo tú puedas verla. El visitante sólo podrá acceder a la home donde aparecerá el típico mensaje "Página en construcción".', 'cdp_mweb' )?></p>
	<table width="95%">
		<tr>
			<th width="30%"><label><?php _e( 'Servicio activo', 'cdp_mweb' )?>:</label></th>
			<td width="70%"><input type="checkbox" name="modo_mantenimiento_activo" value="1" <?php 
			echo ModoMantenimiento::esta_activo() == true ? 'checked' : '';
			$plantilla = ModoMantenimiento::dame_plantilla();
			?>></td>
		</tr>
		<tr>
			<th><label><?php _e( 'Plantilla', 'cdp_mweb' )?>:</label></th>
			<td>
				<table class="cdp_plantilla">
					<tr>
						<td>
							<input type="radio" name="plantilla" id="pl_1" value="1" <?php echo $plantilla == 1 ? 'checked' : ''?>><br>
							<img src="<?php echo CDP_MANTENIMIENTO_URL_FRONTAL?>/img/fondo-mantenimiento-1.jpg" width="100" height="auto" onclick="javascript:jQuery('#pl_1').prop('checked',true)">
						</td>
						<td>
							<input type="radio" name="plantilla" id="pl_2" value="2" <?php echo $plantilla == 2 ? 'checked' : ''?>><br>
							<img src="<?php echo CDP_MANTENIMIENTO_URL_FRONTAL?>/img/fondo-mantenimiento-2.jpg" width="100" height="auto" onclick="javascript:jQuery('#pl_2').prop('checked',true)">
						</td>
						<td>
							<input type="radio" name="plantilla" id="pl_3" value="3" <?php echo $plantilla == 3 ? 'checked' : ''?>><br>
							<img src="<?php echo CDP_MANTENIMIENTO_URL_FRONTAL?>/img/fondo-mantenimiento-3.jpg" width="100" height="auto" onclick="javascript:jQuery('#pl_3').prop('checked',true)">
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<th><label><?php _e( 'Mensaje de texto', 'cdp_mweb' )?>:</label></th>
			<td><textarea name="mensaje_texto" rows="5"><?php 
			$txt = ModoMantenimiento::dame_mensaje_texto();
			if( $txt )
			{
				echo $txt;
			}
			else
			{
				printf( 
					"<h3>%s</h3>\n<p>%s</p>", 
					__( 'Página en construcción', 'cdp_mweb' ),
					__( 'Lamentamos las molestias', 'cdp_mweb' )
				);
			}
			?></textarea></td>
		</tr>
		<tr>
			<th><label><?php _e( 'ID de Google Analytics', 'cdp_mweb' )?>:</label></th>
			<td><input type="text" name="id_google_analytics" value="<?php 
			echo ModoMantenimiento::dame_id_google_analytics()?>"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" name="cdp_guardar_modo_mantenimiento" id="cdp_guardar_modo_mantenimiento" class="button button-primary" value="Guardar"></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<?php
				foreach( $mensajes_modo_mantenimiento as $msg )
				{
				    $class = $msg['tipo'] == 'aviso' ? 'cdp-aviso' : 'cdp-error';
				    ?><div class="cdp-mweb-admin-mensaje <?php echo $class?>"><?php
					echo $msg['texto'];
					?></div><?php
				}
				?>
			</td>
		</tr>
	</table>
</form>
<h2><?php _e( '¿Necesitas ayuda con tu WordPress?', 'cdp_mweb' )?></h2>
<p><?php _e( 'Vigilamos y cuidamos tu sitio web.', 'cdp_mweb' );
	echo ' ';
    printf( 
        __( 
            '<a href="%s" target="_blank">Consulta nuestros planes de mantenimiento</a>',
            'cdp_mweb'
        ),
        'https://webartesanal.com/planes-mantenimiento-web/' 
    )?>.</p>
<em><?php _e( 'Realizado por Carlos Doral', 'cdp_mweb' )?>. <a href="https://webartesanal.com/mantenimiento-web/" target="_blank">Web Artesanal</a></em>
<?php
	}
}

?>