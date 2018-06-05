<?php

namespace WPMeetupList\Data;

/**
 * Meetup value object.
 *
 * @package WPMeetupList\Data
 */
final class Meetup {

	/**
	 * Meetup data.
	 *
	 * @var array
	 */
	private $data;

	/**
	 * Constructor. Set up a new instance.
	 *
	 * @param array $data Meetup data.
	 */
	public function __construct( array $data ) {

		$this->data = $data;
	}

	/**
	 * Return the name of the meetup.
	 *
	 * @return string Meetup name.
	 */
	public function name() {

		return isset( $this->data['name'] ) ? (string) $this->data['name'] : '';
	}

	/**
	 * Return the website URL of the meetup.
	 *
	 * @return string Meetup website URL.
	 */
	public function website() {

		return isset( $this->data['website'] ) ? (string) $this->data['website'] : '';
	}
}
