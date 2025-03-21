# OptsLib

A basic Options parser and command-line arguments handling a library for PHP.

## Community

This project and many others from Nosial are available on multiple publicly available and free git repositories at

- [n64](https://git.n64.cc/nosial/optslib)
- [GitHub](https://github.com/nosial/optslib)
- [Codeberg](https://codeberg.org/nosial/optslib)

Issues & Pull Requests are frequently checked and to be referenced accordingly in commits and changes, Nosial remains
dedicated to keep these repositories up to date when possible.

For questions & discussions see the public Telegram community at [@NosialDiscussions](https://t.me/NosialDiscussions).
We do encourage community support and discussions, please be respectful and follow the rules of the community.

## Table of Contents

<!-- TOC -->
* [OptsLib](#optslib)
  * [Community](#community)
  * [Table of Contents](#table-of-contents)
  * [Installation](#installation)
  * [Compiling from source](#compiling-from-source)
  * [Testing](#testing)
  * [Usage](#usage)
    * [parseArgument()](#parseargument)
    * [getArguments()](#getarguments)
  * [Additional functionality](#additional-functionality)
    * [getRegex()](#getregex)
    * [setRegex()](#setregex)
  * [Changelog](#changelog)
  * [License](#license)
  * [Logo](#logo)
  * [Contributing](#contributing)
<!-- TOC -->

## Installation

The library can be installed using ncc:

```bash
# n64
ncc package install -p "nosial/libs.opts=latest@n64"

# github
ncc package install -p "nosial/libs.opts=latest@github"
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
ncc repository add --name n64 --type gitlab --host git.n64.cc
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

## Testing

The library can be tested using PhpUnit with the `phpunit.xml` file that is already included in the repository.
This requires that you have PhpUnit installed & the library has been compiled and installed on the local system.

```bash
phpunit
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