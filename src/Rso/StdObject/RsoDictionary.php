<?php

/**
 * @author Harry Lawrence
 * @copyright Hazbo 2013
 * @package RsoDictionary
 * @version 0.1
 * @license The MIT License (MIT)
 *
 * The MIT License
 *
 * Copyright (c) 2013 Hazbo
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Rso\StdObject;

class RsoDictionary implements \Countable
{
	protected $dictionary;

	public function __construct($dictionary = array())
	{
		if (is_array($dictionary) && !(bool)count(array_filter(array_keys($dictionary), 'is_string'))) {
			// error
		}
	}

	public static function dictionaryWithContentsOfFile($file_path)
	{
		return new RsoDictionary(json_decode(file_get_contents($file_path), true));
	}

	public static function dictionaryWithContentsOfURL($url)
	{
		return new RsoDictionary(json_decode(file_get_contents($url), true));
	}

	public static function dictionaryWithDictionary(RsoDictionary $dictionary)
	{
		return new RsoDictionary($dictionary);
	}

	public static function dictionaryWithObject_forKey($object, $key)
	{
		return new RsoDictionary(array($key => $object));
	}

	public static function dictionaryWithObjects_forKeys($objects, $keys)
	{
		return new RsoDictionary(array_combine($keys, $objects));
	}

	public function allKeys()
	{
		return new RsoArray(array_keys($this->dictionary));
	}

	public function allKeysForObject()
	{

	}

	public function allValues()
	{
		return new RsoArray(array_values($this->dictionary));
	}

	public function count()
	{
		// RsoNumber
		return count($this->dictionary);
	}
}

