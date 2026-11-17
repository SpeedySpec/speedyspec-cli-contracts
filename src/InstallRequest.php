<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Carries the user's install choices to the plugin that performs the install.
 *
 * The CLI builds this after prompting and hands it to the plugin, which turns it into the sources and resources to
 * deploy, so the plugin sees one resolved set of decisions instead of raw prompts.
 *
 * @param string[] $parts
 *   The ids of the selected parts.
 * @param array<string, string> $options
 *   The answers to the install options, keyed by option name.
 * @param array<string, string> $settings
 *   The settings resolved for the install, keyed by name.
 */
final readonly class InstallRequest
{
    public function __construct(
        public string $app,
        public array $parts,
        public string $driver,
        public array $options,
        public array $settings,
    ) {
    }
}
