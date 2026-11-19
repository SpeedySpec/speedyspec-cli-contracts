<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Tells the CLI where an app keeps its plugins and themes, and how to recognize one.
 *
 * The CLI installs, updates and deletes plugin and theme files itself, but where they go and what counts as one is
 * the app's business. The app's plugin answers `speedyspec_app_extensions` with this layout. The CLI calls
 * `inspect` with the absolute path of each entry in a kind's directory, and the closure returns null for anything
 * that is not a plugin or theme.
 *
 * @param array<string, string> $directories
 *   Each kind (`plugin`, `theme`) the app has, mapped to its directory relative to the install root.
 * @param \Closure(string $kind, string $path): ?Extension $inspect
 *   Reads one entry of a kind's directory.
 */
final readonly class ExtensionLayout
{
    public function __construct(
        public array $directories,
        public \Closure $inspect,
    ) {
    }
}
