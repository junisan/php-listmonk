<?php

namespace Junisan\ListmonkApi\Models;

class SubscriberAttributesModel
{
    private array $attributes = [];

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->attributes);
    }

    public function get(string $key)
    {
        return $this->has($key) ? $this->attributes[$key] : null;
    }

    public function set(string $key, $value): self
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    public function delete(string $key)
    {
        if ($this->has($key)) {
            unset($this->attributes[$key]);
        }
    }

    public function getAll(): array
    {
        return array_merge([], $this->attributes);
    }

    public function count(): int
    {
        return count($this->attributes);
    }
}