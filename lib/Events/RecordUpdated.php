<?php

namespace PHPNomad\Datastore\Events;

use PHPNomad\Events\Interfaces\Event;

class RecordUpdated implements Event
{
	/** @var array<string, mixed> */
	protected array  $data;

	/** @var array<string, mixed> */
	protected array  $identity;
	protected string $type;

	/**
	 * @param array<string, mixed> $identity
	 * @param array<string, mixed> $data
	 */
	public function __construct(string $type, array $identity, array $data)
	{
		$this->identity = $identity;
		$this->data = $data;
		$this->type = $type;
	}

	/**
	 * Gets the data used to store the record in the database.
	 *
	 * @return array<string, mixed>
	 */
	public function getData() : array
	{
		return $this->data;
	}

	/**
	 * Gets the identity for the record that was updated.
	 *
	 * @return array<string, mixed>
	 */
	public function getIdentity() : array
	{
		return $this->identity;
	}

	/**
	 * Gets the model type for the record that was updated.
	 *
	 * @return string
	 */
	public function getType() : string
	{
		return $this->type;
	}

	public static function getId() : string
	{
		return 'record_updated';
	}
}
