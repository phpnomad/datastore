<?php

namespace PHPNomad\Datastore\Events;

use PHPNomad\Datastore\Interfaces\DataModel;
use PHPNomad\Events\Interfaces\Event;

class RecordDeleted implements Event
{
    protected string $type;

    /** @var array<string, mixed> */
    protected array $identity;

    /**
     * @param class-string<DataModel>|string $type
     * @param array<string, mixed> $identity
     */
    public function __construct(string $type, array $identity)
    {
        $this->type = $type;
        $this->identity = $identity;
    }

    /**
     * Gets the identity for the record that was deleted.
     *
     * @return array<string, mixed>
     */
    public function getIdentity(): array
    {
        return $this->identity;
    }

    /**
     * Gets the model type this record was deleted from.
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    public static function getId(): string
    {
        return 'record_deleted';
    }
}
