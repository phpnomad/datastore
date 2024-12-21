<?php

namespace PHPNomad\Datastore\Interfaces;


use PHPNomad\Datastore\Exceptions\DatastoreErrorException;

interface DatastoreHasEstimatedCount {
    /**
     * Gets the estimated number of records in this datastore.
     * Note this is not intended to be 100% accurate, but should be close-enough for the majority of scenarios.
     *
     * @return int
     * @throws DatastoreErrorException
     */
    public function getEstimatedCount(): int;
}