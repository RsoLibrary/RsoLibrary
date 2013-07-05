<?php

namespace Rso\StdObject;

class RsoMutableArray extends RsoArray
{
    /**
     * Constructs the array property.
     * Defaults to an empty PHP array.
     *
     * @param Array initial array
     * 
     */
	public function __construct($array = array())
	{
		$this->array = $array;
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