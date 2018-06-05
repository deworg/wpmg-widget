<?php

namespace WPMeetupList\View\Widget;

use WPMeetupList\View\Meetups\MeetupsViewFactory;
use WPMeetupList\View\Renderable;

/**
 * Simple factory for widget views.
 *
 * @package WPMeetupList\View\Widget
 */
final class WidgetViewFactory {

	/**
	 * View type.
	 *
	 * @var string
	 */
	const TYPE_FORM = 'form';

	/**
	 * View type.
	 *
	 * @var string
	 */
	const TYPE_WIDGET = 'widget';

	/**
	 * Meetups view factory instance.
	 *
	 * @var MeetupsViewFactory
	 */
	private $meetups_view_factory;

	/**
	 * Constructor. Set up a new instance.
	 *
	 * @param MeetupsViewFactory $meetups_view_factory Meetups view factory instance.
	 */
	public function __construct( MeetupsViewFactory $meetups_view_factory ) {

		$this->meetups_view_factory = $meetups_view_factory;
	}

	/**
	 * Create a view instance of the given type.
	 *
	 * @param string     $type   View type.
	 * @param \WP_Widget $widget Optional. Widget instance. Defaults to null.
	 *
	 * @return Renderable View instance.
	 *
	 * @throws \InvalidArgumentException in case of an invalid widget type.
	 */
	public function create( $type, \WP_Widget $widget = null ) {

		switch ( $type ) {
			case self::TYPE_FORM:
				return new Form( $widget );

			case self::TYPE_WIDGET:
				return new Widget( $this->meetups_view_factory );

			default:
				/* translators: %s: widget view type */
				$message = esc_html__( 'Invalid widget view type "%s".', 'wpmg-widget' );
				throw new \InvalidArgumentException( sprintf( $message, $type ) );
		}
	}
}
