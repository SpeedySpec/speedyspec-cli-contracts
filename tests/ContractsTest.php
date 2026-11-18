<?php

declare(strict_types=1);

use SpeedySpec\Cli\Contracts\App;
use SpeedySpec\Cli\Contracts\AppRuntime;
use SpeedySpec\Cli\Contracts\AppTask;
use SpeedySpec\Cli\Contracts\DatabaseConnection;
use SpeedySpec\Cli\Contracts\Install;
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
    'Install' => [Install::class, ['blog', 'wordpress', [], 'zip', '/srv/blog'], 'name'],
    'AppRuntime' => [AppRuntime::class, [], 'entry'],
    'DatabaseConnection' => [DatabaseConnection::class, ['db', 'blog', 'blog', 'secret'], 'host'],
    'AppTask' => [AppTask::class, ['/srv/task.php'], 'file'],
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
    Install::class,
    AppRuntime::class,
    DatabaseConnection::class,
    AppTask::class,
]);

it('defaults an app runtime to nothing to load and nothing to set', function () {
    $runtime = new AppRuntime();
    expect($runtime->entry)->toBeNull()
        ->and($runtime->ini)->toBe([])
        ->and($runtime->server)->toBe([]);
});

it('defaults the optional database fields to a MySQL server on its usual port', function () {
    $db = new DatabaseConnection('db', 'blog', 'blog', 'secret');
    expect($db->port)->toBe(3306)
        ->and($db->socket)->toBeNull()
        ->and($db->tablePrefix)->toBe('')
        ->and($db->charset)->toBe('utf8mb4')
        ->and($db->engine)->toBe('mysql');
});

it('defaults a task to loading the app with ten minutes to finish', function () {
    $task = new AppTask('/srv/task.php');
    expect($task->input)->toBe([])
        ->and($task->loadsApp)->toBeTrue()
        ->and($task->timeoutSeconds)->toBe(600);
});

it('holds an install with no local root', function () {
    $install = new Install('shop', 'wordpress', ['site'], 'kubernetes', null);
    expect($install->root)->toBeNull()->and($install->parts)->toBe(['site']);
});

it('marks the database password as sensitive, so stack traces leave it out', function () {
    $password = (new ReflectionMethod(DatabaseConnection::class, '__construct'))->getParameters()[3];
    expect($password->getName())->toBe('password')
        ->and($password->getAttributes(SensitiveParameter::class))->toHaveCount(1);
});

it('leaves the database password out of debug output', function (string $dump) {
    $db = new DatabaseConnection('db', 'blog', 'blog', 'hunter2-secret');
    if ($dump === 'var_dump')
    {
        ob_start();
        var_dump($db);
        $output = (string) ob_get_clean();
    }
    else
    {
        $output = print_r($db, true);
    }
    expect($output)->not->toContain('hunter2-secret')
        ->and($output)->toContain('blog');
})->with(['var_dump', 'print_r']);

it('still gives the CLI the password itself', function () {
    expect((new DatabaseConnection('db', 'blog', 'blog', 'hunter2-secret'))->password)->toBe('hunter2-secret');
});
