<?php

namespace PHPNomad\Datastore\Traits;


use PHPNomad\Datastore\Interfaces\Datastore;
use PHPNomad\Datastore\Interfaces\DatastoreHasEstimatedCount;

trait WithDatastoreEstimatedCountDecorator {
    /**
     * @var Datastore&DatastoreHasEstimatedCount
     */
    protected Datastore $datastoreHandler;

    /** @inheritDoc */
    public function getEstimatedCount(): int
    {
        return $this->datastoreHandler->getEstimatedCount();
    }
}