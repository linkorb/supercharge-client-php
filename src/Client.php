<?php

namespace Supercharge\Client;

class Client
{
    public function __construct($username, $password, $url)
    {
        Supercharge::setApiBase($url);
        Supercharge::setPassword($password);
        Supercharge::setUsername($username);
    }

    /**
     * @return array of Contact
     */
    public function getContacts()
    {
        return Contact::all();
    }

    /**
     * @param string $contactCode
     * @return Contact
     */
    public function getContact($contactCode)
    {
        return Contact::retrieve($contactCode);
    }

    /**
     * @param array $params needed to create Contact
     * @return Contact
     */
    public function createContact($params)
    {
        return Contact::create($params);
    }

    /**
     * @return array of Journal
     */
    public function getJournals()
    {
        return Journal::all();
    }

    /**
     * @param string $journalCode
     * @return Journal
     */
    public function getJournal($journalCode)
    {
        return Journal::retrieve($journalCode);
    }

    /**
     * @return array of Ledgeraccounts
     */
    public function getLedgerAccounts()
    {
        return Ledgeraccount::all();
    }

    /**
     * @param string $ledgerAccountCode
     * @return Ledgeraccount
     */
    public function getLedgerAccount($ledgerAccountCode)
    {
        return Ledgeraccount::retrieve($ledgerAccountCode);
    }

    /**
     * @return array of Paymenmethod
     */
    public function getPaymentMethods()
    {
        return Paymentmethod::all();
    }

    /**
     * @param string $paymentMethodCode
     * @return Paymentmethod
     */
    public function getPaymentMethod($paymentMethodCode)
    {
        return Paymentmethod::retrieve($paymentMethodCode);
    }

    /**
     * @return array of Plan
     */
    public function getPlans()
    {
        return Plan::all();
    }

    /**
     * @param string $planCode
     * @return Plan
     */
    public function getPlan($planCode)
    {
        return Plan::retrieve($planCode);
    }

    /**
     * @return array of Subscription
     */
    public function getSubscriptions()
    {
        return Subscription::all();
    }

    /**
     * @param int $subscriptionId
     * @return Subscription
     */
    public function getSubscription($subscriptionId)
    {
        return Subscription::retrieve($subscriptionId);
    }

    /**
     * @param array $params needed to create a Subscription
     * @return Subscription
     */
    public function createSubscription($params)
    {
        return Subscription::create($params);
    }

    /**
     * @return array of Transaction
     */
    public function getTransactions()
    {
        return Transaction::all();
    }

    /**
     * @param int $transactionId
     * @return Transaction
     */
    public function getTransaction($transactionId)
    {
        return Transaction::retrieve($transactionId);
    }

    /**
     * @param array $params needed to create a Transaction
     * @return Transaction
     */
    public function createTransaction($params)
    {
        return Transaction::create($params);
    }

    /**
     * @return array of Turnovergroup
     */
    public function getTurnoverGroups()
    {
        return Turnovergroup::all();
    }

    /**
     * @param string $turnoverGroupCode
     * @return Turnovergroup
     */
    public function getTurnoverGroup($turnoverGroupCode)
    {
        return Turnovergroup::retrieve($turnoverGroupCode);
    }

    /**
     * @return array of Vat
     */
    public function getVats()
    {
        return Vat::all();
    }

    /**
     * @param string $vatCode
     * @return Vat
     */
    public function getVat($vatCode)
    {
        return Vat::retrieve($vatCode);
    }
}
