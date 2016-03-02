<?php

namespace Supercharge\Client;

class Plan extends SuperchargeObject
{
    protected $id;
    protected $code;
    protected $account_code;
    protected $administration_code;
    protected $display_name;
    protected $description;
    protected $setup_fee;
    protected $recurring_fee;
    protected $interval_length;
    protected $interval_unit;
    protected $max_cycles;
    protected $trial_days;
    protected $vat_id;
    protected $vat_code;
    protected $turnover_group_id;
    protected $turnover_group_code;
    protected $created_at;
}
