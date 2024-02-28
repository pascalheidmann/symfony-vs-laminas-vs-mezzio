<?php

declare(strict_types=1);

namespace BusinessDomain\Service;

class TimeService
{
    public function now(): \DateTimeImmutable {
        return new \DateTimeImmutable();
    }
}