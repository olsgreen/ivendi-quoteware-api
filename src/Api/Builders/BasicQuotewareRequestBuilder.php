<?php

namespace Olsgreen\IVendi\Quoteware\Api\Builders;

use Olsgreen\AbstractApi\Builders\ValidationException;
use Olsgreen\IVendi\Quoteware\Api\Enums\CreditTiers;
use Olsgreen\IVendi\Quoteware\Api\Enums\EntityTypes;
use Olsgreen\IVendi\Quoteware\Api\Enums\IdentityTypes;
use Olsgreen\IVendi\Quoteware\Api\Enums\TermUnits;
use Olsgreen\IVendi\Quoteware\Api\Enums\VehicleClass;
use Olsgreen\IVendi\Quoteware\Api\Enums\VehicleConditions;
use Olsgreen\IVendi\Quoteware\Api\HasCredentials;

class BasicQuotewareRequestBuilder extends \Olsgreen\AbstractApi\Builders\AbstractBuilder
{
    use HasCredentials;

    /**
     * Risk Based Pricing (RBP) Tier.
     *
     * @var string|int
     *
     * @see \Olsgreen\IVendi\Quoteware\Api\Enums\CreditTiers
     */
    protected $creditTier = CreditTiers::EXCELLENT;

    /**
     * Selling price of asset.
     *
     * @var float
     */
    protected $cashPrice;

    /**
     * Customer contribution to offset against CashPrice.
     *
     * @var float
     */
    protected $cashDeposit = 0;

    /**
     * Annual Distance Required for PCP quoting.
     *
     * @var int
     */
    protected $annualDistance;

    /**
     * Period the quotation should be calculated over.
     *
     * @var int
     */
    protected $term;

    /**
     * Unit of the term period.
     *
     * @var string
     *
     * @see \Olsgreen\IVendi\Quoteware\Api\Enums\TermUnits
     */
    protected $termUnits = TermUnits::MONTHS;

    /**
     * The entity type requesting a quote.
     *
     * @var string
     *
     * @see \Olsgreen\IVendi\Quoteware\Api\Enums\EntityTypes
     */
    protected $entityType = EntityTypes::PERSONAL;

    /**
     * Vehicle registration mark if known.
     *
     * @var string
     */
    protected $registrationMark;

    /**
     * Date vehicle is registered with DVLA/DLA: Not required if VRM lookup enabled.
     *
     * @var \DateTime
     */
    protected $registrationDate;

    /**
     * Vehicles current odometer reading.
     *
     * @var int
     */
    protected $currentOdometerReading;

    /**
     * Vehicle Registration Mark (VRM), Vehicle Identity Number (VIN), Residual Value Code (RVC).
     *
     * @var string
     */
    protected $identity;

    /**
     * What is the identity chosen from above.
     *
     * @var string
     *
     * @see \Olsgreen\IVendi\Quoteware\Api\Enums\IdentityTypes
     */
    protected $identityType = IdentityTypes::VRM;

    /**
     * Type of vehicle.
     *
     * @var string
     *
     * @see \Olsgreen\IVendi\Quoteware\Api\Enums\VehicleClass
     */
    protected $vehicleClass;

    /**
     * Whether the vehicle is new or used.
     *
     * @var string
     *
     * @see \Olsgreen\IVendi\Quoteware\Api\Enums\VehicleConditions
     */
    protected $vehicleCondition = VehicleConditions::USED;

    /**
     * Whether the Cash Price includes VAT.
     *
     * @var bool
     */
    protected $vatIncluded = false;

    /**
     * Is the asset VAT Qualifying. Normally used for commercial
     * Assets where VAT has been reclaimed.
     *
     * @var bool
     */
    protected $vatQualifying = false;

    /**
     * URL to an image of the vehicle.
     *
     * @var string
     */
    protected $imageUrl;

    /**
     * Additional parameters to send with the request.
     *
     * @var array
     */
    protected $additionalParameters = [];

    /**
     * Attribute keys which are required
     * and must not be empty.
     *
     * @var string[]
     */
    protected $requiredAttributes = [
        'username',
        'quoteeUid',
        'cashPrice',
        'annualDistance',
        'term',
        'currentOdometerReading',
        'identity',
    ];

    public function getCreditTier()
    {
        return $this->creditTier;
    }

    public function setCreditTier($tier): self
    {
        $tiers = new CreditTiers();

        if (!$tiers->contains($tier)) {
            throw new ValidationException('Invalid credit tier specified.');
        }

        $this->creditTier = $tier;

        return $this;
    }

    public function getCashPrice(): float
    {
        return $this->cashPrice;
    }

    public function setCashPrice($price): self
    {
        $this->cashPrice = floatval($price);

        return $this;
    }

    public function getCashDeposit(): float
    {
        return $this->cashDeposit;
    }

    public function setCashDeposit($price): self
    {
        $this->cashDeposit = floatval($price);

        return $this;
    }

    public function getAnnualDistance(): int
    {
        return $this->annualDistance;
    }

    public function setAnnualDistance($miles): self
    {
        $this->annualDistance = intval($miles);

        return $this;
    }

    public function getTerm(): int
    {
        return $this->term;
    }

    public function setTerm($miles): self
    {
        $this->term = intval($miles);

        return $this;
    }

    public function getTermUnits(): string
    {
        return $this->termUnits;
    }

    public function setTermUnits(string $units): self
    {
        if (!(new TermUnits())->contains($units)) {
            throw new ValidationException('Invalid units specified.');
        }

        $this->termUnits = $units;

        return $this;
    }

    public function getEntityType(): string
    {
        return $this->entityType;
    }

    public function setEntityType(string $type): self
    {
        if (!(new EntityTypes())->contains($type)) {
            throw new ValidationException('Invalid type specified.');
        }

        $this->entityType = $type;

        return $this;
    }

    public function getRegistrationMark(): ?string
    {
        return $this->registrationMark;
    }

    public function setRegistrationMark(string $mark): self
    {
        $this->registrationMark = $mark;

        return $this;
    }

    public function getRegistrationDate(): ?\DateTime
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate($date): self
    {
        if (!($date instanceof \DateTime)) {
            $date = new \DateTime($date);
        }

        $this->registrationDate = $date;

        return $this;
    }

    public function getCurrentOdometerReading(): int
    {
        return $this->currentOdometerReading;
    }

    public function setCurrentOdometerReading($miles): self
    {
        $this->currentOdometerReading = intval($miles);

        return $this;
    }

    public function getIdentity(): string
    {
        return $this->identity;
    }

    public function setIdentity(string $identity): self
    {
        $this->identity = $identity;

        return $this;
    }

    public function getIdentityType(): string
    {
        return $this->identityType;
    }

    public function setIdentityType(string $identityType): self
    {
        if (!(new IdentityTypes())->contains($identityType)) {
            throw new ValidationException('Invalid identity type specified.');
        }

        $this->identityType = $identityType;

        return $this;
    }

    public function getVehicleClass(): ?string
    {
        return $this->vehicleClass;
    }

    public function setVehicleClass(string $class): self
    {
        if (!(new VehicleClass())->contains($class)) {
            throw new ValidationException('Invalid class specified.');
        }

        $this->vehicleClass = $class;

        return $this;
    }

    public function getVehicleCondition(): ?string
    {
        return $this->vehicleCondition;
    }

    public function setVehicleCondition(string $condition): self
    {
        if (!(new VehicleConditions())->contains($condition)) {
            throw new ValidationException('Invalid condition specified.');
        }

        $this->vehicleCondition = $condition;

        return $this;
    }

    public function getVatIncluded(): bool
    {
        return $this->vatIncluded;
    }

    public function setVatIncluded($state): self
    {
        $this->vatIncluded = boolval($state);

        return $this;
    }

    public function getvatQualifying(): bool
    {
        return $this->vatQualifying;
    }

    public function setVatQualifying($state): self
    {
        $this->vatQualifying = boolval($state);

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $url): self
    {
        $this->imageUrl = $url;

        return $this;
    }

    public function getAdditionalParameters(): array
    {
        return $this->additionalParameters;
    }

    public function setAdditionalParameters(array $params): self
    {
        $this->additionalParameters = $params;

        return $this;
    }

    public function validate(): bool
    {
        $requiresVehicleData = ($this->identityType !== IdentityTypes::VRM);

        if ($requiresVehicleData && empty($this->registrationDate)) {
            throw new ValidationException('Registration date must be set when identity type is not VRM.');
        }

        if ($requiresVehicleData && empty($this->registrationMark)) {
            throw new ValidationException('Registration mark must be set when identity type is not VRM.');
        }

        if ($requiresVehicleData && empty($this->vehicleClass)) {
            throw new ValidationException('Vehicle class must be set when identity type is not VRM.');
        }

        return parent::validate();
    }

    public function toArray(): array
    {
        $this->validate();

        return array_merge_recursive($this->additionalParameters, [
            'PlatformMeta' => null,
            'HtmlOptions'  => [
                'IncludeOptions' => false,
                'AsHtml'         => false,
                'ImageUrl'       => $this->getImageUrl(),
                'ReturnUrl'      => null,
                'Make'           => null,
                'Model'          => null,
                'Derivative'     => null,
                'Channel'        => null,
                'RegDate'        => null,
                'DealerId'       => null,
                'VehicleMileage' => null,
                'EncryptedVrm'   => null,
            ],
            'Credentials' => [
                'Username' => $this->getUsername(),
                'Mode'     => 0,
            ],
            'DealershipEnrichment' => [
                'IpAddress'              => null,
                'Email'                  => null,
                'Postcode'               => null,
                'SearchMeta'             => null,
                'UserAgent'              => null,
                'UserGenerated'          => true,
                'TraceRequest'           => false,
                'PersistRequestResponse' => true,
            ],
            'QuoteRequests' => [
                [
                    'ProductRequestUID'        => null,
                    'IsPlatformProductRequest' => false,
                    'QuoteeUID'                => $this->getQuoteeUid(),
                    'GlobalRequestSettings'    => null,
                    'RequestSettings'          => null,
                    'RequestParameters'        => null,
                    'GlobalRequestParameters'  => [
                        'Rate'             => 0,
                        'RateType'         => 'Default',
                        'Commission'       => 0,
                        'CommissionType'   => 'Default',
                        'ComputationPath'  => 'Default',
                        'Term'             => $this->getTerm(),
                        'TermUnit'         => $this->getTermUnits(),
                        'PaymentRangeFrom' => 0,
                        'PaymentRangeTo'   => 0,
                        'RegularPayment'   => 0,
                    ],
                    'Requests' => [
                        [
                            'CreditTier' => $this->getCreditTier(),
                            'Figures'    => [
                                'CashPrice'   => $this->getCashPrice(),
                                'CashDeposit' => $this->getCashDeposit(),
                                'Asset'       => [
                                    'ManualResidualValue'   => 0,
                                    'ResidualValueYear'     => 0,
                                    'ResidualValueMonth'    => 0,
                                    'AnnualDistance'        => $this->getAnnualDistance(),
                                    'PartExchange'          => 0,
                                    'OutstandingSettlement' => 0,
                                    'VATIncluded'           => $this->getVatIncluded() ? 'True' : 'None',
                                    'VATQualifying'         => $this->getvatQualifying() ? 'True' : 'None',
                                    'Extras'                => null,
                                ],
                            ],
                            'Asset' => [
                                'CurrentOdometerReading' => $this->getCurrentOdometerReading(),
                                'RegistrationDate'       => $this->getRegistrationDate() ? $this->getRegistrationDate()->format('d/m/Y') : null,
                                'RegistrationMark'       => $this->getRegistrationMark(),
                                'Condition'              => $this->getVehicleCondition(),
                                'Source'                 => 'Default',
                                'Identity'               => $this->getIdentity(),
                                'IdentityType'           => $this->getIdentityType(),
                                'StockIdentity'          => null,
                                'StockingDate'           => null,
                                'StockLocation'          => null,
                                'Class'                  => $this->getVehicleClass(),
                                'CubicCentimetres'       => 0,
                                'EntityType'             => $this->getEntityType(),
                            ],
                            'RequestSettings'   => null,
                            'RequestParameters' => null,
                        ],
                    ],
                ],
            ],
        ]);
    }
}
