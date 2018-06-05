<?php

namespace WPMeetupList\Data;

/**
 * Repository implementation reading an array with meetup data.
 *
 * @package WPMeetupList\Data
 */
final class ArrayRepository implements Repository {

	/**
	 * List of meetups with URLs as keys and meetup objects as values.
	 *
	 * @var Meetup[]
	 */
	private $meetups = [];

	/**
	 * Constructor. Set up a new instance.
	 *
	 * @param array[] $meetups List of meetups with website URLs as keys and other data as values.
	 */
	public function __construct( array $meetups ) {

		foreach ( $meetups as $website => $data ) {
			$this->meetups[ $website ] = new Meetup( array_merge( $data, compact( 'website' ) ) );
		}
	}

	/**
	 * Return the meetups.
	 *
	 * @param bool $include_current_site Optional. Include the current site, if a meetup site? Defaults to true.
	 *
	 * @return Meetup[] Meetups.
	 */
	public function get_meetups( $include_current_site = true ) {

		$meetups = $this->meetups;
		if ( ! $include_current_site ) {
			unset( $meetups[ site_url() ] );
		}

		return $meetups;
	}
}
