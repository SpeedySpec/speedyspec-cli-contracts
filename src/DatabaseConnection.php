<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Tells the CLI where an app's database is and how to sign in to it.
 *
 * Only the app's plugin knows where the app keeps these settings, so it answers with them and the CLI does the
 * database work itself. The password is a secret: the CLI never prints or records it.
 */
final readonly class DatabaseConnection
{
    public function __construct(
        public string $host,
        public string $database,
        public string $user,
        public string $password,
        public int $port = 3306,
        public ?string $socket = null,
        public string $tablePrefix = '',
        public string $charset = 'utf8mb4',
        public string $engine = 'mysql',
    ) {
    }
}
