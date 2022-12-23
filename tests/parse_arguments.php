<?php

    require 'ncc';
    import('net.nosial.optslib', 'latest');

    $parse = \OptsLib\Parse::getArguments();
    var_dump($parse);