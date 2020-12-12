<?php

require_once __DIR__ . '/EpaycoMock.php';

\define('MOCK_MINIMUM_VERSION', '0.89.0');

if (\Epayco\EpaycoMock::start()) {
    \register_shutdown_function('\Epayco\EpaycoMock::stop');

    \define('MOCK_HOST', 'localhost');
    \define('MOCK_PORT', \Epayco\EpaycoMock::getPort());
} else {
    \define('MOCK_HOST', \getenv('STRIPE_MOCK_HOST') ?: 'localhost');
    \define('MOCK_PORT', \getenv('STRIPE_MOCK_PORT') ?: 12111);
}

\define('MOCK_URL', 'http://' . MOCK_HOST . ':' . MOCK_PORT);

// Send a request to epayco-mock
$ch = \curl_init(MOCK_URL);
\curl_setopt($ch, \CURLOPT_HEADER, 1);
\curl_setopt($ch, \CURLOPT_NOBODY, 1);
\curl_setopt($ch, \CURLOPT_RETURNTRANSFER, 1);
$resp = \curl_exec($ch);

if (\curl_errno($ch)) {
    echo "Couldn't reach epayco-mock at `" . MOCK_HOST . ':' . MOCK_PORT . '`. Is ' .
         "it running? Please see README for setup instructions.\n";

    exit(1);
}

// Retrieve the Epayco-Mock-Version header
$version = null;
$headers = \explode("\n", $resp);
foreach ($headers as $header) {
    $pair = \explode(':', $header, 2);
    if ('Epayco-Mock-Version' === $pair[0]) {
        $version = \trim($pair[1]);
    }
}

if (null === $version) {
    echo 'Could not retrieve Epayco-Mock-Version header. Are you sure ' .
         'that the server at `' . MOCK_HOST . ':' . MOCK_PORT . '` is a epayco-mock ' .
         'instance?';

    exit(1);
}

if ('master' !== $version && -1 === \version_compare($version, MOCK_MINIMUM_VERSION)) {
    echo 'Your version of epayco-mock (' . $version . ') is too old. The minimum ' .
         'version to run this test suite is ' . MOCK_MINIMUM_VERSION . '. ' .
         "Please see its repository for upgrade instructions.\n";

    exit(1);
}

require_once __DIR__ . '/TestHelper.php';
