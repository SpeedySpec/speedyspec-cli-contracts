<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Names the file an app shows a maintenance page for, while the CLI swaps its plugins, themes or a restored copy.
 *
 * The CLI writes it before files are swapped and removes it afterwards, even when the swap fails, so visitors never
 * see a half-replaced site. WordPress's is `.maintenance`.
 *
 * @param string $path
 *   The file, relative to the install root.
 */
final readonly class MaintenanceFile
{
    public function __construct(
        public string $path,
        public string $contents,
    ) {
    }
}
