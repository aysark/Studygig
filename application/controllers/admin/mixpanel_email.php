<?php

/*
Mixpanel, Inc. -- http://mixpanel.com/
This library is used for adding tracking code to HTML email bodies.
*/

class MixpanelEmail
{
    private $endpoint = 'http://api.mixpanel.com/email';
    private $common_params = array();

    public function __construct(
        $token,
        $campaign,
        $type = 'html',
        $redirect_host = null,
        $shorten_urls = FALSE,
        $click_tracking = TRUE,
        $tracking_pixel = TRUE
    )
    {
        $this->common_params['token'] = $token;
        $this->common_params['campaign'] = $campaign;
        if ($type == 'text') {
            $this->common_params['type'] = 'text';
        }
        if ($redirect_host) {
            $this->common_params['redirect_host'] = $redirect_host;
        }
        if ($shorten_urls) {
            $this->common_params['shorten_urls'] = '1';
        }
        if (!$click_tracking) {
            $this->common_params['click_tracking'] = '0';
        }
        if (!$tracking_pixel) {
            $this->common_params['tracking_pixel'] = '0';
        }
    }

    public function add_tracking($distinct_id, $body)
    {
        $params = $this->common_params;
        $params['distinct_id'] = $distinct_id;
        $params['body'] = $body;
        $encoded = http_build_query($params);

        $ctx = stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'content' => $encoded
            )
        ));
        $fp = @fopen($this->endpoint, 'r', false, $ctx);
        if (!$fp) {
            throw new Exception("Error opening $this->endpoint: $php_errormsg");
        }
        $response = @stream_get_contents($fp);
        if ($response === false) {
            throw new Exception("Error reading $this->endpoint: $php_errormsg");
        }
        if (!@fclose($fp)) {
            throw new Exception("Error closing $this->endpoint: $php_errormsg");
        }
        return $response;
    }
}

/*
$api = new MixpanelEmail(
    '2150b708434b3dc7d28b6e2bb92fd003',
    'Craigslist/Kijiji Marketing'
);

$example = <<<END
<p>Hi User,</p>
<p>This is a sample email from <a href="http://example.com/">example.com</a>.</p>
<p>Each anchor link will be replaced with a tracking redirect when filtered with
<a href="http://mixpanel.com/">Mixpanel's</a> email tracking service.</p>
--<br>
Signature<br>
END;

$rewritten = $api->add_tracking('test_user@example.com', $example);
print($rewritten);
*/

?>