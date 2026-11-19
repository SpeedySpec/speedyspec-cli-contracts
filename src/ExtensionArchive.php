<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Points at the zip archive of one version of a plugin or theme.
 *
 * A source returns this from its `resolve` closure. The archive holds one top-level directory with the plugin or
 * theme inside, which the CLI puts in place under the slug. The checksum is optional, because not every source
 * publishes one.
 */
final readonly class ExtensionArchive
{
    public function __construct(
        public string $kind,
        public string $slug,
        public string $version,
        public string $url,
        public ?string $sha256 = null,
    ) {
    }
}
