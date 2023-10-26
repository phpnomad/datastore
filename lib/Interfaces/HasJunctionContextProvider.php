<?php

namespace Phoenix\Datastore\Interfaces;

interface HasJunctionContextProvider
{
    public function getJunctionContextProvider(): JunctionContextProvider;
}