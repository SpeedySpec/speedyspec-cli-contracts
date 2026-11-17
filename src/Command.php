<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Registers a command a plugin adds to the CLI.
 *
 * The CLI exposes the command in its help and, when invoked, calls the handler with the parsed arguments and options
 * keyed by name. The handler writes output with echo and returns the exit code, so plugins extend the CLI without
 * it knowing what the command does.
 *
 * @param CommandArgument[] $arguments
 *   The positional arguments the command accepts.
 * @param CommandOption[] $options
 *   The options the command accepts.
 */
final readonly class Command
{
    public function __construct(
        public string $name,
        public string $description,
        public \Closure $handler,
        public array $arguments = [],
        public array $options = [],
    ) {
    }
}
