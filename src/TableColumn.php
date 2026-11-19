<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Names one column of an app's table, the table without its prefix.
 *
 * A `BackupSpec` lists the columns whose values must keep the old site URL when a restore moves a site: WordPress's
 * post GUIDs are identifiers that feed readers rely on, not links, so they are never rewritten.
 */
final readonly class TableColumn
{
    public function __construct(
        public string $table,
        public string $column,
    ) {
    }
}
