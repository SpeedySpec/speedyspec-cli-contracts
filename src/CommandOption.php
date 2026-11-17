<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Declares a named option of a plugin command.
 *
 * The CLI parses the command line against these declarations and passes the values to the handler keyed by name,
 * so a plugin does not have to parse raw options itself.
 */
final readonly class CommandOption
{
    public function __construct(
        public string $name,
        public string $description = '',
        public bool $takesValue = true,
        public ?string $default = null,
    ) {
    }
}
