<?php

namespace Njuko\Aws\SES;

use Aws\Ses\SesClient;

class Service {

    private $key;
    private $secret;
    private $region;

    function __construct(array $options)
    {
        $this->key = $options['key'];
        $this->secret = $options['secret'];
        $this->region = $options['region'];
    }

    /**
     * @param $email
     */
    public function verifyEmail($email) {
        /* @var $client \Aws\Ses\SesClient */
        $client = SesClient::factory(array(
            'key'    => $this->key,
            'secret' => $this->secret,
            'region' => $this->region
        ));

        /** @var \Guzzle\Service\Resource\Model $emailVerificationReturn */
        $emailVerificationReturn = $client->verifyEmailIdentity(array("EmailAddress"  =>  $email));

        return true;
    }

}