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

class RsoString
{
    /**
     * @var String the initial string
     */
    protected $string;

    /**
     * Constructs the string property.
     * Defaults to an empty PHP string.
     *
     * @param String initial string
     * 
     */
    public function __construct($string = "")
    {
        $this->string = $string;
    }

    /**
     * Converts and returns string property
     * to string.
     * 
     * @return String
     */
    public function __toString()
    {
        return $this->string;
    }

    /**
     * Returns a string created by reading
     * data from the file at a given path.
     *
     * @param String file path
     * 
     * @return RsoString
     */
    public static function stringWithContentsOfFile($file_path)
    {
        return new RsoString(file_get_contents($file_path));
    }

    /**
     * Returns a string created by reading
     * data from a given URL.
     *
     * @param String url
     * 
     * @return RsoString
     */
    public static function stringWithContentsOfUrl($url)
    {
        return new RsoString(file_get_contents($url));
    }

    /**
     * Returns a string created by using a given
     * format string as a template into which the
     * remaining argument values are substituted.
     * 
     * @return RsoString
     */
    public static function stringWithFormat()
    {
        return new RsoString(call_user_func_array('sprintf', func_get_args()));
    }

    /**
     * Returns a string created by copying the
     * characters from another given string.
     *
     * @param RsoString new string
     * 
     * @return RsoString
     */
    public static function stringWithString(RsoString $string)
    {
        return new RsoString($string);
    }

    /**
     * Returns a capitalized representation of
     * the receiver.
     * 
     * @return RsoString
     */
    public function capitalizedString()
    {
        $this->string = ucwords($this->string);
        return $this;
    }

    /**
     * Returns bool based on the outcome of the
     * case insensitive compare against a given
     * string.
     *
     * @param String string to compare
     * 
     * @return Bool
     */
    public function caseInsensitiveCompare($string)
    {
        return (strcasecmp($this->string, $string) == 0) ? true : false;
    }

    /**
     * Returns the character at a given array
     * position.
     *
     * @param Int index to find
     * 
     * @return RsoString
     */
    public function characterAtIndex($index)
    {
        $this->string = substr($this->string, $index, 1);
        return $this;
    }

    public function commonPrefixWithString($string)
    {

    }

    public function compare($string)
    {
        return (strcmp($this->string, $string) == 0) ? true : false;
    }    
}