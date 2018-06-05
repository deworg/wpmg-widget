<?php

namespace WPMeetupList\View\Meetups;

use WPMeetupList\Data\Repository;
use WPMeetupList\View\Renderable;

/**
 * Simple factory for meetups view implementations.
 *
 * @package WPMeetupList\View
 */
final class MeetupsViewFactory {

	/**
	 * View type.
	 *
	 * @var string
	 */
	const TYPE_DROPDOWN = 'dropdown';

	/**
	 * View type.
	 *
	 * @var string
	 */
	const TYPE_LIST = 'list';

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
	 * Create a view instance of the given type.
	 *
	 * @param string $type Optional. View type. Defaults to list-style view.
	 *
	 * @return Renderable View instance.
	 */
	public function create( $type = self::TYPE_LIST ) {

		switch ( $type ) {
			case self::TYPE_DROPDOWN:
				return new MeetupDropdown( $this->repository );

			case self::TYPE_LIST:
			default:
				return new MeetupList( $this->repository );
		}
	}
}
