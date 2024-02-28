<?php

declare(strict_types=1);

namespace App\ExternalApi\ValueResolver;

use App\BusinessDomain\Dto\UserDto;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

final readonly class UserDtoResolver implements ValueResolverInterface
{
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $argumentType = $argument->getType();
        if (!$argumentType || !(is_subclass_of($argumentType, UserDto::class) || $argumentType === UserDto::class)) {
            return [];
        }

        $payload = $request->getPayload();

        yield new UserDto($payload->get('name'), new DateTimeImmutable($payload->get('birthday')));
    }
}