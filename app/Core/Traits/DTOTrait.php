<?php

namespace App\Core\Traits;

/**
 * Trait DTOTrait
 *
 * Data Transfer Object Trait
 *
 * @package App\Core\Traits
 * @method static AccountDTO create(array $values)
 * @method array toArray()
 */
trait DTOTrait
{
    public static function create(array $values): self
    {
        $dto = new self();
        foreach ($values as $key => $value) {
            if (property_exists($dto, $key)) {
                $dto->$key = $value;
            }
        }

        return $dto;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
