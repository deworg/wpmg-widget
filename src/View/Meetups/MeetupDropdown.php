<?php

namespace WPMeetupList\View\Meetups;

use WPMeetupList\Data\Meetup;
use WPMeetupList\Data\Repository;
use WPMeetupList\View\Renderable;

/**
 * Dropdown-style meetups view implementation.
 *
 * @package WPMeetupList\View\Meetups
 */
final class MeetupDropdown implements Renderable {

	/**
	 * Meetup repository instance.
	 *
	 * @var Repository
	 */
	private $repository;

	/**
	 * Constructor. Set up a new instance.
	 *
	 * @param Repository $repository Meetup repository instance.
	 */
	public function __construct( Repository $repository ) {

		$this->repository = $repository;
	}

	/**
	 * Render the meetups according to the given context.
	 *
	 * @param array $context Optional. Arbitrary context for rendering. Defaults to empty array.
	 *
	 * @return void
	 */
	public function render( array $context = [] ) {

		$meetups = $this->repository->get_meetups( ! empty( $context['include_current_site'] ) );
		if ( ! $meetups ) {
			return;
		}

		$render_args = empty( $context['render_args'] ) ? [] : (array) $context['render_args'];
		$render_args = array_merge( [
			'prefix' => '',
		], $render_args );
		?>
		<select title="<?php esc_html_e( 'WP Meetups', 'wpmg-widget' ); ?>" class="wpmg-meetup-dropdown">
			<option value="">
				&mdash;<?php esc_html_e( 'Select meetup', 'wpmg-widget' ); ?>&mdash;
			</option>
			<?php array_walk( $meetups, [ $this, 'render_meetup' ], $render_args ); ?>
		</select>
		<?php
		$this->render_script_tag();
	}

	/**
	 * Render the given meetup.
	 *
	 * @param Meetup $meetup      Meetup object.
	 * @param string $url         URL of the meetup website.
	 * @param array  $render_args Custom render args.
	 *
	 * @return void
	 */
	private function render_meetup( Meetup $meetup, $url, array $render_args ) {

		?>
		<option value="<?php echo esc_attr( esc_url( $url ) ); ?>">
			<?php echo esc_html( $render_args['prefix'] . $meetup->name() ); ?>
		</option>
		<?php
	}

	/**
	 * Render the JavaScript code to redirect the user the selected meetup website.
	 *
	 * @return void
	 */
	private function render_script_tag() {

		?>
		<script>
			var selects = document.querySelectorAll( 'select.wpmg-meetup-dropdown' );
			if ( selects.length ) {
				for ( var i = 0; i < selects.length; i ++ ) {
					selects[ i ].addEventListener( 'change', function ( e ) {
						var url = e.target.value;
						if ( url.length ) {
							window.location.href = url;
						}
					} );
				}
			}
		</script>
		<noscript>
			<p>
				<strong><?php esc_html_e( 'This widget view requires JavaScript.', 'wpmg-widget' ); ?></strong>
			</p>
		</noscript>
		<?php
	}
}
