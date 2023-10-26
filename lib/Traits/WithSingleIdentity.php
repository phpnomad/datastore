<?php

namespace Phoenix\Datastore\Traits;

trait WithSingleIdentity
{
    protected int $id;

    /**
     * Gets the id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Gets the int ID.
     *
     * @return array
     */
    public function getIdentity(): array
    {
        return [$this->getId()];
    }

    /**
     * @return string[]
     */
    public static function getFieldsForIdentity(): array
    {
        return ['id'];
    }
}