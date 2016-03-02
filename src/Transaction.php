<?php

namespace Supercharge\Client;

class Transaction extends SuperchargeObject
{
    protected $id;
    protected $administration_code;
    protected $contact_id;
    protected $contact_code;
    protected $transaction_type;
    protected $created_at;
    protected $effect_at;
    protected $source_type;
    protected $source_id;
    protected $vat_id;
    protected $vat_code;
    protected $price;
    protected $quantity;
    protected $description;
    protected $notes;
    protected $batch_id;
    protected $invoice_id;
    protected $parent_id;
    protected $metadata;
    protected $pledge;
    protected $ledger_account_id;
    protected $payment_method_id;
    protected $journal_id;
    protected $turnover_group_id;
    protected $chargeable_id;
    protected $ledger_account_code;
    protected $payment_method_code;
    protected $journal_code;
    protected $turnover_group_code;
    protected $chargeable_code;

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
