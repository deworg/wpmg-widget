<?php
/**
 * WPMeetups Widget deutschsprachig
 *
 * @package     2ndkauboy
 * @author      wpFRA
 * @license     GPLv2 or later
 *
 * @wordpress-plugin
 * Plugin Name: WPMeetups Widget deutschsprachig
 * Plugin URI: https://github.com/deworg/wpmg-widget
 * Description: Alle deutschsprachigen WP Meetups - in einem Widget.
 * Version: 1.0.0
 * Author: wpFRA
 * Author URI: https://wpfra.de
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wpmg-widget
 * Domain Path: /languages
 */

/*
Copyright 2015 WP Meetup Frankfurt (wpfra.de) (e-mail: kontakt@wpfra.de)

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

use WPMeetupList\Data\ArrayRepository;
use WPMeetupList\Data\ValidatingRepository;
use WPMeetupList\View\Meetups\MeetupsViewFactory;
use WPMeetupList\View\Widget\WidgetViewFactory;

/**
 * Initialize the plugin.
 *
 * @wp-hook widgets_init
 */
function wpmeetup_list_widget_init() {

	load_plugin_textdomain( 'wpmg-widget', false, 'languages' );

	if ( ! class_exists( 'WPMeetupListWidget' ) ) {
		require_once __DIR__ . '/vendor/autoload.php';
	}

	$meetups = require __DIR__ . '/data/meetups.php';

	$repository = new ArrayRepository( $meetups );
	$repository = new ValidatingRepository( $repository );

	$meetups_view_factory = new MeetupsViewFactory( $repository );

	$widget_view_factory = new WidgetViewFactory( $meetups_view_factory );

	$widget = new WPMeetupListWidget( $widget_view_factory );
	$widget->register();
}

add_action( 'widgets_init', 'wpmeetup_list_widget_init' );
