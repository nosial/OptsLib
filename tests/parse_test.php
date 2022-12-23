<?php

    require 'ncc';
    import('net.nosial.optslib', 'latest');

    $parse = \OptsLib\Parse::parseArgument('test --foo=bar --baz=qux --quux --corge --grault=garply --waldo --fred --plugh --xyzzy --thud');
    var_dump($parse);