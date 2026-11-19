<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Describes one plugin or theme found in an install.
 *
 * Only the app's plugin knows how its app marks a plugin or a theme (WordPress reads headers in a PHP file or a
 * stylesheet), so it reports what it found in this shape and the CLI lists and compares versions from it.
 */
final readonly class Extension
{
    public function __construct(
        public string $kind,
        public string $slug,
        public string $name,
        public ?string $version = null,
    ) {
    }
}
