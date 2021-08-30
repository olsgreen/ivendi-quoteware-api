<?php

namespace Olsgreen\IVendi\Quoteware\Api;

use Olsgreen\AbstractApi\AbstractEndpoint;
use Olsgreen\IVendi\Quoteware\Api\Builders\BasicQuotewareRequestBuilder;

class Quoteware extends AbstractEndpoint
{
    public function request($request)
    {
        if (!($request instanceof BasicQuotewareRequestBuilder)) {
            $request = new BasicQuotewareRequestBuilder($request);
        }

        if (method_exists($this->client, 'getUsername')) {
            $request->setUsername($this->client->getUsername());
        }

        if (method_exists($this->client, 'getQuoteeUid')) {
            $request->setQuoteeUid($this->client->getQuoteeUid());
        }

        $json = json_encode($request->toArray());

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Error encoding request body: '.json_last_error_msg());
        }

        return $this->_post('/quotes', [], $json, ['Content-Type' => 'application/json']);
    }
}
