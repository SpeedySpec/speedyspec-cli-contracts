<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Names a zip archive the CLI should download and unpack for an install.
 *
 * The CLI fetches the archive, verifies the checksum when one is given and extracts it into the destination, so a
 * plugin can ship files without implementing download and verification.
 */
final readonly class ZipSource
{
    public function __construct(
        public string $url,
        public string $destination,
        public ?string $sha256 = null,
        public int $stripComponents = 0,
    ) {
    }
}
