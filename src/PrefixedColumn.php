<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Names a column whose values may begin with the table prefix.
 *
 * Some apps store keys built from the prefix (WordPress's `wp_user_roles` option and `wp_capabilities` user meta), so
 * when a restore changes the prefix, values in these columns that start with the old one get the new one. The table
 * is named without the prefix.
 *
 * Where only some values are built from the prefix and others merely start with the same letters (WordPress options
 * such as `wp_page_for_privacy_policy`), `keys` names the ones that are, without the prefix (`user_roles`); only the
 * prefix followed by exactly one of them is renamed. Null renames every value that starts with the prefix.
 *
 * @param ?list<string> $keys
 *   The keys, without the prefix, that are built from it; null for all.
 */
final readonly class PrefixedColumn
{
    public function __construct(
        public string $table,
        public string $column,
        public ?array $keys = null,
    ) {
    }
}
