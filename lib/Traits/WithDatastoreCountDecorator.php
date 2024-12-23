<?php

namespace PHPNomad\Datastore\Traits;


use PHPNomad\Datastore\Interfaces\Datastore;
use PHPNomad\Datastore\Interfaces\DatastoreHasCounts;

trait WithDatastoreCountDecorator {
    /**
     * @var Datastore&DatastoreHasCounts
     */
    protected Datastore $datastoreHandler;

    /** @inheritDoc */
    public function getEstimatedCount(): int
    {
        return $this->datastoreHandler->getEstimatedCount();
    }

    /** @inheritDoc */
    public function countWhere(array $conditions): int
    {
        return $this->datastoreHandler->countWhere($conditions);
    }
    /** @inheritDoc */
    public function countAndWhere(array $conditions): int
    {
        return $this->datastoreHandler->countAndWhere($conditions);
    }

    /** @inheritDoc */
    public function countOrWhere(array $conditions): int
    {
        return $this->datastoreHandler->countOrWhere($conditions);
    }
}