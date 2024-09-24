<?php

namespace OptsLib;

use PHPUnit\Framework\TestCase;

class ParseTest extends TestCase
{
    /**
     * Testing parseArgument method when input is a string type, also testing different flag pattern
     */
    public function testParseArgumentWithStringInput()
    {
        $input = '--flag1=value1 -f value2 unmatched_string';
        $expected_result = [
            'flag1' => 'value1',
            'f' => 'value2',
            'unmatched_string' => true,
        ];

        $this->assertEquals($expected_result, Parse::parseArgument($input));
    }

    /**
     * Testing parseArgument method when input is an array type
     */
    public function testParseArgumentWithArrayInput()
    {
        // Array argument will be transformed into '--flag1 value1 "-"f" value2" unmatched_string' 
        $input = ['--flag1', 'value1', '-', 'f', 'value2', 'unmatched_string'];
        $expected_result = [
            'flag1' => 'value1',
            'unmatched_string' => true,
            'f' => true,
            'value2' => true
        ];

        $this->assertEquals($expected_result, Parse::parseArgument($input));
    }

    /**
     * Testing parseArgument method when input contains escaped quotes in a string argument
     */
    public function testParseArgumentWithEscapedQuotes()
    {
        $input = "--flag1=\"value1 with some \\\"escaped quotes\\\"\" -f 'value2 with some \\'escaped quotes\\'' unmatched_string";
        $expected_result = [
            'flag1' => 'value1 with some "escaped quotes"',
            'f' => 'value2 with some \'escaped quotes\'',
            'unmatched_string' => true,
        ];

        $this->assertEquals($expected_result, Parse::parseArgument($input));
    }

    /**
     * Testing parseArgument method only takes maximum number of arguments specified
     */
    public function testParseArgumentWithMaxArguments()
    {
        $input = '--flag1=value1 -f value2 unmatched_string1 unmatched_string2';
        $expected_result = [
            'flag1' => 'value1',
            'f' => 'value2',
            'unmatched_string1' => true
        ];  // It should only parse maximum 3 arguments

        $this->assertEquals($expected_result, Parse::parseArgument($input, 2));
    }
}