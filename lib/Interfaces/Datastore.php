<?php

namespace PHPNomad\Datastore\Interfaces;

use PHPNomad\Datastore\Exceptions\DatastoreErrorException;
use PHPNomad\Datastore\Exceptions\DuplicateEntryException;
use PHPNomad\Datastore\Exceptions\RecordNotFoundException;

/**
 * @template T of <DataModel>
 */
interface Datastore
{
    /**
     * Finds the first available record that has the specified value in the specified column.
     *
     * @param string $field
     * @param $value
     * @return T
     * @throws DatastoreErrorException
     * @throws RecordNotFoundException
     */
    public function findBy(string $field, $value): DataModel;

    /**
     * Insert a new record and return the instance.
     *
     * @param array<string, mixed> $attributes
     * @return T The created model.
     * @throws DuplicateEntryException
     * @throws DatastoreErrorException
     */
    public function create(array $attributes): DataModel;

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
