# OptsLib

A very simple Options parser and command-line arguments
handling library for PHP.

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


## building

In order to use this library you need to install it
via `ncc`, this can be done using NCC's command-line
interface or mentioning this library in your `package.json`
file's dependencies, for instance:

```json
{
  "name": "net.nosial.optslib",
  "version": "1.0.0",
  "source_type": "remote",
  "source": "nosial/libs.opts=1.0.0@n64"
}
```

If you don't have N64's repository added to your NCC
configuration, you can add it using the following command:

```bash
$ sudo ncc source add --name n64 --type gitlab --host git.n64.cc
```


Building is done using [NCC](https://git.n64.cc/nosial/ncc), 
you can build it using the following command:

```bash
$ git clone https://git.n64.cc/nosial/libs/optslib.git
$ cd optlibs

$ ncc build --config release
# or
$ make release
```

### installing

Once you have built the library, you can install it using 
the following command:

```bash
$ sudo ncc install -p="build/release/net.nosial.optslib.ncc"
# or
$ sudo make install
```

## License

This library is licensed under the MIT license, see the LICENSE file
for more information.

## Contributing

If you want to contribute to this project, you can do so by
creating a merge request on the [GitLab repository](https://git.n64.cc/nosial/libs/optslib).

## Contact

If you have any questions, you can contact us on [Telegram](https://t.me/NosialDiscussions).