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
		$meetups = array(
			'https://www.meetup.com/de-DE/Aachen-WordPress-Meetup/' => array(
				'title' => 'Aachen',
				'url'   => 'https://www.meetup.com/de-DE/Aachen-WordPress-Meetup/',
			),
			'https://wpmeetup-berlin.de'                 => array(
				'title' => 'Berlin',
				'url'   => 'https://wpmeetup-berlin.de/',
			),
			'https://wpbern.ch'                          => array(
				'title' => 'Bern',
				'url'   => 'https://wpbern.ch/',
			),
			'https://www.wpbn.de'                        => array(
				'title' => 'Bonn',
				'url'   => 'https://www.wpbn.de',
			),
			'https://www.meetup.com/de-DE/bremen-wordpress-meetup-group/' => array(
				'title' => 'Bremen',
				'url'   => 'https://www.meetup.com/de-DE/bremen-wordpress-meetup-group/',
			),
			'https://wpdrs.de'                           => array(
				'title' => 'Dresden',
				'url'   => 'https://wpdrs.de/',
			),
			'https://www.meetup.com/de-DE/wordpress-meetup-dortmund/' => array(
				'title' => 'Dortmund',
				'url'   => 'https://www.meetup.com/de-DE/wordpress-meetup-dortmund/',
			),
			'https://www.meetup.com/de-DE/Dusseldorf-WordPress-Meetup/' => array(
				'title' => 'Düsseldorf',
				'url'   => 'https://www.meetup.com/de-DE/Dusseldorf-WordPress-Meetup/',
			),
			'http://www.wpmeetup-eifel.de'               => array(
				'title' => 'Eifel',
				'url'   => 'http://www.wpmeetup-eifel.de/',
			),
			'https://wpmeetup-frankfurt.de'              => array(
				'title' => 'Frankfurt',
				'url'   => 'https://wpmeetup-frankfurt.de/',
			),
			'https://www.wpmeetup-hamburg.de'            => array(
				'title' => 'Hamburg',
				'url'   => 'https://www.wpmeetup-hamburg.de/',
			),
			'http://wpmeetup-hannover.de'                => array(
				'title' => 'Hannover',
				'url'   => 'http://wpmeetup-hannover.de/',
			),
			'https://wpjena.de'                          => array(
				'title' => 'Jena',
				'url'   => 'https://wpjena.de/',
			),
			'http://wpmeetup-karlsruhe.de'               => array(
				'title' => 'Karlsruhe',
				'url'   => 'http://wpmeetup-karlsruhe.de/',
			),
			'https://wpkoblenz.de'                       => array(
				'title' => 'Koblenz',
				'url'   => 'https://wpkoblenz.de',
			),
			'https://wpcgn.de'                           => array(
				'title' => 'Köln',
				'url'   => 'https://wpcgn.de/',
			),
			'https://www.meetup.com/de-DE/leipzig-wordpress-meetup/' => array(
				'title' => 'Leipzig',
				'url'   => 'https://www.meetup.com/de-DE/leipzig-wordpress-meetup/',
			),
			'https://wpmeetup-mannheim.de'               => array(
				'title' => 'Mannheim',
				'url'   => 'https://wpmeetup-mannheim.de/',
			),
			'https://wpmeetup-muenchen.org'              => array(
				'title' => 'München',
				'url'   => 'https://wpmeetup-muenchen.org/',
			),
			'https://www.meetup.com/de-DE/WordPress-Meetup-Neustadt/' => array(
				'title' => 'Neustadt',
				'url'   => 'https://www.meetup.com/de-DE/WordPress-Meetup-Neustadt/',
			),
			'https://wpmeetup-nuernberg.de'              => array(
				'title' => 'Nürnberg',
				'url'   => 'https://wpmeetup-nuernberg.de/',
			),
			'https://www.meetup.com/de-DE/wpmeetup-muenster-osnabrueck/' => array(
				'title' => 'Osnabrück/Münster',
				'url'   => 'https://www.meetup.com/de-DE/wpmeetup-muenster-osnabrueck/',
			),
			'https://www.meetup.com/de-DE/wp-meetup-paderborn/' => array(
				'title' => 'Paderborn',
				'url'   => 'https://www.meetup.com/de-DE/wp-meetup-paderborn/',
			),
			'https://wpmeetup-potsdam.de'                => array(
				'title' => 'Potsdam',
				'url'   => 'https://wpmeetup-potsdam.de/',
			),
			'https://www.wpmeetup-rostock.de'            => array(
				'title' => 'Rostock',
				'url'   => 'https://www.wpmeetup-rostock.de/',
			),
			'https://www.meetup.com/de-DE/wordpress-meetup-saarland/' => array(
				'title' => 'Saarland',
				'url'   => 'https://www.meetup.com/de-DE/wordpress-meetup-saarland/',
			),
			'https://wpmeetupstuttgart.de'               => array(
				'title' => 'Stuttgart',
				'url'   => 'https://wpmeetupstuttgart.de/',
			),
			'https://www.meetup.com/de-DE/wuerzburg-wordpress-meetup/' => array(
				'title' => 'Würzburg',
				'url'   => 'https://www.meetup.com/de-DE/wuerzburg-wordpress-meetup/',
			),
			'https://www.meetup.com/de/wordpress-zurich' => array(
				'title' => 'Zürich',
				'url'   => 'https://www.meetup.com/de/wordpress-zurich/',
			),
		);

		return $meetups;
	}

	/**
	 * Renders the widget.
	 *
	 * @param array $args The widget arguments.
	 * @param array $instance The widget instance.
	 */
	public function widget( $args, $instance ) {

		echo $args['before_widget']; // phpcs:ignore WordPress.Security.EscapeOutput

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title']; // phpcs:ignore WordPress.Security.EscapeOutput
		}

		$widget_args = apply_filters(
			'wpmg_list_widget_args',
			array(
				'prefix'    => 'WP Meetup ',
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
						<a href="<?php echo esc_attr( $meetup['url'] ); ?>" title="WP Meetup <?php echo esc_attr( $meetup['title'] ); ?>" <?php echo $link_atts; // phpcs:ignore WordPress.Security.EscapeOutput ?>>
							<?php echo esc_html( $widget_args['prefix'] . $meetup['title'] ); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>

		</div><!-- end .wpmg_widget -->

		<?php

		echo $args['after_widget']; // phpcs:ignore WordPress.Security.EscapeOutput
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
			<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" />
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
