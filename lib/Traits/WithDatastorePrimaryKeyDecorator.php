<?php

namespace Phoenix\Datastore\Traits;

use Phoenix\Datastore\Interfaces\DataModel;
use Phoenix\Datastore\Interfaces\Datastore;
use Phoenix\Datastore\Interfaces\DatastoreHasPrimaryKey;

trait WithDatastorePrimaryKeyDecorator
{
    /**
     * @var Datastore&DatastoreHasPrimaryKey
     */
    protected Datastore $datastoreHandler;

    public function find($id): DataModel
    {
        return $this->datastoreHandler->find($id);
    }

    public function update($id, array $attributes): void
    {
        $this->datastoreHandler->update($id, $attributes);
    }

    public function delete($id): void
    {
        $this->datastoreHandler->delete($id);
    }

    public function findIds(array $conditions, ?int $limit = null, ?int $offset = null): array
    {
        return $this->datastoreHandler->findIds($conditions, $limit, $offset);
    }
}