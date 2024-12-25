<?php

namespace PHPNomad\Datastore\Interfaces;


use PHPNomad\Datastore\Exceptions\DatastoreErrorException;

/**
 * @template T of <DataModel>
 */
interface DatastoreHasWhere {
    /**
     * Query with conditions, using a combination of AND/OR.
     * Classes implementing this should assume type and groupType are AND if they are not set.
     *
     * @param array{type?: string, groupType?: string, clauses: array{column: string, operator: string, value: mixed}[]}[] $conditions
     * @param positive-int|null $limit
     * @param positive-int|null $offset
     * @return T[]
     * @throws DatastoreErrorException
     */
    public function where(array $conditions, ?int $limit = null, ?int $offset = null, ?string $orderBy = null, string $order = 'ASC'): array;

    /**
     * Query with conditions, using AND.
     *
     * @param array{column: string, operator: string, value: mixed}[] $conditions
     * @param positive-int|null $limit
     * @param positive-int|null $offset
     * @return T[]
     * @throws DatastoreErrorException
     */
    public function andWhere(array $conditions, ?int $limit = null, ?int $offset = null, ?string $orderBy = null, string $order = 'ASC'): array;

    /**
     * Query with conditions, using OR.
     *
     * @param array{column: string, operator: string, value: mixed}[] $conditions
     * @param positive-int|null $limit
     * @param positive-int|null $offset
     * @return T[]
     * @throws DatastoreErrorException
     */
    public function orWhere(array $conditions, ?int $limit = null, ?int $offset = null, ?string $orderBy = null, string $order = 'ASC'): array;

    /**
     * Delete a record from the database.
     *
     * @param array{string, string} $conditions - field values keyed by their respective field.
     * @return void
     * @throws DatastoreErrorException
     */
    public function deleteWhere(array $conditions): void;
}