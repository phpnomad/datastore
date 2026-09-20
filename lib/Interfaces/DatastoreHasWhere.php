<?php

namespace PHPNomad\Datastore\Interfaces;


use PHPNomad\Datastore\Exceptions\DatastoreErrorException;
use PHPNomad\Datastore\Exceptions\RecordNotFoundException;

/**
 * @template T of DataModel
 */
interface DatastoreHasWhere {
    /**
     * Query with conditions, using a combination of AND/OR.
     * Classes implementing this should assume type and groupType are AND if they are not set.
     *
     * @param array<array-key, array{type?: string, groupType?: string, clauses: array<array-key, array{column: string|list<string>, operator: string, value: mixed}>}> $conditions
     * @param positive-int|null $limit
     * @param positive-int|null $offset
     * @return T[]
     * @throws DatastoreErrorException
     */
    public function where(array $conditions, ?int $limit = null, ?int $offset = null, ?string $orderBy = null, string $order = 'ASC'): array;

    /**
     * Query with conditions, using AND.
     *
     * @param array<array-key, array{column: string|list<string>, operator: string, value: mixed}> $conditions
     * @param positive-int|null $limit
     * @param positive-int|null $offset
     * @return T[]
     * @throws DatastoreErrorException
     */
    public function andWhere(array $conditions, ?int $limit = null, ?int $offset = null, ?string $orderBy = null, string $order = 'ASC'): array;

    /**
     * Query with conditions, using OR.
     *
     * @param array<array-key, array{column: string|list<string>, operator: string, value: mixed}> $conditions
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

    /**
     * Finds the first available record that has the specified value in the specified column.
     *
     * @param string $field
     * @param mixed $value
     * @return T
     * @throws DatastoreErrorException
     * @throws RecordNotFoundException
     */
    public function findBy(string $field, $value): DataModel;
}
