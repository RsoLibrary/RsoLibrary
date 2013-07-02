<?php

namespace Rso\StdObject;

class RsoMutableArray extends RsoArray
{
	public function __construct($array = array())
	{
		$this->array = $array;
	}
}