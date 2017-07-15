# mathtan

[![MIT License](http://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](LICENSE)

> OS detection by math.tan

[Try this page](https://orleika.io/mathtan)

## Table of Contents

- [Install](#install)
- [Usage](#usage)
- [Maintainers](#maintainers)
- [Contribute](#contribute)
- [License](#license)

## Install

This project uses bower, composer, Apache with PHP, and Mysql. Go check them out if you don't have them installed.

git clone and place apache document root.
```
$ git clone https://github.com/orleika/mathtan.git
$ cd mathtan
$ bower install
$ composer install
```
Configure Mysql connection information to .env
```
$ cp .env.sample .env
```


## Usage

If you want to only display the detected OS, use `js/detectOS.js`.

## Maintainers

[@orleika](https://github.com/orleika)

## Contribute

Please open [issues](https://github.com/orleika/mathtan/issues/new) or submit Pull requests to report bugs, features, or other problems.
Please note that this project is released with a Contributor Code of Conduct. By participating in this project you agree to abide by its terms.

## License

[MIT © 2017 orleika](LICENSE)
