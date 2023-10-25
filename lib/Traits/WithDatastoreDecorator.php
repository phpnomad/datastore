<?php

namespace Phoenix\Datastore\Traits;

use Phoenix\Datastore\Interfaces\DataModel;
use Phoenix\Datastore\Interfaces\Datastore;

trait WithDatastoreDecorator
{
    protected Datastore $datastoreHandler;

    public function find($id): DataModel
    {
        // TODO: Implement find() method.
    }

    public function where(array $conditions, ?int $limit = null, ?int $offset = null): array
    {
        // TODO: Implement where() method.
    }

    public function findBy(string $field, $value): DataModel
    {
        // TODO: Implement findBy() method.
    }

    public function create(array $attributes): DataModel
    {
        // TODO: Implement create() method.
    }

    public function update($id, array $attributes): void
    {
        // TODO: Implement update() method.
    }

    public function delete($id): void
    {
        // TODO: Implement delete() method.
    }

    public function deleteWhere(array $conditions): void
    {
        // TODO: Implement deleteWhere() method.
    }

    public function count(array $conditions = []): int
    {
        // TODO: Implement count() method.
    }

    public function findIds(array $conditions, ?int $limit = null, ?int $offset = null): array
    {
        // TODO: Implement findIds() method.
    }
}