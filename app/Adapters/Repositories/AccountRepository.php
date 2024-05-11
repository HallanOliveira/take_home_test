<?php

namespace App\Adapters\Repositories;

use App\Core\Contracts\Repositories\AccountRepositoryInterface;
use App\Adapters\Repositories\BaseRepository;

class AccountRepository extends BaseRepository implements AccountRepositoryInterface
{
    /**
     * Model name
     *
     * @var string
     */
    protected string $modelName = 'Account';
}
