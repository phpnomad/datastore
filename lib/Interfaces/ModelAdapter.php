<?php

namespace PHPNomad\Datastore\Interfaces;

/**
 * @template TModel of DataModel
 */
interface ModelAdapter
{
    /**
     * @param TModel $model
     * @return array
     */
    public function toArray(DataModel $model): array;

    /**
     * @param array $array
     * @return TModel
     */
    public function toModel(array $array): DataModel;
}