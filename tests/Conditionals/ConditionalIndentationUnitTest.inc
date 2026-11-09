<?php
// Single line conditionals are not checked.
if ( true && false ) {
	echo 'test';
}

// Multiline conditionals indented one level are valid.
if (
	true
	&& false
) {
	echo 'test';
}

while (
	$condition
	&& $other_condition
) {
	do_something();
}

foreach (
	$array as $key
	=> $value
) {
	process( $key, $value );
}

for (
	$i = 0;
	$i < count( $array );
	$i++
) {
	echo $array[ $i ];
}

if ( $outer ) {
	if (
		$inner
		&& $other
	) {
		nested_action();
	}
}

// Comments inside the condition are skipped.
if (
	// Check the first condition.
	$first_condition
	&& $second_condition
) {
	execute();
}

// A condition with no indentation is an error on each line.
if (
true
&& false
) {
	echo 'test';
}

// Over indentation is an error.
foreach (
		$items as $item
		=> $value
) {
	process( $item );
}

// Inconsistent indentation is an error on the odd line only.
if (
	true
		&& false
) {
	echo 'test';
}

// Content on the same line as the opening parenthesis is an error.
if ( true
	&& false
) {
	echo 'test';
}
