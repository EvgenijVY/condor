<?php

declare(strict_types = 1);

namespace DTO;

class StatisticInfo
{
    public function __construct(
        public readonly string $name,
        public readonly int $count
    )
    {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}