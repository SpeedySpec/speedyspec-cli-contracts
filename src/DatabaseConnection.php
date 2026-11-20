<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Tells the CLI where an app's database is and how to sign in to it.
 *
 * Only the app's plugin knows where the app keeps these settings, so it answers with them and the CLI does the
 * database work itself. The password is a secret: the CLI never prints or records it, stack traces leave it out
 * and debug output shows it as hidden.
 *
 * A database across a network should be reached encrypted: `tls` is `off`, `required` (encrypted, the certificate
 * unchecked) or `verify` (the certificate must name the host and be signed by `caFile` or a public certificate
 * authority, which the CLI's MySQL client always trusts too).
 *
 * @param ?string $caFile
 *   The CA certificate, a path on the CLI's machine; required for `verify`.
 */
final readonly class DatabaseConnection
{
    public function __construct(
        public string $host,
        public string $database,
        public string $user,
        #[\SensitiveParameter]
        public string $password,
        public int $port = 3306,
        public ?string $socket = null,
        public string $tablePrefix = '',
        public string $charset = 'utf8mb4',
        public string $engine = 'mysql',
        public string $tls = 'off',
        public ?string $caFile = null,
    ) {
    }

    /**
     * Keeps the password out of var_dump() and print_r(), which a plugin or a library may call while debugging.
     *
     * @return array<string, mixed>
     *   The connection's fields, with the password hidden.
     */
    public function __debugInfo(): array
    {
        return ['password' => '[hidden]'] + get_object_vars($this);
    }
}
