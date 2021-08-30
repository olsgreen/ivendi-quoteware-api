<?php

namespace Olsgreen\IVendi\Quoteware;

use Olsgreen\IVendi\Quoteware\Api\HasCredentials;
use Olsgreen\IVendi\Quoteware\Api\Quoteware;

class Client extends \Olsgreen\AbstractApi\AbstractClient
{
    use HasCredentials;

    /**
     * Set this clients options from array.
     *
     * @param array $options
     */
    protected function configureFromArray(array $options): Client
    {
        $baseUri = 'https://quoteware3.ivendi.com';

        $this->http->setBaseUri($baseUri);

        if (!empty($options['username'])) {
            $this->setUsername($options['username']);
        }

        if (!empty($options['quotee_uid'])) {
            $this->setQuoteeUid($options['quotee_uid']);
        }

        return $this;
    }

    public function quoteware(): Quoteware
    {
        return new Quoteware($this);
    }
}