<?php

declare(strict_types=1);

namespace Fixture;

class Greeter
{
    public function greet(string $name): string
    {
        if (
            $name === ''
        ) {
            return 'Hello, world.';
        }

        return 'Hello, ' . $name . '.';
    }
}
