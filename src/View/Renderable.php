<?php

namespace WPMeetupList\View;

/**
 * Context-aware renderable entity.
 *
 * @package WPMeetupList\View
 */
interface Renderable {

	/**
	 * Render according to the given context.
	 *
	 * @param array $context Optional. Arbitrary context for rendering. Defaults to empty array.
	 *
	 * @return void
	 */
	public function render( array $context = [] );
}
