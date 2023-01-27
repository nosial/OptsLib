# ![OptsLib](assets/optslib-32px.png) OptsLib

A very simple Options parser and command-line arguments
handling library for PHP.

## Table of Contents

<!-- TOC -->
* [![OptsLib](assets/optslib-32px.png) OptsLib](#-optslib)
  * [Table of Contents](#table-of-contents)
  * [Installation](#installation)
  * [Compiling from source](#compiling-from-source)
  * [Usage](#usage)
    * [parseArgument()](#parseargument--)
    * [getArguments()](#getarguments--)
  * [Additional functionality](#additional-functionality)
    * [getRegex()](#getregex--)
    * [setRegex()](#setregex--)
    * [getArgsCache()](#getargscache--)
  * [Changelog](#changelog)
  * [License](#license)
  * [Logo](#logo)
  * [Contributing](#contributing)
<!-- TOC -->

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

## Compiling from source

The library can be compiled from source using ncc:

```bash
ncc build --config release
```

or by running the following command:

```bash
make release
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

Optionally, if you want arguments after a specific argument/option
to be parsed, you can pass the argument name as the first argument.

This is ideal if you are using a command line tool that has
a sub-command, for example:

```bash
$ mytool subcommand --foo --bar="test" -y --username test
```

In this case, you can pass the `subcommand` argument to the
`getArguments()` method to parse the arguments after it.

```php
<?php

    require_once('ncc');
    import('net.nosial.optslib', 'latest');
    
    $arguments = \OptsLib\Parse::getArguments('subcommand');
    
    echo $arguments['foo']; // true
    echo $arguments['bar']; // "test"
    echo $arguments['y']; // true
    echo $arguments['username']; // "test"
```

## Additional functionality

OptsLib also provides some additional functionality that
can be used to modify the way arguments are parsed.

### getRegex()

This method is used to return the regex pattern used to parse
the arguments, it can be used to parse arguments manually.

The default used is

```regexp
/(?(?=-)-(?(?=-)-(?'bigflag'[^\\s=]+)|(?'smallflag'\\S))(?:\\s*=\\s*|\\s+)(?(?!-)(?(?=[\\\"\\'])((?<![\\\\])['\"])(?'string'(?:.(?!(?<![\\\\])\\3))*.?)\\3|(?'value'\\S+)))(?:\\s+)?|(?'unmatched'\\S+))/
```

### setRegex()

This method is used to set the regex pattern used to parse
the arguments, you can modify the default pattern to suit your needs.

```php
<?php

    require_once('ncc');
    import('net.nosial.optslib', 'latest');
    
    \OptsLib\Parse::setRegex('/(?(?=-)-(?(?=-)-(?'bigflag'[^\\s=]+)|(?'smallflag'\\S))(?:\\s*=\\s*|\\s+)(?(?!-)(?(?=[\\\"\\'])((?<![\\\\])['\"])(?'string'(?:.(?!(?<![\\\\])\\3))*.?)\\3|(?'value'\\S+)))(?:\\s+)?|(?'unmatched'\\S+))/');
```


### getArgsCache()

This method is used to return the arguments cache parsed from the global
`$argv` variable, this can be used as a means of troubleshooting.


## Changelog

For a list of changes, see the [CHANGELOG.md](CHANGELOG.md) file.


## License

This library is licensed under the MIT license, see the LICENSE file
for more information.


## Logo

The logo was created by [Boxicons](https://boxicons.com/) and is licensed
under the [MIT license](assets/LICENSE)

## Contributing

If you want to contribute to this project, you can do so by
creating a merge request on the [GitLab repository](https://git.n64.cc/nosial/libs/optslib).