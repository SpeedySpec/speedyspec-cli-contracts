<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Points at the database row that holds an install's site URL.
 *
 * The CLI records the URL in a backup and replaces it everywhere when the backup is restored to another URL. The
 * table is named without the table prefix, which the CLI adds.
 */
final readonly class SiteUrl
{
    public function __construct(
        public string $table,
        public string $keyColumn,
        public string $key,
        public string $valueColumn,
    ) {
    }
}
