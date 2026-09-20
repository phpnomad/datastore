<?php

namespace PHPNomad\Core\Tests\StaticAnalysis;

use PHPNomad\Datastore\Interfaces\DatastoreHasIdentityQuery;

function projectedIdentity(DatastoreHasIdentityQuery $datastore): string
{
    $rows = $datastore->findIds([
        [
            'type' => 'AND',
            'groupType' => 'OR',
            'clauses' => [
                ['column' => ['tenantId', 'externalId'], 'operator' => 'IN', 'value' => [[1, 'record-17']]],
                ['column' => 'deletedAt', 'operator' => 'IS NULL'],
            ],
        ],
    ], 1, 0);

    return (string) $rows[0]['externalId'];
}
