# advanced-form-helper
[![Total Downloads](https://poser.pugx.org/mediadevs/response-handler/downloads)](https://packagist.org/packages/mediadevs/response-handler)
[![Latest Unstable Version](https://poser.pugx.org/mediadevs/response-handler/v/unstable)](https://packagist.org/packages/mediadevs/response-handler)
[![Latest Stable Version](https://poser.pugx.org/mediadevs/response-handler/v/stable)](https://packagist.org/packages/mediadevs/response-handler)
[![Version](https://img.shields.io/packagist/v/mediadevs/response-handler.svg)](https://packagist.org/packages/mediadevs/response-handler)
[![Software License][ico-license]](LICENSE.md)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/mediadevs/response-handler/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Build Status](https://scrutinizer-ci.com/g/Mediadevs/response-handler/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Mediadevs/response-handler/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/mediadevs/response-handler/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/mediadevs/response-handler/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mediadevs/response-handler/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mediadevs/response-handler/?branch=master)
[![Minimum PHP Version](https://img.shields.io/badge/php-_%5E7.1-8892BF.svg)](https://github.com/symfony/symfony)

## Be aware!
Not everything has been tested yet, use on own risk.

## Install

Via Composer

``` bash
$ composer require mediadevs/response-handler
```

Via GIT
``` bash
HTTPS:
git clone https://github.com/mediadevs/response-handler.git

SSH:
git clone git@github.com:mediadevs/response-handler.git
```

## Usage
###### Basic message
```php
<?php
use mikevandiepen\utility\Response;

// Instantiating the Response class
$response = new Response();

// Adding messages and returning a json response
$response->add('Action executed successfully')->toJSON();
?>
```
###### Response
```json
[
	{"level":"primary","message":"Action executed successfully"}
]
```



###### Single message
```php
<?php
use mikevandiepen\utility\Response;

// Instantiating the Response class
$response = new Response();

// Adding messages
$response->add('Action executed successfully', [ /** There must be an array, but can be left empty*/ ], Response::SUCCESS);

// Returning the message in json response
$response->toJSON();
?>
```
###### Response
```json
[
	{"level":"success","message":"Action executed successfully"}
]
```



###### Multiple parameters
```php
<?php
use mikevandiepen\utility\Response;

// Instantiating the Response class
$response = new Response();

// Adding messages
$response->add('{%action%} executed {%status%}', ['action' => 'My Custom Action', 'status' => 'successfully'], Response::SUCCESS);

// Returning the message in json response
$response->toJSON();
?>
```
###### Response
```json
[
	{"level":"success","message":"My Custom Action executed successfully"}
]
```



###### Multiple messages with parameters
```php
<?php
use mikevandiepen\utility\Response;

// Instantiating the Response class
$response = new Response();

// Adding messages
$response->add('{%action%} executed successfully', ['action' => 'your_action'], Response::SUCCESS);
$response->add('DUPLICATE {%action%}!', ['action' => 'your_action_2'], Response::WARNING);
$response->add('DUPLICATE {%action%}!', ['action' => 'your_action_3'], Response::WARNING);
$response->add('{%action%} does not exist', ['action' => 'your_action_4'], Response::ERROR);

// Returning the messages in json response
$response->toJSON();
?>
```
###### Response
```json
[
	{"level":"success","message":"your_action executed successfully"},
	{"level":"warning","message":"DUPLICATE your_action_2!"},
	{"level":"warning","message":"DUPLICATE your_action_3!"},
	{"level":"danger","message":"your_action_4 does not exist"}
]
```

###### Highlight parameters
```php
<?php
use mikevandiepen\utility\Response;

// Instantiating the Response class
$response = new Response();

// Adding messages
$response->add('Look how cool this is! {%parameter%}', ['parameter' => 'Highlight me!'], Response::SUCCESS)->delimiters('"');

// Returning the message in json response
$response->toJSON();
?>
```
###### Response
```json
[
	{"level":"success","message":"Look how cool this is! \"Highlight me!\""}
]
```

In this case we used only one encapsulation string which were applied to both sides.
If in your case you want different characters on either side you can add a second item to the array.

For example:
```php
<?php
use mikevandiepen\utility\Response;

// Instantiating the Response class
$response = new Response();

// Adding messages
$response->add('Look how cool this is! {%parameter%}', ['parameter' => 'Highlight me!'], Response::SUCCESS)->delimiters('<strong>', '</strong>');

// Returning the message in json response
$response->toJSON();
?>
```
###### Response
```json
[
	{"level":"success","message":"Look how cool this is! <strong>Highlight me!</strong>"}
]
```

###### Return responses as an array
```php
<?php
use mikevandiepen\utility\Response;

// Instantiating the Response class
$response = new Response();

// Adding messages
$response->add('Look how cool this is! {%parameter%}', ['parameter' => 'Highlight me!'], Response::SUCCESS)->delimiters('"');

// Returning the message in json response
$response->toArray();
?>
```
###### Response
```php
array(
    "level"     => "success",
    "message"   => "Look how cool this is! \"Highlight me!\""
);
```
``` 

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email contact@mediadevs.nl instead of using the issue tracker.

## Credits

- [Mike van Diepen](https://github.com/mikevandiepen)
- [All Contributors]()

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/mediadevs/response-handler.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/mediadevs/response-handler/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/mediadevs/response-handler.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/mediadevs/response-handler.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/mediadevs/response-handler.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/mediadevs/response-handler
[link-travis]: https://travis-ci.org/mediadevs/response-handler
[link-scrutinizer]: https://scrutinizer-ci.com/g/mediadevs/response-handler/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/mediadevs/response-handler
[link-downloads]: https://packagist.org/packages/mediadevs/response-handler
[link-author]: https://github.com/mikevandiepen
[link-contributors]: ../../contributors
