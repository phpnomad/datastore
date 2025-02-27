<?php

namespace PHPNomad\Datastore\Traits;

use PHPNomad\Datastore\Interfaces\DataModel;
use PHPNomad\Datastore\Interfaces\Datastore;

trait WithDatastoreDecorator
{
    /**
     * @var Datastore $datastoreHandler
     */
    /** @inheritDoc */
    public function findBy(string $field, $value): DataModel
    {
        return $this->datastoreHandler->findBy($field, $value);
    }

    /** @inheritDoc */
    public function create(array $attributes): DataModel
    {
        return $this->datastoreHandler->create($attributes);
    }

    /** @inheritDoc */
    public function updateCompound(array $ids, array $attributes): void
    {
        $this->datastoreHandler->updateCompound($ids, $attributes);
    }
}