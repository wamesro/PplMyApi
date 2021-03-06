<?php
/**
 * Copyright (C) 2016 Adam Schubert <adam.schubert@sg1-game.net>.
 */

namespace Salamek\PplMyApi\Model;

use Salamek\PplMyApi\Enum\Country;
use Salamek\PplMyApi\Exception\WrongDataException;
use Salamek\PplMyApi\Validators\MaxLengthValidator;

/**
 * Class Recipient
 * @package Salamek\MyApi
 */
class Recipient implements IRecipient
{
    /** @var string */
    private $city;

    /** @var null|string */
    private $contact = null;

    /** @var null|string */
    private $country = null;

    /** @var null|string */
    private $email = null;

    /** @var string */
    private $name;

    /** @var null|string */
    private $name2 = null;

    /** @var null|string */
    private $phone = null;

    /** @var string */
    private $street;

    /** @var string */
    private $zipCode;

    /**
     * Sender constructor.
     * @param string $city
     * @param string $name
     * @param string $street
     * @param string $zipCode
     * @param string|null $email
     * @param string|null $phone
     * @param string|null $contact
     * @param string $country
     * @param string|null $name2
     */
    public function __construct($city, $name, $street, $zipCode, $email = null, $phone = null, $contact = null, $country = Country::CZ, $name2 = null)
    {
        $this->setCity($city);
        $this->setName($name);
        $this->setStreet($street);
        $this->setZipCode($zipCode);
        $this->setEmail($email);
        $this->setPhone($phone);
        $this->setContact($contact);
        $this->setCountry($country);
        $this->setName2($name2);
    }

    /**
     * @inheritdoc
     */
    public function setCity($city)
    {
        MaxLengthValidator::validate($city, 50);
        $this->city = $city;
    }

    /**
     * @inheritdoc
     */
    public function setContact($contact)
    {
        if (!is_null($contact)) {
            MaxLengthValidator::validate($contact, 300);
        }

        $this->contact = $contact;
    }

    /**
     * @inheritdoc
     */
    public function setCountry($country)
    {
        if (!in_array($country, Country::$list)) {
            throw new WrongDataException(sprintf('Country Code %s is not supported, use one of %s', $country, implode(', ', Country::$list)));
        }
        $this->country = $country;
    }

    /**
     * @inheritdoc
     */
    public function setEmail($email)
    {
        if (!is_null($email)) {
            MaxLengthValidator::validate($email, 50);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new WrongDataException('$email have invalid value');
            }
        }

        $this->email = $email;
    }

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        MaxLengthValidator::validate($name, 50);
        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    public function setName2($name2)
    {
        if (!is_null($name2)) {
            MaxLengthValidator::validate($name2, 50);
        }
        $this->name2 = $name2;
    }

    /**
     * @inheritdoc
     */
    public function setPhone($phone)
    {
        if (!is_null($phone)) {
            MaxLengthValidator::validate($phone, 30);
        }

        $this->phone = $phone;
    }

    /**
     * @inheritdoc
     */
    public function setStreet($street)
    {
        MaxLengthValidator::validate($street, 50);
        $this->street = $street;
    }

    /**
     * @inheritdoc
     */
    public function setZipCode($zipCode)
    {
        MaxLengthValidator::validate($zipCode, 10);
        $this->zipCode = $zipCode;
    }

    /**
     * @inheritdoc
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @inheritdoc
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @inheritdoc
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @inheritdoc
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function getName2()
    {
        return $this->name2;
    }

    /**
     * @inheritdoc
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @inheritdoc
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @inheritdoc
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }
}