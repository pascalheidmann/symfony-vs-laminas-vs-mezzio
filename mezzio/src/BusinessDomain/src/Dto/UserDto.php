<?php

declare(strict_types=1);

namespace BusinessDomain\Dto;

use DateTimeImmutable;

final readonly class UserDto
{
    public function __construct(
        public string $name,
        public DateTimeImmutable $birthday,
    )
    {
    }
}