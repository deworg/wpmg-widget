<?php

namespace WPMeetupList\Data;

/**
 * Repository decorator validating meetups against a set of required data.
 *
 * @package WPMeetupList\Data
 */
final class ValidatingRepository implements Repository {

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
	 * Return all meetups with at least a name and a website.
	 *
	 * @param bool $include_current_site Optional. Include the current site, if a meetup site? Defaults to true.
	 *
	 * @return Meetup[] Meetups.
	 */
	public function get_meetups( $include_current_site = true ) {

		$meetups = $this->repository->get_meetups( $include_current_site );
		$meetups = array_filter( $meetups, function ( Meetup $meetup ) {

			return (
				trim( $meetup->name() ) !== ''
				&& trim( $meetup->website() ) !== ''
			);
		} );

		return $meetups;
	}
}
