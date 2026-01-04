<?PHP
        require 'ncc';

        if(!file_exists(__DIR__ . DIRECTORY_SEPARATOR . '../target/release/net.nosial.optslib.ncc'))
        {
            throw new Exception('Build output not found: ' . __DIR__ . DIRECTORY_SEPARATOR . '../target/release/net.nosial.optslib.ncc');
        }

        import(__DIR__ . DIRECTORY_SEPARATOR . '../target/release/net.nosial.optslib.ncc');