<?php

require_once __DIR__ . '/exceptions.php';

// This function should return a `ValidationException` when passed `true`;
// no exception otherwise
function riskyOperation(bool $fail): void {
	if ($fail) {
		throw new ValidationException("Validation Failed");
	}

	echo "Operation Succeeded" . PHP_EOL;
}

# Coerce the input to a boolean
$fail = filter_var($argv[1] ?? false, FILTER_VALIDATE_BOOLEAN);

# Fake operation
try {
	echo "Starting Operation..." . PHP_EOL;

	riskyOperation($fail);

	echo "This will not run if exception is thrown" . PHP_EOL;
}
catch (ValidationException $e) {
	echo "Caught ValidationException: " . $e->getMessage() . PHP_EOL;
}
catch (BaseException $e) {
	echo "Caught BaseException: " . $e->getMessage() . PHP_EOL;
}
catch (Exception $e) {
	echo "Caught generic Exception: " . $e->getMessage() . PHP_EOL;
}
finally {
	echo "Finally block always runs." . PHP_EOL;
}
