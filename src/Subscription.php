<?php

namespace Supercharge\Client;

class Subscription extends SuperchargeObject
{
    protected $id;
    protected $administration_code;
    protected $contact_id;
    protected $contact_code;
    protected $plan_id;
    protected $plan_code;
    protected $quantity;
    protected $start_date;
    protected $end_date;
    protected $created_at;

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

        return self::_update($this->id, $this->toArray());
    }
}
