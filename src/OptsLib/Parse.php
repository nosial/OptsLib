<?php

    /**
     * Copyright (c) 2022-2023 Nosial - All Rights Reserved.
     *
     * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
     * documentation files (the "Software"), to deal in the Software without restriction, including without limitation the
     * rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to
     * permit persons to whom the Software is furnished to do so, subject to the following conditions:
     *
     * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the
     * Software.
     *
     * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
     * WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NON-INFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
     * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
     * OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
     */

    namespace OptsLib;

    class Parse
    {
        /**
         * The regex pattern to match options and arguments.
         *
         * @var string
         */
        private static $regex = "/(?(?=-)-(?(?=-)-(?'bigflag'[^\\s=]+)|(?'smallflag'\\S))(?:\\s*=\\s*|\\s+)(?(?!-)(?(?=[\\\"\\'])((?<![\\\\])['\"])(?'string'(?:.(?!(?<![\\\\])\\3))*.?)\\3|(?'value'\\S+)))(?:\\s+)?|(?'unmatched'\\S+))/";

        /**
         * Cache of the parsed arguments. This is used to prevent the arguments from being parsed more than once.
         *
         * @var array
         */
        private static $args_cache;

        /**
         * Parses the input arguments into an array of flags and values
         *
         * @param string|array $input array The input arguments
         * @param int $max_arguments The maximum number of arguments to parse
         * @return array The parsed arguments
         */
        public static function parseArgument($input, int $max_arguments=1000): array
        {
            if (is_string($input))
            {
                $flags = $input;
            }
            elseif(is_array($input))
            {
                $flags = implode(' ', $input);
            }
            else
            {
                global $argv;
                if(isset($argv) && count($argv) > 1)
                {
                    array_shift($argv);
                }
                $flags = implode(' ',  $argv);
            }

            $configs = array();
            preg_match_all(self::$regex, $flags, $matches, PREG_SET_ORDER);

            foreach ($matches as $index => $match)
            {
                if(isset($match['value']) && $match['value'] !== '')
                {
                    $value = $match['value'];
                }
                elseif(isset($match['string']) && $match['string'] !== '')
                {
                    // fix escaped quotes
                    $value = str_replace(["\\\"", "\\'"], ["\"", "'"], $match['string']);
                }
                else
                {
                    $value = true;
                }

                if(isset($match['bigflag']) && $match['bigflag'] !== '')
                {
                    $configs[$match['bigflag']] = $value;
                }

                if(isset($match['smallflag']) && $match['smallflag'] !== '')
                {
                    $configs[$match['smallflag']] = $value;
                }

                if(isset($match['unmatched']) && $match['unmatched'] !== '')
                {
                    $configs[$match['unmatched']] = true;
                }

                if($index >= ($max_arguments + 1))
                {
                    break;
                }
            }

            return $configs;
        }

        /**
         * Returns the arguments from the command line
         *
         * @param string|null $after Returns the arguments after the specified flag/argument
         * @return array Returns the arguments from the command line
         */
        public static function getArguments(?string $after=null): array
        {
            global $argv;

            if($argv === null)
            {
                $argv = $_SERVER['argv'];
            }

            if(self::$args_cache === null)
            {
                if(isset($argv))
                {
                    self::$args_cache = self::parseArgument($argv);
                }
                else
                {
                    self::$args_cache = [];
                }
            }

            if($after === null)
            {
                return self::$args_cache;
            }

            $after_index = array_search($after, array_keys(self::$args_cache), true);

            if($after_index === false)
            {
                return [];
            }

            return array_slice(self::$args_cache, $after_index + 1);
        }

        /**
         * Gets the current regex pattern used to parse the arguments.
         *
         * @return string
         */
        public static function getRegex(): string
        {
            return self::$regex;
        }

        /**
         * Sets a new regex pattern to use to parse the arguments.
         *
         * @param string $regex
         */
        public static function setRegex(string $regex): void
        {
            self::$regex = $regex;
        }
    }