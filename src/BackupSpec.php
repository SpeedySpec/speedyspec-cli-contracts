<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Tells the CLI what a backup of an install holds and how to move it to another site.
 *
 * The CLI does the backing up, the restoring and the move to a new URL and table prefix itself. Where the files and
 * the site URL are, and which values carry the table prefix, is the app's business, so the app's plugin answers
 * `speedyspec_app_backup` with this description. `preserve` paths are archived but never restored over the target's
 * own copy (an app's configuration, which names the target's own database).
 *
 * @param list<string> $include
 *   Paths, relative to the install root, that the backup holds.
 * @param list<string> $exclude
 *   Paths under those that it leaves out, such as caches.
 * @param list<string> $preserve
 *   Paths a restore keeps from the target.
 * @param list<PrefixedColumn> $prefixedColumns
 *   Columns whose values start with the table prefix and are renamed with it.
 * @param list<TableColumn> $keepUrls
 *   Columns whose values keep the old site URL when a restore moves the site, such as identifiers that only look like
 *   links.
 */
final readonly class BackupSpec
{
    public function __construct(
        public array $include = ['.'],
        public array $exclude = [],
        public array $preserve = [],
        public ?SiteUrl $siteUrl = null,
        public array $prefixedColumns = [],
        public ?string $appVersion = null,
        public array $keepUrls = [],
    ) {
    }
}
