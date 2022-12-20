# OptsLib

A very simple Options parser and command-line arguments
handling library for PHP.

## Installation

The library can be installed using ncc:

```bash
ncc install -p "nosial/libs.opts=latest@n64"
```

or by adding the following to your project.json file under
the `build.dependencies` section:

```json
{
  "name": "net.nosial.optslib",
  "version": "latest",
  "source_type": "remote",
  "source": "nosial/libs.opts=latest@n64"
}
```

If you don't have the n64 source configured you can add it
by running the following command:

```bash
ncc source add --name n64 --type gitlab --host git.n64.cc
```

## Usage

The usage of this library is very simple, there are
two functions that you can use to parse options.

### parseArgument()

Can be used to parse a single argument string/array, this is useful for
parsing command line arguments. The second argument is the maximum number
of arguments that can be parsed, this is to prevent infinite loops.

```php
<?php

    require_once('ncc');
    import('net.nosial.optslib', 'latest');
    
    $input = '--foo --bar="test" -y --username test';
    $parsed = \OptsLib\Parse::parseArgument($input);
    
    echo $parsed['foo']; // true
    echo $parsed['bar']; // "test"
    echo $parsed['y']; // true
    echo $parsed['username']; // "test"
```

### getArguments()

This method is used to access the `$argv` array
if it's not set, an empty array is returned.

```php
<?php

    require_once('ncc');
    import('net.nosial.optslib', 'latest');
    
    $arguments = \OptsLib\Parse::getArguments();
    
    echo $arguments['output-file']; // "test.txt"
    echo $arguments['input-file']; // "test.txt"
    echo $arguments['log']; // "verbose"
```

## License

This library is licensed under the MIT license, see the LICENSE file
for more information.

## Contributing

If you want to contribute to this project, you can do so by
creating a merge request on the [GitLab repository](https://git.n64.cc/nosial/libs/optslib).

## Contact

If you have any questions, you can contact us on [Telegram](https://t.me/NosialDiscussions).