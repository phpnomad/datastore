<?php

namespace PHPNomad\Datastore\Traits;

use PHPNomad\Datastore\Interfaces\DataModel;
use PHPNomad\Datastore\Interfaces\Datastore;

trait WithDatastoreDecorator
{
    protected Datastore $datastoreHandler;

    /** @inheritDoc */
    public function andWhere(array $conditions, ?int $limit = null, ?int $offset = null): array
    {
        return $this->datastoreHandler->andWhere($conditions, $limit, $offset);
    }

    /** @inheritDoc */
    public function orWhere(array $conditions, ?int $limit = null, ?int $offset = null): array
    {
        return $this->datastoreHandler->orWhere($conditions, $limit, $offset);
    }

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
    public function deleteWhere(array $conditions): void
    {
        $this->datastoreHandler->deleteWhere($conditions);
    }

    /** @inheritDoc */
    public function updateCompound(array $ids, array $attributes): void
    {
        $this->datastoreHandler->updateCompound($ids, $attributes);
    }
}