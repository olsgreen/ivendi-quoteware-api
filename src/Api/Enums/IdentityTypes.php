<?php

namespace Olsgreen\IVendi\Quoteware\Api\Enums;

use Olsgreen\AbstractApi\Enums\AbstractEnum;

class IdentityTypes extends AbstractEnum
{
    const DEFAULT = 'Default';

    const VRM = 'VRM';

    const VIN = 'VIN';

    const RVC = 'RVC';
}