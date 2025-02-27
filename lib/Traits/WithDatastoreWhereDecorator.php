<?php

namespace PHPNomad\Datastore\Traits;

use PHPNomad\Datastore\Interfaces\DatastoreHasWhere;

trait WithDatastoreWhereDecorator {
    /**
     * @var $datastoreHandler
     */
    public function where(array $conditions, ?int $limit = null, ?int $offset = null, ?string $orderBy = null, string $order = 'ASC'): array
    {
        return $this->datastoreHandler->where($conditions, $limit, $offset, $orderBy, $order);
    }

    /** @inheritDoc */
    public function andWhere(array $conditions, ?int $limit = null, ?int $offset = null, ?string $orderBy = null, string $order = 'ASC'): array
    {
        return $this->datastoreHandler->andWhere($conditions, $limit, $offset, $orderBy, $order);
    }

    /** @inheritDoc */
    public function orWhere(array $conditions, ?int $limit = null, ?int $offset = null, ?string $orderBy = null, string $order = 'ASC'): array
    {
        return $this->datastoreHandler->orWhere($conditions, $limit, $offset, $orderBy, $order);
    }

    /** @inheritDoc */
    public function deleteWhere(array $conditions): void
    {
        $this->datastoreHandler->deleteWhere($conditions);
    }
}