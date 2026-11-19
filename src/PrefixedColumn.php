<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Names a column whose values may begin with the table prefix.
 *
 * Some apps store keys built from the prefix (WordPress's `wp_user_roles` option and `wp_capabilities` user meta), so
 * when a restore changes the prefix, values in these columns that start with the old one get the new one. The table
 * is named without the prefix.
 */
final readonly class PrefixedColumn
{
    public function __construct(
        public string $table,
        public string $column,
    ) {
    }
}
