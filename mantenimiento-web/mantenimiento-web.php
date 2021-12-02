<?php

/*
Plugin Name: Mantenimiento web
Plugin URI: https://webartesanal.com/mantenimiento-web/
Description: Pon tu WordPress en modo mantenimiento para hacer mejoras o reparaciones. Tu página mostrará un aviso "Sitio en construcción" y sólo tú podrás navegar por ella.
Version: 0.8
Requires at least: 3.5
Tested up to: 5.7
Author: Carlos Doral
Author URI: https://webartesanal.com/mantenimiento-web/
License: GPLv2 or later
*/ 

/*  Copyright 2018 Carlos Doral Pérez

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/
  
    // No permitimos una llamada directa
    if( !defined( 'WPINC' ) )
        die;

    // Configuración y definiciones
    require dirname( __FILE__ ) . '/config.php';

    // Adaptación de hooks a espacios de nombres
    function cdp_mweb_activar_plugin() { 
        cdp_mweb\MantenimientoWeb::activar_plugin(); 
    }
    function cdp_mweb_desactivar_plugin() { 
        cdp_mweb\MantenimientoWeb::desactivar_plugin(); 
    }
    function cdp_mweb_desinstalar_plugin() { 
        cdp_mweb\MantenimientoWeb::desinstalar_plugin(); 
    }
    function cdp_mweb_admin_init() { 
        cdp_mweb\AdminWP::init(); 
    }
    function cdp_mweb_dibujar_landing( $po ) { 
        return cdp_mweb\ModoMantenimiento::dibujar_landing( $po ); 
    }

    // Hooks
    add_action( 'template_include', 'cdp_mweb_dibujar_landing', 999999 );
    add_action( 'admin_menu', 'cdp_mweb_admin_init' );
    register_activation_hook( __FILE__, 'cdp_mweb_activar_plugin' );
    register_deactivation_hook( __FILE__, 'cdp_mweb_desactivar_plugin' );
    register_uninstall_hook( __FILE__, 'cdp_mweb_desinstalar_plugin' );

?>