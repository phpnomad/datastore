<?php

namespace PHPNomad\Datastore\Traits;

use PHPNomad\Datastore\Interfaces\DataModel;
use PHPNomad\Datastore\Interfaces\Datastore;

trait WithDatastoreDecorator
{
    protected Datastore $datastoreHandler;

    public function where(array $conditions, ?int $limit = null, ?int $offset = null): array
    {
        return $this->datastoreHandler->where($conditions, $limit, $offset);
    }

    public function findBy(string $field, $value): DataModel
    {
        return $this->datastoreHandler->findBy($field, $value);
    }

    public function create(array $attributes): DataModel
    {
        return $this->datastoreHandler->create($attributes);
    }

    public function deleteWhere(array $conditions): void
    {
        $this->datastoreHandler->deleteWhere($conditions);
    }

    public function updateCompound(array $ids, array $attributes): void
    {
        $this->datastoreHandler->updateCompound($ids, $attributes);
    }
}