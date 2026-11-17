<?php

declare(strict_types=1);

use SpeedySpec\Cli\Contracts\App;
use SpeedySpec\Cli\Contracts\AppPart;
use SpeedySpec\Cli\Contracts\Command;
use SpeedySpec\Cli\Contracts\CommandArgument;
use SpeedySpec\Cli\Contracts\CommandOption;
use SpeedySpec\Cli\Contracts\InstallOption;
use SpeedySpec\Cli\Contracts\InstallRequest;
use SpeedySpec\Cli\Contracts\KubernetesResources;
use SpeedySpec\Cli\Contracts\WaitFor;
use SpeedySpec\Cli\Contracts\ZipSource;

it('holds what it is given', function () {
    $part = new AppPart('admin', 'Admin');
    $app = new App('speedyspec', 'SpeedySpec', [$part], ['zip']);
    expect($part->default)->toBeTrue()
        ->and($app->parts)->toBe([$part])
        ->and($app->drivers)->toBe(['zip']);
});

it('defaults the optional zip fields', function () {
    $zip = new ZipSource('https://example.com/a.zip', 'site');
    expect($zip->sha256)->toBeNull()->and($zip->stripComponents)->toBe(0);
});

it('treats an omitted waitFor as null, not an empty list', function () {
    expect((new KubernetesResources([]))->waitFor)->toBeNull();
});

it('is readonly', function (string $class, array $args, string $property) {
    $object = new $class(...$args);
    expect(fn () => $object->{$property} = 'x')->toThrow(Error::class);
})->with([
    'AppPart' => [AppPart::class, ['admin', 'Admin'], 'id'],
    'App' => [App::class, ['app', 'App', [], []], 'id'],
    'CommandArgument' => [CommandArgument::class, ['name'], 'name'],
    'CommandOption' => [CommandOption::class, ['name'], 'name'],
    'Command' => [Command::class, ['run', 'Runs', fn (array $a, array $o): int => 0], 'name'],
    'InstallOption' => [InstallOption::class, ['name', 'Name'], 'name'],
    'InstallRequest' => [InstallRequest::class, ['app', [], 'zip', [], []], 'app'],
    'ZipSource' => [ZipSource::class, ['https://example.com/a.zip', 'site'], 'url'],
    'WaitFor' => [WaitFor::class, ['deployment', 'web'], 'kind'],
    'KubernetesResources' => [KubernetesResources::class, [[]], 'resources'],
]);

it('is final and has no parent or interface', function (string $class) {
    $r = new ReflectionClass($class);
    expect($r->isFinal())->toBeTrue()
        ->and($r->getParentClass())->toBeFalse()
        ->and($r->getInterfaceNames())->toBe([]);
})->with([
    AppPart::class,
    App::class,
    CommandArgument::class,
    CommandOption::class,
    Command::class,
    InstallOption::class,
    InstallRequest::class,
    ZipSource::class,
    WaitFor::class,
    KubernetesResources::class,
]);
