<?php

namespace PHPNomad\Datastore\Interfaces;

/**
 * @template TModel of DataModel
 */
interface CanConvertModelToArray
{
    /**
     * @param TModel $model
     * @return array<string, mixed>
     */
    public function toArray(DataModel $model): array;
}
