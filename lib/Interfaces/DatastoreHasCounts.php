<?php

namespace PHPNomad\Datastore\Interfaces;


use PHPNomad\Datastore\Exceptions\DatastoreErrorException;

interface DatastoreHasCounts {
    /**
     * Gets the estimated number of records in this datastore.
     * Note this is not intended to be 100% accurate, but should be close-enough for the majority of scenarios.
     *
     * @return int
     * @throws DatastoreErrorException
     */
    public function getEstimatedCount(): int;


    /**
     * Count the results with conditions, using AND/OR.
     *
     * @param array{type: string, clauses: array{column: string, operator: string, value: mixed}[]} $conditions
     * @return int
     * @throws DatastoreErrorException
     */
    public function countWhere(array $conditions): int;

    /**
     * Count the results with conditions, using AND.
     *
     * @param array{column: string, operator: string, value: mixed}[] $conditions
     * @return int
     * @throws DatastoreErrorException
     */
    public function countAndWhere(array $conditions): int;

    /**
     * Count the results with conditions, using OR.
     *
     * @param array{column: string, operator: string, value: mixed}[] $conditions
     * @return int
     * @throws DatastoreErrorException
     */
    public function countOrWhere(array $conditions): int;
}