<?php
/*
Plugin Name: Mailster WordPress Newsletter Plugin Compatibility Tester
Plugin URI: http://mailster.co
Description: This is a compatibility test plugin for the Mailster Newsletter plugin
Version: 1.0.2
Author: EverPress
Author URI: https://everpress.co
Text Domain: mailster-tester
License: GPLv2 or later
*/

define( 'MAILSTER_TESTER_FILE', __FILE__ );

require_once dirname( __FILE__ ) . '/classes/tester.class.php';
new MailsterTester();
