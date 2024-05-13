<?php

namespace App\Repository\Interfaces;

use Doctrine\ORM\QueryBuilder;

interface AppRepositoryInterface
{
    public function createQueryBuilder(string $alias, ?string $indexBy = null): QueryBuilder;
}