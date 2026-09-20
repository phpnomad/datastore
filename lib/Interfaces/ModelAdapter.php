<?php

namespace PHPNomad\Datastore\Interfaces;

/**
 * @template TModel of DataModel
 * @extends CanConvertModelToArray<TModel>
 */
interface ModelAdapter extends CanConvertModelToArray
{
    /**
     * @param array<string, mixed> $array
     * @return TModel
     */
    public function toModel(array $array): DataModel;
}
