<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Bundles the manifests a plugin wants applied to a cluster.
 *
 * The CLI applies the resources and then waits for each condition listed, so a plugin describes the desired state
 * and readiness without driving kubectl itself. A null wait list means the plugin expressed no preference, which
 * differs from an empty list.
 *
 * @param array[] $resources
 *   The manifests to apply, each as a decoded document.
 * @param WaitFor[]|null $waitFor
 *   The conditions to await after applying, or null when none were declared.
 */
final readonly class KubernetesResources
{
    public function __construct(
        public array $resources,
        public ?array $waitFor = null,
    ) {
    }
}
