<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Offers plugins and themes from one place, such as wordpress.org.
 *
 * Source plugins answer `speedyspec_extension_sources` with these, in the order they should be asked. The CLI calls
 * `resolve` on each in turn and takes the first archive it gets, so a private registry can sit before or after a
 * public one without the CLI knowing either.
 *
 * @param \Closure(string $kind, string $slug, ?string $version): ?ExtensionArchive $resolve
 *   Finds the archive of a plugin or theme, the latest when the version is null, or null when this source does not
 *   have it.
 */
final readonly class ExtensionSource
{
    public function __construct(
        public string $name,
        public \Closure $resolve,
    ) {
    }
}
