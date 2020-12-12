<?php

require '../init.php';

\Epayco\Epayco::setApiKey(\getenv('STRIPE_SECRET_KEY'));
\Epayco\Epayco::setClientId(\getenv('STRIPE_CLIENT_ID'));

if (isset($_GET['code'])) {
    // The user was redirected back from the OAuth form with an authorization code.
    $code = $_GET['code'];

    try {
        $resp = \Epayco\OAuth::token([
            'grant_type' => 'authorization_code',
            'code' => $code,
        ]);
    } catch (\Epayco\Exception\OAuth\OAuthErrorException $e) {
        exit('Error: ' . $e->getMessage());
    }

    $accountId = $resp->epayco_user_id;

    echo "<p>Success! Account <code>{$accountId}</code> is connected.</p>\n";
    echo "<p>Click <a href=\"?deauth={$accountId}\">here</a> to disconnect the account.</p>\n";
} elseif (isset($_GET['error'])) {
    // The user was redirect back from the OAuth form with an error.
    $error = $_GET['error'];
    $error_description = $_GET['error_description'];

    echo '<p>Error: code=' . \htmlspecialchars($error, \ENT_QUOTES) . ', description=' . \htmlspecialchars($error_description, \ENT_QUOTES) . "</p>\n";
    echo "<p>Click <a href=\"?\">here</a> to restart the OAuth flow.</p>\n";
} elseif (isset($_GET['deauth'])) {
    // Deauthorization request
    $accountId = $_GET['deauth'];

    try {
        \Epayco\OAuth::deauthorize([
            'epayco_user_id' => $accountId,
        ]);
    } catch (\Epayco\Exception\OAuth\OAuthErrorException $e) {
        exit('Error: ' . $e->getMessage());
    }

    echo '<p>Success! Account <code>' . \htmlspecialchars($accountId, \ENT_QUOTES) . "</code> is disconnected.</p>\n";
    echo "<p>Click <a href=\"?\">here</a> to restart the OAuth flow.</p>\n";
} else {
    $url = \Epayco\OAuth::authorizeUrl([
        'scope' => 'read_only',
    ]);
    echo "<a href=\"{$url}\">Connect with Epayco</a>\n";
}
