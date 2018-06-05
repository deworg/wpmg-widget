<?php

namespace WPMeetupList\View\Widget;

use WPMeetupList\View\Meetups\MeetupsViewFactory;
use WPMeetupList\View\Renderable;

/**
 * Widget view.
 *
 * @package WPMeetupList\View\Widget
 */
final class Widget implements Renderable {

	/**
	 * Meetups view factory instance.
	 *
	 * @var MeetupsViewFactory
	 */
	private $meetups_view_factory;

	/**
	 * Custom widget args used for rendering.
	 *
	 * @var array
	 */
	private $widget_args;

	/**
	 * Constructor. Set up a new instance.
	 *
	 * @param MeetupsViewFactory $meetups_view_factory Meetups view factory instance.
	 */
	public function __construct( MeetupsViewFactory $meetups_view_factory ) {

		$this->meetups_view_factory = $meetups_view_factory;

		$this->parse_widget_args();
	}

	/**
	 * Parse custom widget args.
	 *
	 * @return void
	 */
	private function parse_widget_args() {

		$widget_args = (array) apply_filters( 'wpmg_list_widget_args', [
			'prefix'    => 'WP Meetup ',
			'link_atts' => [
				'rel' => 'nofollow',
			],
		] );

		$prefix = isset( $widget_args['prefix'] )
			? (string) $widget_args['prefix']
			: '';

		$link_attributes = isset( $widget_args['link_atts'] ) && is_array( $widget_args['link_atts'] )
			? $widget_args['link_atts']
			: [];

		$this->widget_args = compact( 'link_attributes', 'prefix' );
	}

	/**
	 * Render according to the given context.
	 *
	 * @param array $context Optional. Arbitrary context for rendering. Defaults to empty array.
	 *
	 * @return void
	 */
	public function render( array $context = [] ) {

		$args = $context['args'];

		$instance = $context['instance'];

		echo wp_kses_post( $args['before_widget'] );

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = (string) apply_filters( 'widget_title', $instance['title'], $instance, $context['id_base'] );
		if ( $title !== '' ) {
			echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );
		}

		$view = $this->meetups_view_factory->create( (string) $instance['view'] );
		?>
		<div class="wpmg_widget widget_nav_menu">
			<?php
			$view->render( [
				'include_current_site' => ! $instance['filter_own'],
				'render_args'          => $this->widget_args,
			] );
			?>
		</div>
		<?php
		echo wp_kses_post( $args['after_widget'] );
	}
}
