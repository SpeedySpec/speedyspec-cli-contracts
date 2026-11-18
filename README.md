# speedyspec/cli-contracts

Small PHP value classes that plugins construct and return to the `speedyspec` CLI through hooks. The CLI compiles
these files into its binary and evaluates them at start-up without an autoloader, so the classes are final, readonly
and have no parent or interfaces. Validation happens in the CLI, not here.

A command handler has the shape `fn(array $arguments, array $options): int`. It receives values keyed by name,
writes with `echo` and returns the exit code.

Since 1.1.0, plugins that maintain an installed app answer the CLI with `AppRuntime` (how to load the app),
`DatabaseConnection` (where its database is) and `AppTask` (a file of PHP to run inside the app). The CLI describes the
install it is working on with `Install`.
