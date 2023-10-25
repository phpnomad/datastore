<?php

namespace Phoenix\Datastore\Interfaces;

interface JunctionContextProvider
{
    /**
     * Gets the resource identifier
     *
     * @return string
     */
    public function getResource(): string;

    /**
     * Gets the datastore that binds to the opposite table.
     *
     * @return Datastore
     */
    public function getDatastore(): Datastore;

    /**
     * Gets the name of the primary junction field that binds this record to the other record.
     *
     * @return string
     */
    public function getJunctionFieldName(): string;

    /**
     * Gets the attributes that this table can contribute to the junction table.
     *
     * @return array<string, mixed>
     */
    public function getCreateAttributes(): array;
}