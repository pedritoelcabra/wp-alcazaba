<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://example.com
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 */

/**
 * Fired during plugin deactivation.
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 * @author     Your Name <email@example.com>
 */
class Plugin_Name_Deactivator
{
    public static function deactivate()
    {
        global $wpdb;

        $table_name = $wpdb->prefix . "partidas_alcazaba";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta("DROP TABLE $table_name");
    }
}
