 # iVendi Quoteware PHP API Client
[![Latest Version](https://img.shields.io/github/release/olsgreen/ivendi-quoteware-api.svg?style=flat-square)](https://github.com/olsgreen/sage-business-cloud-accounting-api/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

This package provides a means easily of interacting with the iVendi Quoteware API in PHP.

Visit iVendi's documentation site at: https://documentation.ivendi.com/docs/ before getting started.

## Installation

Add the client to your project using composer.

    composer require olsgreen/ivendi-quoteware-api

## Examples

### Performing a basic quote request

```php
    $ivendi = new \Olsgreen\IVendi\Quoteware\Client([
        'username' => 'www.ivendimotors.com',
        'quotee_uid' => '268E8202-338E-4B26-A6FE-74BCDAB0A357',
    ]);

    $response = $ivendi->quoteware()->request([
        'cashPrice' => 20000,
        'cashDeposit' => 2000,
        'annualDistance' => 10000,
        'term' => 48,
        'currentOdometerReading' => 12345,
        'identity' => 'FV10 XYB',
        'creditTier' => CreditTiers::EXCELLENT,
        'entityType' => EntityTypes::PERSONAL,
    ]);

    // {
    //     "hasQuoteResults": true,
    //     "QuotedResultsUID": "aeec6f6f-6d1c-4f1c-8380-e50e0b3554eb",
    //     "QuoteResults": [
    //        ...
    //     ]
    //     @see https://documentation.ivendi.com/docs/ExampleQuotewareResponse
    // }
```

# License

See attached license file

# Contributions

Pull requests welcome 🙂