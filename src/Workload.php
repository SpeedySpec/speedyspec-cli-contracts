<?php

declare(strict_types=1);

namespace SpeedySpec\Cli\Contracts;

/**
 * Names the Kubernetes workload that serves an install, and where the app's files are inside its container.
 *
 * Only the app's plugin knows which of the resources it created runs the app, so the CLI asks it before working on a
 * Kubernetes install's files or database: the CLI's runner pod is placed beside that workload's pod, with the same
 * volumes, and works on the files at `root`.
 *
 * @param string $kind
 *   `Deployment` or `StatefulSet`.
 * @param string $root
 *   The install root inside the container, an absolute path such as `/var/www/html`.
 * @param ?string $container
 *   The app container, when the pod has several; null for the only one.
 */
final readonly class Workload
{
    public function __construct(
        public string $kind,
        public string $name,
        public string $root,
        public ?string $container = null,
    ) {
    }
}
