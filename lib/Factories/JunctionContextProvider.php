<?php

namespace Phoenix\Datastore\Factories;

use Phoenix\Datastore\Interfaces\Datastore;
use Phoenix\Datastore\Interfaces\JunctionContextProvider as JunctionContextProviderInterface;

class JunctionContextProvider implements JunctionContextProviderInterface
{
    protected string $resource;
    protected Datastore $datastore;
    protected string $junctionFieldName;

    public function __construct(string $resource, Datastore $datastore, string $junctionFieldName)
    {
        $this->resource = $resource;
        $this->datastore = $datastore;
        $this->junctionFieldName = $junctionFieldName;
    }
    public function getResource(): string
    {
        return $this->resource;
    }

    public function getDatastore(): Datastore
    {
        return $this->datastore;
    }

    public function getJunctionFieldName(): string
    {
        return $this->junctionFieldName;
    }
}