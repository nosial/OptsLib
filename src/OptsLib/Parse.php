<?php

    namespace OptsLib;

    class Parse
    {
        private static $Regex = "/(?(?=-)-(?(?=-)-(?'bigflag'[^\\s=]+)|(?'smallflag'\\S))(?:\\s*=\\s*|\\s+)(?(?!-)(?(?=[\\\"\\'])((?<![\\\\])['\"])(?'string'(?:.(?!(?<![\\\\])\\3))*.?)\\3|(?'value'\\S+)))(?:\\s+)?|(?'unmatched'\\S+))/";

        /**
         * @var array
         */
        private static $ArgsCache;

        /**
         * Parses the input arguments into an array of flags and values
         *
         * @param $input
         * @param int $max_arguments
         * @return array
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
            preg_match_all(self::$Regex, $flags, $matches, PREG_SET_ORDER);

            foreach ($matches as $index => $match)
            {
                if (isset($match['value']) && $match['value'] !== '')
                {
                    $value = $match['value'];
                }
                else if (isset($match['string']) && $match['string'] !== '')
                {
                    // fix escaped quotes
                    $value = str_replace("\\\"", "\"", $match['string']);
                    $value = str_replace("\\'", "'", $value);
                }
                else
                {
                    $value = true;
                }

                if (isset($match['bigflag']) && $match['bigflag'] !== '')
                {
                    $configs[$match['bigflag']] = $value;
                }

                if (isset($match['smallflag']) && $match['smallflag'] !== '')
                {
                    $configs[$match['smallflag']] = $value;
                }

                if (isset($match['unmatched']) && $match['unmatched'] !== '')
                {
                    $configs[$match['unmatched']] = true;
                }

                if ($index >= $max_arguments)
                    break;
            }

            return $configs;
        }

        /**
         * Returns the arguments from the command line
         *
         * @return array
         */
        public static function getArguments(): array
        {
            if(self::$ArgsCache == null)
            {
                if(isset($argv))
                {
                    self::$ArgsCache = self::parseArgument($argv);
                }
                else
                {
                    self::$ArgsCache = [];
                }
            }

            return self::$ArgsCache;
        }
    }