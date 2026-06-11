<?php
// This program simply outputs the name passed into the command args.
if ($argc !== 2) {
	// Usage output
	echo "Usage: standalone.php [name]" . PHP_EOL;
	exit(1);
}

$name = $argv[1];
echo "Hello $name" . PHP_EOL;
exit(0);
