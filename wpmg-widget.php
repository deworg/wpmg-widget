<?php
/*
Plugin Name:	WP Meetups deutschsprachig
Plugin URI: 	https://github.com/wpFRA/wpmg-widget
Description: 	Alle deutschsprachigen WP Meetups - in einem Widget.

Author:         wpFRA
Author URI: 	https://wpfra.de

Version:        0.4.4
Tested up to: 	4.5

License: 		GPL2

GitHub Plugin URI: https://github.com/wpFRA/wpmg-widget
GitHub Branch: master
*/


/*
Copyright 2015 WP Meetup Frankfurt (wpfra.de) (e-mail: kontakt@wpfra.de)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


class wpmg_list extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'description' => __( 'Liste deutschsprachiger WP Meetups', 'wpmg-widget' ) );
		parent::__construct( false, __( 'WP Meetups deutschsprachig', 'wpmg-widget' ), $widget_ops );
	}

	public function get_meetups() {
		$meetups = array(
			'https://wpmeetup-berlin.de' => array( 'title' => 'Berlin', 'url' => 'https://wpmeetup-berlin.de/' ),
			'https://wpbern.ch' => array( 'title' => 'Bern', 'url' => 'https://wpbern.ch/' ),
			'http://wpmeetup-bremen.de' => array( 'title' => 'Bremen', 'url' => 'http://wpmeetup-bremen.de/' ),
			'http://wpmeetup-dresden.de' => array( 'title' => 'Dresden', 'url' => 'http://wpmeetup-dresden.de/' ),
			'http://www.wpmeetup-eifel.de' => array( 'title' => 'Eifel', 'url' => 'http://www.wpmeetup-eifel.de/' ),
			'https://wpmeetup-franken.de' => array( 'title' => 'Franken', 'url' => 'https://wpmeetup-franken.de/' ),
			'https://wpmeetup-frankfurt.de' => array( 'title' => 'Frankfurt', 'url' => 'https://wpmeetup-frankfurt.de/' ),
			'https://www.wpmeetup-hamburg.de/' => array( 'title' => 'Hamburg', 'url' => 'https://wpmeetup-hamburg.de/' ),
			'http://www.wpmeetup-hannover.de' => array( 'title' => 'Hannover', 'url' => 'http://www.wpmeetup-hannover.de/' ),
			'http://wpmeetup-karlsruhe.de' => array( 'title' => 'Karlsruhe', 'url' => 'http://wpmeetup-karlsruhe.de/' ),
			'http://wpcgn.de' => array( 'title' => 'Köln', 'url' => 'http://wpcgn.de/' ),
			'http://www.meetup.com/de-DE/Leipzig-WordPress-Meetup/' => array( 'title' => 'Leipzig', 'url' => 'http://www.meetup.com/de-DE/Leipzig-WordPress-Meetup/' ),
			'http://wpmeetup-muenchen.org' => array( 'title' => 'München', 'url' => 'http://wpmeetup-muenchen.org/' ),
			'http://www.wpmeetup-osnabrueck.de' => array( 'title' => 'Osnabrück/Münster/Emsland', 'url' => 'http://www.wpmeetup-osnabrueck.de/' ),
			'http://www.meetup.com/de/WordPress-Meetup-Ostbrandenburg/' => array( 'title' => 'Ostbrandenburg', 'url' => 'http://www.meetup.com/de/WordPress-Meetup-Ostbrandenburg//' ),
			'http://wpmeetup-paderborn.de' => array( 'title' => 'Paderborn', 'url' => 'http://wpmeetup-paderborn.de/' ),
			'http://wpmeetup-potsdam.de' => array( 'title' => 'Potsdam', 'url' => 'http://wpmeetup-potsdam.de/' ),
			'http://wpmeetup-region38.de' => array( 'title' => 'Region 38', 'url' => 'http://wpmeetup-region38.de/' ),
			'http://wpmeetup-rheinruhr.de' => array( 'title' => 'Rhein-Ruhr', 'url' => 'http://wpmeetup-rheinruhr.de/' ),
			'https://wpmeetup.saarland' => array( 'title' => 'Saarland', 'url' => 'https://wpmeetup.saarland/' ),
			'http://wpmeetup-stuttgart.de' => array( 'title' => 'Stuttgart', 'url' => 'http://wpmeetup-stuttgart.de/' ),
			'https://wpmeetup-thueringen.de' => array( 'title' => 'Thüringen', 'url' => 'https://wpmeetup-thueringen.de/' ),
			'https://wpmeetup-wuerzburg.de' => array( 'title' => 'Würzburg', 'url' => 'https://wpmeetup-wuerzburg.de/' ),
			'http://www.meetup.com/de/wordpress-zurich' => array( 'title' => 'Zürich', 'url' => 'http://www.meetup.com/de/wordpress-zurich/' ),
		);

		return $meetups;
	}

	public function widget( $args, $instance ) {

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		$widget_args = apply_filters( 'wpmg_list_widget_args', array(
			'prefix' => 'WP Meetup ',
			'link_atts' => array(
				'target' => '',
				'rel' => 'nofollow',
			)
		) );

		$link_atts = '';

		foreach ( $widget_args['link_atts'] as $atts_key => $atts_value ) {
			if (!empty($atts_value)){
				$link_atts .= ' ' . esc_attr( $atts_key ) . '="' . esc_attr($atts_value) . '"';
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
						<a href="<?php echo esc_attr( $meetup['url'] ); ?>" title="WP Meetup <?php echo esc_attr( $meetup['title'] ); ?>" <?php echo $link_atts; ?>>
							<?php echo esc_html( $widget_args['prefix'] . $meetup['title'] ); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>

		</div><!-- end .wpmg_widget -->

		<?php

		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	function form( $instance ) {
		$title = sanitize_text_field( $instance['title'] );
		$filter_own = isset( $instance['filter_own'] ) ? (bool) $instance['filter_own'] : false;
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Titel:', 'wpmg-widget' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" />
		</p>

		<p>
			<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'filter_own' ); ?>" name="<?php echo $this->get_field_name( 'filter_own' ); ?>"<?php checked( $filter_own ); ?> />
			<label for="<?php echo $this->get_field_id( 'filter_own' ); ?>"><?php _e( 'Eigenes Meetup rausfiltern', 'wpmg-widget' ); ?></label>
		</p>

		<?php
	}

} // end class wpmg_list

function wpmg_list_widget_init() {
	register_widget( 'wpmg_list' );
}
add_action( 'widgets_init', 'wpmg_list_widget_init' );
