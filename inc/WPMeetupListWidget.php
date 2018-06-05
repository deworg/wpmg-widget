<?php

use WPMeetupList\View\Meetups\MeetupsViewFactory;
use WPMeetupList\View\Widget\WidgetViewFactory;

/**
 * Class WPMeetupListWidget
 */
class WPMeetupListWidget extends WP_Widget {

	/**
	 * Default widget settings.
	 *
	 * @var array
	 */
	protected $default_instance = [
		'title'      => '',
		'filter_own' => false,
		'view'       => MeetupsViewFactory::TYPE_LIST,
	];

	/**
	 * Widget view factory instance.
	 *
	 * @var WidgetViewFactory
	 */
	private $view_factory;

	/**
	 * Constructor. Set up a new instance.
	 *
	 * @param WidgetViewFactory $view_factory Widget view factory instance.
	 */
	public function __construct( WidgetViewFactory $view_factory ) {

		$widget_options = [
			'description'                 => esc_html__( 'List of German-speaking WP meetups.', 'wpmg-widget' ),
			'customize_selective_refresh' => true,
		];
		parent::__construct( '', esc_html__( 'WP Meetups', 'wpmg-widget' ), $widget_options );

		$this->view_factory = $view_factory;
	}

	/**
	 * Register the widget instance.
	 *
	 * @return void
	 */
	public function register() {

		register_widget( $this );
	}

	/**
	 * Render the widget.
	 *
	 * @param array $args     Display arguments.
	 * @param array $instance Current settings for this widget instance.
	 */
	public function widget( $args, $instance ) {

		$widget = $this->view_factory->create( WidgetViewFactory::TYPE_WIDGET );
		$widget->render( [
			'args'     => (array) $args,
			'id_base'  => $this->id_base,
			'instance' => array_merge( $this->default_instance, (array) $instance ),
		] );
	}

	/**
	 * Update the settings for the current widget instance.
	 *
	 * @param array $new_instance New settings for this widget instance as input by user.
	 * @param array $instance     Current settings for this widget instance.
	 *
	 * @return array Settings to save.
	 */
	public function update( $new_instance, $instance ) {

		$instance = (array) $instance;

		$new_instance = array_merge( $this->default_instance, (array) $new_instance );

		$instance['title'] = sanitize_text_field( $new_instance['title'] );

		$instance['filter_own'] = (bool) $new_instance['filter_own'];

		$instance['view'] = sanitize_text_field( $new_instance['view'] );

		return $instance;
	}

	/**
	 * Render the widget settings form.
	 *
	 * @param array $instance Current settings for this widget instance.
	 *
	 * @return void
	 */
	public function form( $instance ) {

		$form = $this->view_factory->create( WidgetViewFactory::TYPE_FORM, $this );
		$form->render( [
			'instance' => array_merge( $this->default_instance, (array) $instance ),
		] );
	}
}
