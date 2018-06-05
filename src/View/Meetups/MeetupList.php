<?php

namespace WPMeetupList\View\Meetups;

use WPMeetupList\Data\Meetup;
use WPMeetupList\Data\Repository;
use WPMeetupList\View\Renderable;

/**
 * List-style meetups view implementation.
 *
 * @package WPMeetupList\View
 */
final class MeetupList implements Renderable {

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
			'link_attributes' => [],
			'prefix'          => '',
		], $render_args );
		?>
		<ul class="menu">
			<?php array_walk( $meetups, [ $this, 'render_meetup' ], $render_args ); ?>
		</ul>
		<?php
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
		<li class="menu-item">
			<a
				href="<?php echo esc_attr( esc_url( $url ) ); ?>"
				<?php
				if ( isset( $render_args['link_atts'] ) && is_array( $render_args['link_atts'] ) ) {
					foreach ( $render_args['link_atts'] as $name => $value ) {
						echo ' ' . esc_attr( $name ) . '="' . esc_attr( $value ) . '"';
					}
				}
				?>
			>
				<?php echo esc_html( $render_args['prefix'] . $meetup->name() ); ?>
			</a>
		</li>
		<?php
	}
}
