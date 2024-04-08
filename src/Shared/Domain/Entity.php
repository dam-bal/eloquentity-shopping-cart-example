<?php

namespace Core\Shared\Domain;

class Entity
{
    protected string $id;

    protected function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
