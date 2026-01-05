<?PHP
        require 'ncc';

        $buildOutputPath = __DIR__ . DIRECTORY_SEPARATOR . '../target/release/net.nosial.optslib.ncc';
        if(getenv('NCC_BUILD_OUTPUT_PATH'))
        {
            $buildOutputPath = getenv('NCC_BUILD_OUTPUT_PATH');
        }

        if(!file_exists($buildOutputPath))
        {
            throw new Exception('Build output not found: ' . $buildOutputPath);
        }

        import(__DIR__ . DIRECTORY_SEPARATOR . '../target/release/net.nosial.optslib.ncc');