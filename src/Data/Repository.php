<?php

namespace WPMeetupList\Data;

/**
 * Simple repository providing read access to meetup data.
 *
 * @package WPMeetupList\Data
 */
interface Repository {

	/**
	 * Return the meetups.
	 *
	 * @param bool $include_current_site Optional. Include the current site, if a meetup site? Defaults to true.
	 *
	 * @return Meetup[] Meetups.
	 */
	public function get_meetups( $include_current_site = true );
}
