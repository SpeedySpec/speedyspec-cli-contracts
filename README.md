# speedyspec/cli-contracts

Small PHP value classes that plugins construct and return to the `speedyspec` CLI through hooks. The CLI compiles
these files into its binary and evaluates them at start-up without an autoloader, so the classes are final, readonly
and have no parent or interfaces. Validation happens in the CLI, not here.

A command handler has the shape `fn(array $arguments, array $options): int`. It receives values keyed by name,
writes with `echo` and returns the exit code.

Since 1.1.0, plugins that maintain an installed app answer the CLI with `AppRuntime` (how to load the app),
`DatabaseConnection` (where its database is) and `AppTask` (a file of PHP to run inside the app). The CLI describes the
install it is working on with `Install`.

Since 1.2.0, an app's plugin can finish an install with a `SetupPlan` (tasks run after the files are in place) and
describe its plugins and themes with an `ExtensionLayout` (where they live, and an `inspect` closure that turns a file
or directory into an `Extension`). Source plugins offer plugins and themes as `ExtensionSource`s, whose `resolve`
closure returns an `ExtensionArchive`: `fn(string $kind, string $slug, ?string $version): ?ExtensionArchive`.
