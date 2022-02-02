<?php

namespace Njuko\Validator;

use Aws\Ses\SesClient;
use Zend\Validator\AbstractValidator;
use Zend\Validator\EmailAddress;

class AwsEmailVerified extends EmailAddress {

    const NOT_VERIFIED = 'emailAdressNotVerified';

    protected $messageTemplates = array(
        self::NOT_VERIFIED => "__this_email_is_not_verified"
    );

    private $key;
    private $secret;
    private $region;

    public function __construct($options = array())
    {
        parent::__construct($options);

        $this->key = $options['key'];
        $this->secret = $options['secret'];
        $this->region = $options['region'];
    }

    public function isValid($value)
    {
        $email_validator = new \Zend\Validator\EmailAddress();
        $email_validator->setOptions(array(
            'useDomainCheck' => false
        ));

        if ($email_validator->isValid($value)) {
            /* @var $client \Aws\Ses\SesClient */
            $client = SesClient::factory(array(
                'key'    => $this->key,
                'secret' => $this->secret,
                'region' => $this->region
            ));

            $domain = $this->getDomainFromEmail($value);

            $verifiedDomains = $client->ListIdentities(array("IdentityType" =>  "Domain"));
            $verifiedDomains = $verifiedDomains->getAll()['Identities'];

            if (in_array($domain, $verifiedDomains)) {
                return true;
            }

            $result = $client->getIdentityVerificationAttributes(['Identities' => [$value]]);

            $arrayResult = $result->toArray();
            if(isset($arrayResult["VerificationAttributes"][$value]["VerificationStatus"])){
                if($arrayResult["VerificationAttributes"][$value]["VerificationStatus"] == "Success"){
                    return true;
                }
            }



        }
        $this->abstractOptions['messages']['EMAIL_NOT_VERIFIED']='__this_email_is_not_verified';
        return false;
    }


    private function getDomainFromEmail($email)
    {
        $domain = substr(strrchr($email, "@"), 1);
        return $domain;
    }


}