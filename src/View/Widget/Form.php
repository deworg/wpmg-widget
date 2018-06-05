<?php

namespace WPMeetupList\View\Widget;

use WPMeetupList\View\Meetups\MeetupsViewFactory;
use WPMeetupList\View\Renderable;

/**
 * Widget form view.
 *
 * @package WPMeetupList\View\Widget
 */
final class Form implements Renderable {

	/**
	 * Widget instance.
	 *
	 * @var \WP_Widget
	 */
	private $widget;

	/**
	 * Constructor. Set up a new instance.
	 *
	 * @param \WP_Widget $widget Widget instance.
	 */
	public function __construct( \WP_Widget $widget ) {

		$this->widget = $widget;
	}

	/**
	 * Render according to the given context.
	 *
	 * @param array $context Optional. Arbitrary context for rendering. Defaults to empty array.
	 *
	 * @return void
	 */
	public function render( array $context = [] ) {

		$instance = $context['instance'];

		$this->render_title_field( $instance );
		$this->render_filter_field( $instance );
		$this->render_view_field( $instance );
	}

	/**
	 * Render the filter field.
	 *
	 * @param array $instance Current settings for the injected widget instance.
	 *
	 * @return void
	 */
	private function render_filter_field( array $instance ) {

		$id = $this->widget->get_field_id( 'filter_own' );
		?>
		<p>
			<label for="<?php echo esc_attr( $id ); ?>">
				<input
					type="checkbox"
					name="<?php echo esc_attr( $this->widget->get_field_name( 'filter_own' ) ); ?>"
					<?php checked( (bool) $instance['filter_own'] ); ?>
					class="checkbox"
					id="<?php echo esc_attr( $id ); ?>"
				/>
				<?php esc_html_e( 'Filter own meetup', 'wpmg-widget' ); ?>
			</label>
		</p>
		<?php
	}

	/**
	 * Render the title field.
	 *
	 * @param array $instance Current settings for the injected widget instance.
	 *
	 * @return void
	 */
	private function render_title_field( array $instance ) {

		$id = $this->widget->get_field_id( 'title' );
		?>
		<p>
			<label for="<?php echo esc_attr( $id ); ?>">
				<?php esc_html_e( 'Title:', 'wpmg-widget' ); ?>
				<input
					type="text"
					name="<?php echo esc_attr( $this->widget->get_field_name( 'title' ) ); ?>"
					value="<?php echo esc_attr( $instance['title'] ); ?>"
					class="widefat"
					id="<?php echo esc_attr( $id ); ?>"
				/>
			</label>
		</p>
		<?php
	}

	/**
	 * Render the view field.
	 *
	 * @param array $instance Current settings for the injected widget instance.
	 *
	 * @return void
	 */
	private function render_view_field( array $instance ) {

		$id = $this->widget->get_field_id( 'view' );

		$options = [
			MeetupsViewFactory::TYPE_LIST     => __( 'List', 'wpmg-widget' ),
			MeetupsViewFactory::TYPE_DROPDOWN => __( 'Dropdown', 'wpmg-widget' ),
		];
		?>
		<p>
			<label for="<?php echo esc_attr( $id ); ?>">
				<?php esc_html_e( 'View:', 'wpmg-widget' ); ?>
				<select
					name="<?php echo esc_attr( $this->widget->get_field_name( 'view' ) ); ?>"
					id="<?php echo esc_attr( $id ); ?>"
				>
					<?php array_walk( $options, [ $this, 'render_view_option' ], (string) $instance['view'] ); ?>
				</select>
			</label>
		</p>
		<?php
	}

	/**
	 * Render a view option.
	 *
	 * @param string $name    View name.
	 * @param string $type    View type.
	 * @param string $current Currently selected view type.
	 *
	 * @return void
	 */
	private function render_view_option( $name, $type, $current ) {

		?>
		<option value="<?php echo esc_attr( $type ); ?>"<?php selected( $type, $current ); ?>>
			<?php echo esc_html( $name ); ?>
		</option>
		<?php
	}
}
