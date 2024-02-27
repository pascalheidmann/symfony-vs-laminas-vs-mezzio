<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\UserDto;

final readonly class GreetingsService
{
    public function __construct(private TimeService $timeService)
    {
    }

    public function getGreeting(UserDto $userDto): string
    {
        // same day of the year, ignoring everything else
        $hasBirthday = $this->timeService->now()->format('%m-%d') === $userDto->birthday->format('%m-%d');

        return $hasBirthday ? "Happy Birthday $userDto->name" : "Hello $userDto->name";
    }
}