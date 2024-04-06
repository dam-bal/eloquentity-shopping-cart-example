<?php

namespace Core\ShoppingCart\Domain;

class Entity
{
    protected ?string $id = null;

    protected function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?string
    {
        return $this->id;
    }
}