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
 * Version: 0.5.2
 * Tested up to: 4.9
 * Author: wpFRA
 * Author URI: https://wpfra.de
 * Text Domain: wpmeetup-widget
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
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

/**
 * Class WPMeetupListWidget
 */
class WPMeetupListWidget extends WP_Widget {

	/**
	 * WPMeetupListWidget constructor.
	 */
	public function __construct() {
		$widget_ops = array( 'description' => __( 'List of German speaking WP meetups', 'wpmeetup-widget' ) );
		parent::__construct( false, __( 'WP Meetups deutschsprachig', 'wpmeetup-widget' ), $widget_ops );
	}

	/**
	 * Defines the array of all current German speaking meetups.
	 *
	 * @return array
	 */
	public function get_meetups() {
		$meetups = [];

		$api_data = get_transient( 'wpmg_wpmeetup_meetups' );

		if ( false === $api_data ) {
			$api_request  = 'https://wpmeetups.de/wp-json/wp/v2/meetup/?per_page=100&orderby=title&order=asc';
			$api_response = wp_remote_get( $api_request );
			$api_data     = json_decode( wp_remote_retrieve_body( $api_response ), true );
			set_transient( 'wpmg_wpmeetup_meetups', $api_data, DAY_IN_SECONDS );
		}

		foreach ( $api_data as $meetup ) {
			if ( ! empty( $meetup['homepage'] ) ) {
				$meetups[ $meetup['title']['rendered'] ] = array(
					'title' => $meetup['title']['rendered'],
					'url'   => $meetup['homepage'],
				);
			}
		}

		return $meetups;
	}

	/**
	 * Renders the widget.
	 *
	 * @param array $args The widget arguments.
	 * @param array $instance The widget instance.
	 */
	public function widget( $args, $instance ) {

		echo $args['before_widget']; // WPCS: XSS okay.

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title']; // WPCS: XSS okay.
		}

		$widget_args = apply_filters(
			'wpmg_list_widget_args',
			array(
				'link_atts' => array(
					'target' => '',
					'rel'    => 'nofollow',
				),
			)
		);

		$link_atts = '';

		foreach ( $widget_args['link_atts'] as $atts_key => $atts_value ) {
			if ( ! empty( $atts_value ) ) {
				$link_atts .= ' ' . esc_attr( $atts_key ) . '="' . esc_attr( $atts_value ) . '"';
			}
		}

		$meetups = $this->get_meetups();

		if ( ! empty( $instance['filter_own'] ) ) {
			$siteurl = site_url();

			if ( array_key_exists( $siteurl, $meetups ) ) {
				unset( $meetups[ $siteurl ] );
			}
		}

		?>

		<div class="wpmg_widget widget_nav_menu">
			<ul class="menu">
				<?php foreach ( $meetups as $meetup ) : ?>
					<li class="menu-item">
						<a href="<?php echo esc_attr( $meetup['url'] ); ?>" title="WP Meetup <?php echo esc_attr( $meetup['title'] ); ?>" <?php echo $link_atts; // WPCS: XSS okay. ?>>
							<?php echo esc_html( $meetup['title'] ); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>

		</div><!-- end .wpmg_widget -->

		<?php

		echo $args['after_widget']; // WPCS: XSS okay.
	}

	/**
	 * Saves the changes and returns the new instance of the widget.
	 *
	 * @param array $new_instance The new widget instance.
	 * @param array $old_instance The olf widget instance.
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	/**
	 * Renders the backend form of the widget.
	 *
	 * @param array $instance The new instance of the widget.
	 *
	 * @return void
	 */
	public function form( $instance ) {
		$title      = sanitize_text_field( $instance['title'] );
		$filter_own = isset( $instance['filter_own'] ) ? (bool) $instance['filter_own'] : false;
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'wpmeetup-widget' ); ?></label>
			<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"/>
		</p>

		<p>
			<input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'filter_own' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'filter_own' ) ); ?>"<?php checked( $filter_own ); ?> />
			<label for="<?php echo esc_attr( $this->get_field_id( 'filter_own' ) ); ?>"><?php esc_html_e( 'Filter own meetup', 'wpmeetup-widget' ); ?></label>
		</p>

		<?php
	}

} // end class wpmg_list

/**
 * Initializes the plugin.
 */
function wpmeetup_list_widget_init() {
	register_widget( 'WPMeetupListWidget' );
}

add_action( 'widgets_init', 'wpmeetup_list_widget_init' );
