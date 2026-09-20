<?php

namespace PHPNomad\Datastore\Traits;

use LogicException;
use PHPNomad\Datastore\Interfaces\DataModel;
use PHPNomad\Datastore\Interfaces\Datastore;
use PHPNomad\Datastore\Interfaces\DatastoreHasIdentityQuery;
use PHPNomad\Datastore\Interfaces\DatastoreHasPrimaryKey;

trait WithDatastorePrimaryKeyDecorator
{
    protected Datastore $datastoreHandler;

    /**
     * @param mixed $id
     * @return DataModel
     */
    public function find($id): DataModel
    {
        return $this->datastoreHandler->find($id);
    }

    /**
     * @param array<array-key, mixed> $ids
     * @return array<array-key, DataModel>
     */
    public function findMultiple(array $ids): array
    {
        return $this->datastoreHandler->findMultiple($ids);
    }

    /**
     * @param mixed $id
     * @param array<string, mixed> $attributes
     */
    public function update($id, array $attributes): void
    {
        $this->datastoreHandler->update($id, $attributes);
    }

    /** @param mixed $id */
    public function delete($id): void
    {
        $this->datastoreHandler->delete($id);
    }

    /**
     * @param list<array{
     *     type?: string,
     *     groupType?: string,
     *     clauses: non-empty-list<array{column: string|list<string>, operator: string, value?: mixed}>
     * }> $conditions
     * @param positive-int|null $limit
     * @param int<0, max>|null $offset
     * @return array<array-key, array<string, int|string>>
     * @throws LogicException
     */
    public function findIds(array $conditions, ?int $limit = null, ?int $offset = null): array
    {
        if (!$this->datastoreHandler instanceof DatastoreHasIdentityQuery) {
            throw new LogicException('The decorated datastore does not support identity queries.');
        }

        return $this->datastoreHandler->findIds($conditions, $limit, $offset);
    }
}
