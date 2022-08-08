<?php

namespace Votes\domain;

use Ramsey\Uuid\UuidFactory;

class Entity
{
    public function __construct(
        public $props,
        protected ?string $uuid = null
    ) {
        if (is_null($this->uuid)) {

            $this->uuid = strval((new UuidFactory())->uuid4());
        }
    }

    public function getId(): string
    {
        return $this->uuid;
    }
}
