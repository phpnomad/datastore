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
