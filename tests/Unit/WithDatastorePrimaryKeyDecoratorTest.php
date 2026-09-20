<?php

namespace PHPNomad\Core\Tests\Unit;

use LogicException;
use PHPNomad\Core\Tests\TestCase;
use PHPNomad\Datastore\Interfaces\DataModel;
use PHPNomad\Datastore\Interfaces\Datastore;
use PHPNomad\Datastore\Interfaces\DatastoreHasIdentityQuery;
use PHPNomad\Datastore\Interfaces\DatastoreHasPrimaryKey;
use PHPNomad\Datastore\Traits\WithDatastorePrimaryKeyDecorator;

class WithDatastorePrimaryKeyDecoratorTest extends TestCase
{
    public function testIdentityQueriesDelegateToTheOptionalCapability(): void
    {
        $handler = new IdentityQueryHandlerFixture();
        $decorator = new PrimaryKeyDecoratorFixture($handler);
        $conditions = [[
            'clauses' => [['column' => 'status', 'operator' => 'IS NOT NULL']],
        ]];

        $this->assertSame([['id' => 17, 'externalId' => 'record-17']], $decorator->findIds($conditions, 1, 0));
        $this->assertSame([$conditions, 1, 0], $handler->lastIdentityQuery);
    }

    public function testIdentityQueriesFailClearlyWhenTheCapabilityIsUnavailable(): void
    {
        $decorator = new PrimaryKeyDecoratorFixture(new BaseDatastoreFixture());

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('does not support identity queries');

        $decorator->findIds([]);
    }

}

final class PrimaryKeyDecoratorFixture
{
    use WithDatastorePrimaryKeyDecorator;

    /** @var Datastore&DatastoreHasPrimaryKey */
    protected Datastore $datastoreHandler;

    /** @param Datastore&DatastoreHasPrimaryKey $handler */
    public function __construct(Datastore $handler)
    {
        $this->datastoreHandler = $handler;
    }
}

class BaseDatastoreFixture implements Datastore, DatastoreHasPrimaryKey
{
    public function create(array $attributes): DataModel
    {
        return new IdentityModelFixture();
    }

    public function updateCompound(array $ids, array $attributes): void
    {
    }

    public function find($id): DataModel
    {
        return new IdentityModelFixture();
    }

    /**
     * @param array<array-key, mixed> $ids
     * @return array<array-key, DataModel>
     */
    public function findMultiple(array $ids): array
    {
        return [new IdentityModelFixture()];
    }

    public function update($id, array $attributes): void
    {
    }

    public function delete($id): void
    {
    }
}

final class IdentityQueryHandlerFixture extends BaseDatastoreFixture implements DatastoreHasIdentityQuery
{
    /** @var array{array<mixed>, int|null, int|null}|null */
    public ?array $lastIdentityQuery = null;

    public function findIds(array $conditions, ?int $limit = null, ?int $offset = null): array
    {
        $this->lastIdentityQuery = [$conditions, $limit, $offset];

        return [['id' => 17, 'externalId' => 'record-17']];
    }
}

final class IdentityModelFixture implements DataModel
{
    public function getIdentity(): array
    {
        return ['id' => 17];
    }
}
