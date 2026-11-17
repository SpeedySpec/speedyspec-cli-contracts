# speedyspec/cli-contracts

Small PHP value classes that plugins construct and return to the `speedyspec` CLI through hooks. The CLI compiles
these files into its binary and evaluates them at start-up without an autoloader, so the classes are final, readonly
and have no parent or interfaces. Validation happens in the CLI, not here.

A command handler has the shape `fn(array $arguments, array $options): int`. It receives values keyed by name,
writes with `echo` and returns the exit code.
