<?php

namespace Olsgreen\IVendi\Quoteware\Api;

use Olsgreen\AbstractApi\Builders\ValidationException;

trait HasCredentials
{
    /**
     * Your username used to access iVendi services.
     *
     * @var string
     */
    protected $username;

    /**
     * Uniquely identifies the quotee and therefore quotation parameters & allowable products.
     *
     * @var string
     */
    protected $quoteeUid;

    public function getUsername():? string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        if (strlen($username) > 30) {
            throw new ValidationException('Username must be under 30 characters.');
        }

        $this->username = $username;

        return $this;
    }

    public function getQuoteeUid():? string
    {
        return $this->quoteeUid;
    }

    public function setQuoteeUid(string $uid): self
    {
        $this->quoteeUid = $uid;

        return $this;
    }
}