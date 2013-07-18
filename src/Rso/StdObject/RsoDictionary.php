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

class RsoDictionary extends \SplHeap implements \Countable
{
    protected $dictionary;

    /**
     * Constructs the dictionary property.
     * Defaults to an empty PHP array.
     *
     * @param Array initial dictionary
     */
    public function __construct($dictionary = array())
    {
        if (is_array($dictionary) && !empty($dictionary) && !(bool)count(array_filter(array_keys($dictionary), 'is_string'))) {
            throw new \Exception("Numeric array passed; Dictionaries must be associative");
        }
    }

    public function compare($dictionary)
    {
        return (array_values($this->dictionary) === array_values($dictionary)) ? true : false;
    }

    /**
     * Creates and returns a dictionary using
     * the keys and values found in a file
     * specified by a given path.
     *
     * @param String file path
     * 
     * @return RsoDictionary
     */
    public static function dictionaryWithContentsOfFile($file_path)
    {
        return new RsoDictionary(json_decode(file_get_contents($file_path), true));
    }

    /**
     * Creates and returns a dictionary using the
     * keys and values found in a resource specified
     * by a given URL.
     *
     * @param String url
     * 
     * @return RsoDictionary
     */
    public static function dictionaryWithContentsOfURL($url)
    {
        return new RsoDictionary(json_decode(file_get_contents($url), true));
    }

    /**
     * Creates and returns a dictionary containing
     * the keys and values from another given
     * dictionary.
     *
     * @param RsoDictionary initial dictionary
     * 
     * @return RsoDictionary
     */
    public static function dictionaryWithDictionary(RsoDictionary $dictionary)
    {
        return new RsoDictionary($dictionary);
    }

    /**
     * Creates and returns a dictionary containing
     * a given key and value.
     *
     * @param Object dictionary object
     * @param String dictionary key
     * 
     * @return RsoDictionary
     */
    public static function dictionaryWithObject_forKey($object, $key)
    {
        return new RsoDictionary(array($key => $object));
    }

    /**
     * Creates and returns a dictionary containing
     * entries constructed from the contents of an
     * array of keys and an array of values.
     *
     * @param Array dictionary objects
     * @param Array dictionary keys
     * 
     * @return RsoDictionary
     */
    public static function dictionaryWithObjects_forKeys($objects, $keys)
    {
        return new RsoDictionary(array_combine($keys, $objects));
    }

    /**
     * Returns a new array containing
     * the dictionary’s keys.
     *
     * @return RsoArray
     */
    public function allKeys()
    {
        return new RsoArray(array_keys($this->dictionary));
    }

    /**
     * Returns a new array containing
     * the dictionary’s values.
     *
     * @return RsoArray
     */
    public function allValues()
    {
        return new RsoArray(array_values($this->dictionary));
    }

    /**
     * Returns the number of entries in
     * the dictionary.
     *
     * @return Int
     */
    public function count()
    {
        // RsoNumber
        return count($this->dictionary);
    }

    /**
     * Returns a string that represents the
     * contents of the dictionary, formatted
     * as a property list.
     *
     * @return RsoString
     */
    public function description()
    {
        return new RsoString(str_replace("Array\n", "RsoDictionary\n", print_r($this->dictionary, true)));
    }

    /**
     * Applies a given block object to the
     * entries of the dictionary.
     *
     * @param Closure code block
     */
    public function enumerateKeysAndObjectsUsingBlock(\Closure $block)
    {
        foreach ($this->dictionary as $key => $value) {
            $block($key, $value);
        }
    }

    /**
     * Initializes a newly allocated dictionary
     * using the keys and values found in a file
     * at a given path.
     *
     * @param String file path
     *
     * @return RsoDictionary
     */
    public function initWithContentsOfFile($file_path)
    {
        $this->dictionary = json_decode(file_get_contents($file_path), true);
        return $this;
    }

    /**
     * Initializes a newly allocated dictionary
     * using the keys and values found at a given URL.
     *
     * @param String url
     *
     * @return RsoDictionary
     */
    public function initWithContentsOfUrl($url)
    {
        $this->dictionary = json_decode(file_get_contents($url), true);
        return $this;
    }

    /**
     * Initializes a newly allocated dictionary by
     * placing in it the keys and values contained
     * in another given dictionary.
     *
     * @param RsoDictionary initial dictionary
     *
     * @return RsoDictionary
     */
    public function initWithDictionary(RsoDictionary $dictionary)
    {
        $this->dictionary = $dictionary;
        return $this;
    }

    /**
     * Initializes a newly allocated dictionary with
     * entries constructed from the contents of the
     * objects and keys arrays.
     *
     * @param Array dictionary objects
     * @param Array dictionary keys
     *
     * @return RsoDictionary
     */
    public function initWithObjects_forKeys($objects = array(), $keys = array())
    {
        $this->dictionary = array_combine($keys, $objects);
        return $this;
    }

    /**
     * Returns a Boolean value that indicates whether
     * the contents of the receiving dictionary are
     * equal to the contents of another given dictionary.
     *
     * @param RsoDictionary dictionary to compare
     *
     * @return Bool
     */
    public function isEqualToDictionary($dictionary)
    {
        // RsoBool
        return ($this->dictionary == $dictionary) ? true : false;
    }

    /**
     * Returns the value associated with a given key.
     *
     * @param String object key
     *
     * @return Object
     */
    public function objectForKey($key)
    {
        return $this->dictionary[$key];
    }

    /**
     * Returns the value associated with a given key.
     *
     * @param String value key
     *
     * @return RsoString
     */
    public function valueForKey($key)
    {
        return new RsoString($this->dictionary[$key]);
    }
}