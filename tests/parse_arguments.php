<?php

    require 'ncc';
    import('net.nosial.optslib', 'latest');

    $parse = \OptsLib\Parse::getArguments();
    var_dump($parse);

    $parse = \OptsLib\Parse::getArguments('exec');
    var_dump($parse);