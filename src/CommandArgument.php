<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Declares a positional argument of a plugin command.
 *
 * The CLI parses the command line against these declarations and passes the values to the handler keyed by name,
 * so a plugin does not have to parse raw arguments itself.
 */
final readonly class CommandArgument
{
    public function __construct(
        public string $name,
        public string $description = '',
        public bool $required = true,
    ) {
    }
}
