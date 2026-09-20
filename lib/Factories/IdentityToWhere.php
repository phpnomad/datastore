<?php

namespace PHPNomad\Datastore\Factories;

class IdentityToWhere
{
    /** @var array<string, mixed> */
    protected array $identity;

    /** @param array<string, mixed> $identity */
    public function __construct(array $identity)
    {
        $this->identity = $identity;
    }

    /**
     * Returns the where statement for a given identity.
     *
     * @return array<array-key, array{column: string, operator: '=', value: mixed}>
     */
    public function toWhere(): array
    {
        $where = [];
        foreach($this->identity as $column => $id){
            $where[] = ['column' => $column, 'operator' => '=', 'value' => $id];
        }

        return $where;
    }
}
