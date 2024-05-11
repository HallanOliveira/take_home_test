<?php

namespace App\Core\Contracts\Repositories;

use Exception;

interface BaseInterface
{
    /**
     * Find account by id
     *
     * @param integer $id
     * @return array
     */
    public function find(int $id): array;

    /**
     * Create account
     *
     * @param array $data
     * @return array
     */
    public function create(array $data): array;

    /**
     * Update account
     *
     * @param integer $id
     * @param array $data
     * @return array
     */
    public function update(int $id, array $data): array;

    /**
     * Delete account
     *
     * @param integer $id
     * @return array
     */
    public function delete(int $id): bool;

    /**
     * Delete All
     *
     * @return array
     */
    public function deleteAll(): bool;
}
