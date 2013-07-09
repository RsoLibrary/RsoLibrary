# Rso Library

Rso Library is as set of classes written in PHP that allow you to use common data types as objects.

## Current Implementations

`RsoArray`

`RsoDictionary`

`RsoMutableArray`

`RsoMutableDictionary`

`RsoNull`

`RsoNumber`

`RsoString`

## Install

You can install the Rso Libraries using composer

	{
		"require" : {
			"rso/lib" : "dev-master"
		}
	}

## Simple Usage
#### RsoArray Example

	<?php

	require('vendor/autoload.php');

	use Rso\Stdobject\RsoArray;

	// Create a new instance of RsoArray
	$array_one = new RsoArray();

	// Or create one staticly
	$array_two = RsoArray::arrayWithObjects('object 1', 'object 2', 'object 3');

	// Count array elements
	echo $array_two->count();

	// Search through arrays
	if ($array_two->containsObject('object 3')) {
		echo 'Object was found!';
	}

	// Enumerate through arrays using the keys and values
	$array_two->enumerateObjectsUsingBlock(function($value, $key) {
		echo $value . "<br />";
	});

Above is just a very small example of how the RsoArray class can be used. Array objects can
also be accessed the usual way:

	echo $array_two[0];

However to set objects using this method you will need to create a mutable array.

	<?php

	require('vendor/autoload.php');

	use Rso\Stdobject\RsoMutableArray;

	$array = new RsoMutableArray();

	$array[0] = 'Zero';

	echo $array[0];

## Documentation

Coming Soon!
