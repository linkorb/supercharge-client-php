<?php

namespace Supercharge\Client;

class Contact extends SuperchargeObject
{
    protected $id;
    protected $code;
    protected $administration_id;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $organization;
    protected $vatnr;
    protected $addressline1;
    protected $addressline2;
    protected $city;
    protected $stateprovince;
    protected $postalcode;
    protected $country_id;
    protected $created_at;
    protected $coc_number;
    protected $bank_number;
    protected $phone;
    protected $is_batch_recipient;
    protected $psp_id;

    public static function create($params)
    {
        return self::_create($params);
    }

    public function save()
    {
        if (!$this->id)
        {
            $obj = self::_create($this->toArray());
            $this->id = $obj->getId();
            return;
        }

        if ($this->code)
        {
            return self::_update($this->code, $this->toArray());
        }
        throw new \Exception('Should be no Id to create or code must be provided to update');
    }
}
