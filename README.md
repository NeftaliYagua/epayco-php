# Epayco PHP bindings

[![Build Status](https://travis-ci.org/epayco/epayco-php.svg?branch=master)](https://travis-ci.org/epayco/epayco-php)
[![Latest Stable Version](https://poser.pugx.org/epayco/epayco-php/v/stable.svg)](https://packagist.org/packages/epayco/epayco-php)
[![Total Downloads](https://poser.pugx.org/epayco/epayco-php/downloads.svg)](https://packagist.org/packages/epayco/epayco-php)
[![License](https://poser.pugx.org/epayco/epayco-php/license.svg)](https://packagist.org/packages/epayco/epayco-php)
[![Code Coverage](https://coveralls.io/repos/epayco/epayco-php/badge.svg?branch=master)](https://coveralls.io/r/epayco/epayco-php?branch=master)

The Epayco PHP library provides convenient access to the Epayco API from
applications written in the PHP language. It includes a pre-defined set of
classes for API resources that initialize themselves dynamically from API
responses which makes it compatible with a wide range of versions of the Epayco
API.

## Requirements

PHP 5.6.0 and later.

## Composer

You can install the bindings via [Composer](http://getcomposer.org/). Run the following command:

```bash
composer require epayco/epayco-php
```

To use the bindings, use Composer's [autoload](https://getcomposer.org/doc/01-basic-usage.md#autoloading):

```php
require_once('vendor/autoload.php');
```

## Manual Installation

If you do not wish to use Composer, you can download the [latest release](https://github.com/epayco/epayco-php/releases). Then, to use the bindings, include the `init.php` file.

```php
require_once('/path/to/epayco-php/init.php');
```

## Dependencies

The bindings require the following extensions in order to work properly:

-   [`curl`](https://secure.php.net/manual/en/book.curl.php), although you can use your own non-cURL client if you prefer
-   [`json`](https://secure.php.net/manual/en/book.json.php)
-   [`mbstring`](https://secure.php.net/manual/en/book.mbstring.php) (Multibyte String)

If you use Composer, these dependencies should be handled automatically. If you install manually, you'll want to make sure that these extensions are available.

## Getting Started

Simple usage looks like:

```php
$epayco = new \Epayco\EpaycoClient('sk_test_BQokikJOvBiI2HlWgH4olfQ2');
$customer = $epayco->customers->create([
    'description' => 'example customer',
    'email' => 'email@example.com',
    'payment_method' => 'pm_card_visa',
]);
echo $customer;
```

### Client/service patterns vs legacy patterns

You can continue to use the legacy integration patterns used prior to version [7.33.0](https://github.com/epayco/epayco-php/blob/master/CHANGELOG.md#7330---2020-05-14). Review the [migration guide](https://github.com/epayco/epayco-php/wiki/Migration-to-EpaycoClient-and-services-in-7.33.0) for the backwards-compatible client/services pattern changes.

## Documentation

See the [PHP API docs](https://stripe.com/docs/api/php#intro).

## Legacy Version Support

### PHP 5.4 & 5.5

If you are using PHP 5.4 or 5.5, you can download v6.21.1 ([zip](https://github.com/epayco/epayco-php/archive/v6.21.1.zip), [tar.gz](https://github.com/epayco/epayco-php/archive/v6.21.1.tar.gz)) from our [releases page](https://github.com/epayco/epayco-php/releases). This version will continue to work with new versions of the Epayco API for all common uses.

### PHP 5.3

If you are using PHP 5.3, you can download v5.9.2 ([zip](https://github.com/epayco/epayco-php/archive/v5.9.2.zip), [tar.gz](https://github.com/epayco/epayco-php/archive/v5.9.2.tar.gz)) from our [releases page](https://github.com/epayco/epayco-php/releases). This version will continue to work with new versions of the Epayco API for all common uses.

## Custom Request Timeouts

_NOTE:_ We do not recommend decreasing the timeout for non-read-only calls (e.g. charge creation), since even if you locally timeout, the request on Epayco's side can still complete. If you are decreasing timeouts on these calls, make sure to use [idempotency tokens](https://stripe.com/docs/api/php#idempotent_requests) to avoid executing the same transaction twice as a result of timeout retry logic.

To modify request timeouts (connect or total, in seconds) you'll need to tell the API client to use a CurlClient other than its default. You'll set the timeouts in that CurlClient.

```php
// set up your tweaked Curl client
$curl = new \Epayco\HttpClient\CurlClient();
$curl->setTimeout(10); // default is \Epayco\HttpClient\CurlClient::DEFAULT_TIMEOUT
$curl->setConnectTimeout(5); // default is \Epayco\HttpClient\CurlClient::DEFAULT_CONNECT_TIMEOUT

echo $curl->getTimeout(); // 10
echo $curl->getConnectTimeout(); // 5

// tell Epayco to use the tweaked client
\Epayco\ApiRequestor::setHttpClient($curl);

// use the Epayco API client as you normally would
```

## Custom cURL Options (e.g. proxies)

Need to set a proxy for your requests? Pass in the requisite `CURLOPT_*` array to the CurlClient constructor, using the same syntax as `curl_stopt_array()`. This will set the default cURL options for each HTTP request made by the SDK, though many more common options (e.g. timeouts; see above on how to set those) will be overridden by the client even if set here.

```php
// set up your tweaked Curl client
$curl = new \Epayco\HttpClient\CurlClient([CURLOPT_PROXY => 'proxy.local:80']);
// tell Epayco to use the tweaked client
\Epayco\ApiRequestor::setHttpClient($curl);
```

Alternately, a callable can be passed to the CurlClient constructor that returns the above array based on request inputs. See `testDefaultOptions()` in `tests/CurlClientTest.php` for an example of this behavior. Note that the callable is called at the beginning of every API request, before the request is sent.

### Configuring a Logger

The library does minimal logging, but it can be configured
with a [`PSR-3` compatible logger][psr3] so that messages
end up there instead of `error_log`:

```php
\Epayco\Epayco::setLogger($logger);
```

### Accessing response data

You can access the data from the last API response on any object via `getLastResponse()`.

```php
$customer = $epayco->customers->create([
    'description' => 'example customer',
]);
echo $customer->getLastResponse()->headers['Request-Id'];
```

### SSL / TLS compatibility issues

Epayco's API now requires that [all connections use TLS 1.2](https://stripe.com/blog/upgrading-tls). Some systems (most notably some older CentOS and RHEL versions) are capable of using TLS 1.2 but will use TLS 1.0 or 1.1 by default. In this case, you'd get an `invalid_request_error` with the following error message: "Epayco no longer supports API requests made with TLS 1.0. Please initiate HTTPS connections with TLS 1.2 or later. You can learn more about this at [https://stripe.com/blog/upgrading-tls](https://stripe.com/blog/upgrading-tls).".

The recommended course of action is to [upgrade your cURL and OpenSSL packages](https://support.stripe.com/questions/how-do-i-upgrade-my-epayco-integration-from-tls-1-0-to-tls-1-2#php) so that TLS 1.2 is used by default, but if that is not possible, you might be able to solve the issue by setting the `CURLOPT_SSLVERSION` option to either `CURL_SSLVERSION_TLSv1` or `CURL_SSLVERSION_TLSv1_2`:

```php
$curl = new \Epayco\HttpClient\CurlClient([CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1]);
\Epayco\ApiRequestor::setHttpClient($curl);
```

### Per-request Configuration

For apps that need to use multiple keys during the lifetime of a process, like
one that uses [Epayco Connect][connect], it's also possible to set a
per-request key and/or account:

```php
$customers = $epayco->customers->all([],[
    'api_key' => 'sk_test_...',
    'epayco_account' => 'acct_...'
]);

$epayco->customers->retrieve('cus_123456789', [], [
    'api_key' => 'sk_test_...',
    'epayco_account' => 'acct_...'
]);
```

### Configuring CA Bundles

By default, the library will use its own internal bundle of known CA
certificates, but it's possible to configure your own:

```php
\Epayco\Epayco::setCABundlePath("path/to/ca/bundle");
```

### Configuring Automatic Retries

The library can be configured to automatically retry requests that fail due to
an intermittent network problem:

```php
\Epayco\Epayco::setMaxNetworkRetries(2);
```

[Idempotency keys][idempotency-keys] are added to requests to guarantee that
retries are safe.

### Request latency telemetry

By default, the library sends request latency telemetry to Epayco. These
numbers help Epayco improve the overall latency of its API for all users.

You can disable this behavior if you prefer:

```php
\Epayco\Epayco::setEnableTelemetry(false);
```

## Development

Get [Composer][composer]. For example, on Mac OS:

```bash
brew install composer
```

Install dependencies:

```bash
composer install
```

The test suite depends on [epayco-mock], so make sure to fetch and run it from a
background terminal ([epayco-mock's README][epayco-mock] also contains
instructions for installing via Homebrew and other methods):

```bash
go get -u github.com/epayco/epayco-mock
epayco-mock
```

Install dependencies as mentioned above (which will resolve [PHPUnit](http://packagist.org/packages/phpunit/phpunit)), then you can run the test suite:

```bash
./vendor/bin/phpunit
```

Or to run an individual test file:

```bash
./vendor/bin/phpunit tests/UtilTest.php
```

Update bundled CA certificates from the [Mozilla cURL release][curl]:

```bash
./update_certs.php
```

The library uses [PHP CS Fixer][php-cs-fixer] for code formatting. Code must be formatted before PRs are submitted, otherwise CI will fail. Run the formatter with:

```bash
./vendor/bin/php-cs-fixer fix -v .
```

## Attention plugin developers

Are you writing a plugin that integrates Epayco and embeds our library? Then please use the `setAppInfo` function to identify your plugin. For example:

```php
\Epayco\Epayco::setAppInfo("MyAwesomePlugin", "1.2.34", "https://myawesomeplugin.info");
```

The method should be called once, before any request is sent to the API. The second and third parameters are optional.

### SSL / TLS configuration option

See the "SSL / TLS compatibility issues" paragraph above for full context. If you want to ensure that your plugin can be used on all systems, you should add a configuration option to let your users choose between different values for `CURLOPT_SSLVERSION`: none (default), `CURL_SSLVERSION_TLSv1` and `CURL_SSLVERSION_TLSv1_2`.

[composer]: https://getcomposer.org/
[connect]: https://stripe.com/connect
[curl]: http://curl.haxx.se/docs/caextract.html
[idempotency-keys]: https://stripe.com/docs/api/php#idempotent_requests
[php-cs-fixer]: https://github.com/FriendsOfPHP/PHP-CS-Fixer
[psr3]: http://www.php-fig.org/psr/psr-3/
[epayco-mock]: https://github.com/epayco/epayco-mock
