<?php

namespace Phoenix\Datastore\Interfaces;

use Phoenix\Database\Exceptions\RecordNotFoundException;
use Phoenix\Datastore\Exceptions\DatastoreErrorException;
use Phoenix\Datastore\Exceptions\DuplicateEntryException;

interface WithPrimaryKey
{
    /**
     * Retrieve a record by its primary key.
     *
     * @param mixed $id
     * @return DataModel
     * @throws DatastoreErrorException
     * @throws RecordNotFoundException
     */
    public function find($id): DataModel;

    /**
     * Update a record in the database.
     *
     * @param mixed $id
     * @param array<string, mixed> $attributes
     * @return void
     * @throws RecordNotFoundException
     * @throws DuplicateEntryException
     * @throws DatastoreErrorException
     */
    public function update($id, array $attributes): void;

    /**
     * Delete a record from the database.
     *
     * @param mixed $id
     * @return void
     * @throws DatastoreErrorException
     */
    public function delete($id): void;

    /**
     * Query the database with conditions.
     *
     * @param array{column: string, operator: string, value: mixed}[] $conditions
     * @param positive-int|null $limit
     * @param positive-int|null $offset
     * @return int[]
     * @throws DatastoreErrorException
     */
    public function findIds(array $conditions, ?int $limit = null, ?int $offset = null): array;
}