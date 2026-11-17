<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Declares a setting a plugin asks the user for during install.
 *
 * The CLI prompts for each declared option, hides the input of secret ones and passes the answers back in the install
 * request, so plugins can collect configuration without building their own prompts.
 */
final readonly class InstallOption
{
    public function __construct(
        public string $name,
        public string $label,
        public ?string $default = null,
        public bool $required = false,
        public bool $secret = false,
    ) {
    }
}
