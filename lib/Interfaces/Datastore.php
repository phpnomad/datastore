<?php

namespace Phoenix\Datastore\Interfaces;

use Phoenix\Database\Exceptions\RecordNotFoundException;
use Phoenix\Datastore\Exceptions\DatastoreErrorException;
use Phoenix\Datastore\Exceptions\DuplicateEntryException;

interface Datastore
{
    /**
     * Query with conditions.
     *
     * @param array{column: string, operator: string, value: mixed}[] $conditions
     * @param positive-int|null $limit
     * @param positive-int|null $offset
     * @return DataModel[]
     * @throws DatastoreErrorException
     */
    public function where(array $conditions, ?int $limit = null, ?int $offset = null): array;

    /**
     * Finds the first available record that has the specified value in the specified column.
     *
     * @param string $field
     * @param $value
     * @return DataModel
     * @throws DatastoreErrorException
     * @throws RecordNotFoundException
     */
    public function findBy(string $field, $value): DataModel;

    /**
     * Insert a new record and return the instance.
     *
     * @param array<string, mixed> $attributes
     * @return DataModel The created model.
     * @throws DuplicateEntryException
     * @throws DatastoreErrorException
     */
    public function create(array $attributes): DataModel;

    /**
     * Delete a record from the database.
     *
     * @param array{string, string} $conditions - field values keyed by their respective field.
     * @return void
     * @throws DatastoreErrorException
     */
    public function deleteWhere(array $conditions): void;

    /**
     * Update a record in the database.
     *
     * @param array<string, int> $ids
     * @param array<string, mixed> $attributes
     * @return void
     * @throws RecordNotFoundException
     * @throws DatastoreErrorException
     */
    public function updateCompound(array $ids, array $attributes): void;
}
