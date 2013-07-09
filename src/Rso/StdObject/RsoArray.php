<?php

/**
 * @author Harry Lawrence
 * @copyright Hazbo 2013
 * @package RsoArray
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

class RsoArray extends \ArrayObject implements \Countable
{
    protected $array;

    /**
     * Constructs the array property.
     * Defaults to an empty PHP array.
     *
     * @param Array initial array
     * 
     */
    public function __construct($array = array())
    {
        if (is_array($array) && (bool)count(array_filter(array_keys($array), 'is_string'))) {
            throw new \Exception("Associative array passed; Arrays must be numeric");
        }
        $this->array = $array;
    }

    /**
     * Cannot assign objects to an immutable
     * array. An exception will be thrown.
     */
    public function offsetSet($offset, $value)
    {
        throw new \Exception("Unable to assign object to an immutable array");
    }

    /**
     * Allows you to check if key
     * exists the standard way.
     *
     * @param String array key
     * 
     * @return Bool
     */
    public function offsetExists($offset)
    {
        // RsoBool
        return isset($this->array[$offset]);
    }

    /**
     * Allows you to unset objects in
     * the array the standard way.
     *
     * @param String array key
     * 
     * @return RsoArray
     */
    public function offsetUnset($offset)
    {
        unset($this->array[$offset]);
        return $this;
    }

    /**
     * Allows you to get objects
     * from the array the standard way.
     *
     * @param String array key
     * 
     * @return Object array object / value
     */
    public function offsetGet($offset)
    {
        return $this->array[$offset];
    }

    /**
     * Creates and returns an array containing
     * the objects in another given array.
     *
     * @param Array initial array
     * 
     * @return RsoArray
     */
    public static function arrayWithArray($array = array())
    {
        return new RsoArray($array);
    }

    /**
     * Creates and returns an array containing
     * the contents of the file specified by a
     * given path.
     *
     * @param String file path
     * 
     * @return RsoArray
     */
    public static function arrayWithContentsOfFile($file_path)
    {
        return new RsoArray(json_decode(file_get_contents($file_path), true));
    }

    /**
     * Creates and returns an array containing
     * the contents specified by a given URL.
     *
     * @param String url
     * 
     * @return RsoArray
     */
    public static function arrayWithContentsOfURL($url)
    {
        return new RsoArray(json_decode(file_get_contents($url), true));
    }


    /**
     * Creates and returns an array containing
     * a given object.
     *
     * @param Object new array object
     * 
     * @return RsoArray
     */
    public static function arrayWithObject($object)
    {
        return new RsoArray(array($object));
    }

    /**
     * Creates and returns an array containing
     * the objects in the argument list.
     *
     * @param Object, [Object...] list of objects
     * 
     * @return RsoArray
     */
    public static function arrayWithObjects()
    {
        return new RsoArray(func_get_args());
    }

    /**
     * Creates and returns an array that includes
     * a given number of objects from a given
     * PHP array.
     *
     * @param Object, [Object...] list of objects
     * @param Int count
     * 
     * @return RsoArray
     */
    public static function arrayWithObjects_count()
    {
        $args  = func_get_args();
        $count = end($args);
        array_pop($args);
        return new RsoArray(array_slice($args, 0, $count));
    }

    /**
     * Returns a new array that is a copy of the
     * receiving array with a given object added
     * to the end.
     *
     * @param Object new array object
     * 
     * @return RsoArray
     */
    public function arrayByAddingObject($object)
    {
        $array   = $this->array;
        $array[] = $object;
        return new RsoArray($array);
    }

    /**
     * Returns a new array that is a copy of the
     * receiving array with the objects contained
     * in another array added to the end.
     *
     * @param Array new array
     * 
     * @return RsoArray
     */
    public function arrayByAddingObjectsFromArray($array)
    {
        return new RsoArray(array_merge($this->array, $array));
    }

    /**
     * Constructs and returns an RsoString object
     * that is the result of interposing a given
     * separator between the elements of the array.
     *
     * @param String glue
     * 
     * @return RsoString
     */
    public function componentsJoinedByString($string)
    {
        return new RsoString((implode($string, $this->array)));
    }

    /**
     * Returns a Boolean value that indicates whether
     * a given object is present in the array.
     *
     * @param Object object to find
     * 
     * @return Bool
     */
    public function containsObject($object)
    {
        // RsoBool
        return in_array($object, $this->array);
    }

    /**
     * Returns the number of objects currently in
     * the array.
     *
     * @return RsoNumber
     */
    public function count()
    {
        // RsoNumber
        return count($this->array);
    }

    /**
     * Returns a string that represents the contents
     * of the array, formatted as a property list.
     * 
     * @return RsoString array description
     */
    public function description()
    {
        return new RsoString(str_replace("Array\n(", "RsoArray\n(", print_r($this->array, true)));
    }

    /**
     * Executes a given block using each object in the
     * array, starting with the first object and
     * continuing through the array to the last object.
     *
     * @param Closure code block
     */
    public function enumerateObjectsUsingBlock(\Closure $block)
    {
        foreach ($this->array as $key => $value) {
            $block($value, $key);
        }
    }

    /**
     * Returns the first object contained in the
     * receiving array that’s equal to an object
     * in another given array.
     *
     * @param Array array to compare
     *
     * @return Object array object / value
     */
    public function firstObjectCommonWithArray($array)
    {
        return current(array_intersect($this->array, $array));
    }

    /**
     * Returns the lowest index whose corresponding
     * array value is equal to a given object.
     *
     * @param Object object to find
     *
     * @return Int index of object
     */
    public function indexOfObject($object)
    {
        // RsoNumber
        return array_search($object, $this->array);
    }

    /**
     * Initializes a newly allocated array by placing
     * in it the objects contained in a given array.
     *
     * @param Array initial array
     *
     * @return RsoArray
     */
    public function initWithArray($array)
    {
        $this->array = $array;
        return $this;
    }

    /**
     * Initializes a newly allocated array with the
     * contents of the file specified by a given path.
     *
     * @param String file path
     *
     * @return RsoArray
     */
    public function initWithContentsOfFile($file_path)
    {
        $this->array = json_decode(file_get_contents($file_path), true);
        return $this;
    }

    /**
     * Initializes a newly allocated array with the
     * contents of the location specified by a given URL.
     *
     * @param String url
     *
     * @return RsoArray
     */
    public function initWithContentsOfURL($url)
    {
        $this->array = json_decode(file_get_contents($url), true);
        return $this;
    }

    /**
     * Initializes a newly allocated array by placing
     * in it the objects in the argument list.
     *
     * @param Object [Object...] list of objects
     *
     * @return RsoArray
     */
    public function initWithObjects()
    {
        $this->array = func_get_args();
        return $this;
    }

    /**
     * Initializes a newly allocated array to include
     * a given number of objects from a given PHP array.
     *
     * @param Object [Object...] list of objects
     * @param Int count
     *
     * @return RsoArray
     */
    public function initWithObjects_count()
    {
        $args  = func_get_args();
        $count = end($args);
        array_pop($args);
        $this->array = array_slice($args, 0, $count);
        return $this;
    }

    /**
     * Compares the receiving array to another array.
     *
     * @param Array array to compare
     *
     * @return Bool
     */
    public function isEqualToArray($array)
    {
        // RsoBool
        return ($this->array === $array) ? true : false;
    }

    /**
     * Returns the object in the array with the
     * highest index value.
     *
     * @return Object array object / value
     */
    public function lastObject()
    {
        return end($this->array);
    }

    /**
     * Returns the object located at index.
     *
     * @param Int array index
     *
     * @return Object array object / value
     */
    public function objectAtIndex($index)
    {
        return $this->array[$index];
    }

    /**
     * Returns an array containing the results
     * of invoking valueForKey: using key on each
     * of the array's objects.
     *
     * @param Int array key
     *
     * @return Object array object / value
     */
    public function valueForKey($key)
    {
        return $this->array[$key];
    }
}