<?php

namespace Olsgreen\IVendi\Quoteware\Api\Enums;

use Olsgreen\AbstractApi\Enums\AbstractEnum;

class CreditTiers extends AbstractEnum
{
    const DEFAULT = '';

    const NONE = 'None';

    const BELOW_AVERAGE = 'Tier5';

    const FAIR = 'Tier4';

    const GOOD = 'Tier3';

    const VERY_GOOD = 'Tier2';

    const EXCELLENT = 'Tier1';
}