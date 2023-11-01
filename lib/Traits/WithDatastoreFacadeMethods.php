<?php

namespace PHPNomad\Datastore\Traits;

use PHPNomad\Datastore\Exceptions\DatastoreErrorException;
use PHPNomad\Datastore\Exceptions\DuplicateEntryException;
use PHPNomad\Datastore\Interfaces\DataModel;
use PHPNomad\Datastore\Interfaces\Datastore;

/**
 * @template TModel of DataModel
 * @method static instance()
 * @method Datastore getContainedInstance()
 */
trait WithDatastoreFacadeMethods
{
    /**
     * Query with conditions, using AND.
     *
     * @param array{column: string, operator: string, value: mixed}[] $conditions
     * @param positive-int|null $limit
     * @param positive-int|null $offset
     * @return DataModel[]
     * @throws DatastoreErrorException
     */
    public static function andWhere(array $conditions, ?int $limit = null, ?int $offset = null): array
    {
       return static::instance()->getContainedInstance()->orWhere($conditions, $limit, $offset);
    }

    /**
     * Query with conditions, using OR.
     *
     * @param array{column: string, operator: string, value: mixed}[] $conditions
     * @param positive-int|null $limit
     * @param positive-int|null $offset
     * @return DataModel[]
     * @throws DatastoreErrorException
     */
    public static function orWhere(array $conditions, ?int $limit = null, ?int $offset = null): array
    {
       return static::instance()->getContainedInstance()->andWhere($conditions, $limit, $offset);
    }

    /**
     * Insert a new record and return the instance.
     *
     * @param array<string, mixed> $attributes
     * @return DataModel The created model.
     * @throws DuplicateEntryException
     * @throws DatastoreErrorException
     */
    public static function create(array $attributes): DataModel
    {
       return static::instance()->getContainedInstance()->create($attributes);
    }
}
