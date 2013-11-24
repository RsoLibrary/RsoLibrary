<?php

/**
 * @author Harry Lawrence
 * @copyright Hazbo 2013
 * @package RsoMutableDictionary
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

namespace Rso\StdClass;

class RsoMutableDictionary extends RsoDictionary
{
	protected $dictionary;

    /**
     * Constructs the dictionary property.
     * Defaults to an empty PHP array.
     *
     * @param Array initial array
     */
	public function __construct($dictionary = array())
	{
		parent::__construct($dictionary);
	}

	/**
	 * Adds to the receiving dictionary the
	 * entries from another dictionary.
	 *
	 * @param Array new dictionary
	 *
	 * @return RsoDictionary
	 */
	public function addEntriesFromDictionary($dictionary = array())
	{
		$this->dictionary = array_merge($this->dictionary, $dictionary);
		return $this;
	}

	/**
	 * Each key and corresponding value object
	 * is unset.
	 *
	 * @return RsoDictionary
	 */
	public function removeAllObjects()
	{
		$this->dictionary = array();
		return $this;
	}

	/**
	 * Each key and corresponding value object
	 * is unset.
	 * 
	 * @param String object key
	 *
	 * @return RsoDictionary
	 */
	public function removeObjectForKey($key)
	{
		unset($this->dictionary[$key]);
		return $this;
	}

	/**
	 * Removes from the dictionary entries
	 * specified by elements in a given array.
	 * 
	 * @param Array object keys
	 *
	 * @return RsoDictionary
	 */
	public function removeObjectsForKeys($keys)
	{
		foreach ($keys as $key) {
			unset($this->dictionary[$key]);
		}
		return $this;
	}

	/**
	 * Removes from the dictionary entries
	 * specified by elements in a given array.
	 * 
	 * @param Array new dictionary
	 *
	 * @return RsoDictionary
	 */
	public function setDictionary($dictionary = array())
	{
		$this->dictionary = $dictionary;
		return $this;
	}

	/**
	 * Adds a given key-value pair to the
	 * dictionary.
	 * 
	 * @param Object key value
	 * @param String object key
	 *
	 * @return RsoDictionary
	 */
	public function setObject_forKey($object, $key)
	{
		$this->dictionary[$key] = $object;
		return $this;
	}

	/**
	 * Adds a given key-value pair to the
	 * dictionary.
	 * 
	 * @param Object key value
	 * @param String object key
	 *
	 * @return RsoDictionary
	 */
	public function setValue_forKey($value, $key)
	{
		$this->dictionary[$key] = $value;
		return $this;
	}
}