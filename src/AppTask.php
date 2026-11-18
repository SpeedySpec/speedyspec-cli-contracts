<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Asks the CLI to run a piece of the plugin's PHP inside an app, in a separate process.
 *
 * Some work can only be done by the app's own code, such as activating a plugin so its activation hooks run. The
 * plugin ships that code as a file, named by its absolute path, which returns a callable taking the input; the CLI
 * runs it, with the app loaded unless asked not to, and hands back what the callable returns, which must be
 * JSON-encodable. A task still running after its timeout is stopped.
 *
 * @param array<array-key, mixed> $input
 *   The JSON-encodable values passed to the callable.
 */
final readonly class AppTask
{
    public function __construct(
        public string $file,
        public array $input = [],
        public bool $loadsApp = true,
        public int $timeoutSeconds = 600,
    ) {
    }
}
