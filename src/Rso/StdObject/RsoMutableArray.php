<?php

/**
 * @author Harry Lawrence
 * @copyright Hazbo 2013
 * @package RsoMutableArray
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

class RsoMutableArray extends RsoArray implements \ArrayAccess
{
    /**
     * Constructs the array property.
     * Defaults to an empty PHP array.
     *
     * @param Array initial array
     */
    public function __construct()
    {
        $args   = func_get_args();
        $args[] = 'rso-non-fixed';

        parent::__construct($args);
    }

    /**
     * Allows you to add objects to
     * array the standard way.
     *
     * @param String array key
     * @param Object array object / value
     * 
     * @return RsoArray
     */
    public function offsetSet($offset, $value)
    {
        if (!is_int($offset)) {
            throw new \Exception("Array keys must be numeric; string passed");
        }
        if (!isset($this->array[$offset])) {
            $this->array[] = $value;
        } else {
            $this->array[$offset] = $value;
        }
        return $this;
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
     * Inserts a given object at the end
     * of the array.
     *
     * @param Object new object
     * 
     * @return RsoMutableArray
     */
    public function addObject($object)
    {
        $this->array[] = $object;
        return $this;
    }

    /**
     * Adds the objects contained in another
     * given array to the end of the receiving
     * array’s content.
     *
     * @param Array new objects
     * 
     * @return RsoMutableArray
     */
    public function addObjectsFromArray($objects)
    {
        $this->array = array_merge($this->array, $objects);
        return $this;
    }


    /**
     * Exchanges the objects in the array at given
     * indices.
     *
     * @param Int array index one
     * @param Int array index two
     * 
     * @return RsoMutableArray
     */
    public function exchangeObjectAtIndex($index_one, $index_two)
    {
        $temp_index_one = $this->array[$index_one];
        $this->array[$index_one] = $this->array[$index_two];
        $this->array[$index_two] = $temp_index_one;
        $temp_index_one = null;
        return $this;
    }

    /**
     * Inserts a given object into the array's
     * contents at a given index.
     *
     * @param Object new object
     * @param Int array index
     * 
     * @return RsoMutableArray
     */
    public function insertObject_atIndex($object, $index)
    {
        $this->array[$index] = $object;
        return $this;
    }

    /**
     * Empties the array of all its elements.
     * 
     * @return RsoMutableArray
     */
    public function removeAllObjects()
    {
        $this->array = array();
        return $this;
    }

    /**
     * Removes the object with the highest-valued
     * index in the array
     * 
     * @return RsoMutableArray
     */
    public function removeLastObject()
    {
        array_pop($this->array);
        return $this;
    }
}