<?php

namespace PHPNomad\Datastore\Interfaces;

use InvalidArgumentException;
use PHPNomad\Datastore\Exceptions\DatastoreErrorException;

/**
 * Optional capability for datastores that can project record identities.
 *
 * @phpstan-type IdentityQueryClause array{
 *     column: string|list<string>,
 *     operator: string,
 *     value?: mixed
 * }
 * @phpstan-type IdentityQueryGroup array{
 *     type?: string,
 *     groupType?: string,
 *     clauses: non-empty-list<IdentityQueryClause>
 * }
 * @phpstan-type DatastoreIdentity array<string, int|string>
 */
interface DatastoreHasIdentityQuery
{
    /**
     * Retrieve identity-field rows matching grouped conditions.
     *
     * @param list<IdentityQueryGroup> $conditions
     * @param positive-int|null $limit
     * @param int<0, max>|null $offset
     * @return array<array-key, DatastoreIdentity>
     * @throws DatastoreErrorException
     * @throws InvalidArgumentException When conditions or pagination values are invalid.
     */
    public function findIds(array $conditions, ?int $limit = null, ?int $offset = null): array;
}
