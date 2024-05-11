<?php

namespace App\Adapters\Repositories;

use App\Core\Contracts\Repositories\BaseInterface;
use Illuminate\Support\Facades\Cache;
use Exception;

abstract class BaseRepository implements BaseInterface
{
    /**
     * Model name
     *
     * @var string
     */
    protected string $modelName;

    public function __construct()
    {
        if (empty($this->modelName)) {
            $class           = class_basename($this::class);
            $this->modelName = str_replace('Repository', '', $class);
        }
    }

    /**
     * Find account by id
     *
     * @param integer $id
     * @return array
     */
    public function find(int $id): array
    {
        $record = Cache::get($this->modelName . '_' . $id);
        return $record ?? [];
    }

    /**
     * Create account
     *
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        return Cache::put($this->modelName . '_' . $data['id'], $data) ? $data : [];
    }

    /**
     * Update account
     *
     * @param integer $id
     * @param array $data
     * @return array
     */
    public function update(int $id, array $data): array
    {
        $record = $this->find($id);
        if (!empty($record)) {
            $record = array_merge($record, $data);
            Cache::put($this->modelName . '_' . $id, $record);
            return $record;
        }
        throw new \Exception('Record not found', 404);
    }

    /**
     * Delete account
     *
     * @param integer $id
     * @return array
     */
    public function delete(int $id): bool
    {
        $record = $this->find($id);
        if (!empty($record)) {
            return Cache::forget($this->modelName . '_' . $id);
        }
        throw new \Exception('Record not found', 404);
    }

    /**
     * Delete All
     *
     * @return array
     */
    public function deleteAll(): bool
    {
        return (bool) Cache::flush();
    }
}
