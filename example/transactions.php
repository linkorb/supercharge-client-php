<?php

require_once 'common.php';

use Supercharge\Client\Transaction;
use Supercharge\Client\Contact;
use Supercharge\Client\Ledgeraccount;
use Supercharge\Client\Journal;
use Supercharge\Client\Supercharge;

Supercharge::setApiBase($url);
Supercharge::setPassword($password);
Supercharge::setUsername($username);

try {
    // get all transactions
    $transactions = Transaction::all(); // array of Transaction objects

    if (count($transactions))
    {
        // retrieve one by id
        $transaction = Transaction::retrieve($transactions[0]->getId()); // single Transaction
    }

    // try to create new one
    try {
        $newTransaction = Transaction::create(['contact_code' => 'code']); // this one fails
    }
    catch (\Exception $e)
    {
        echo $e->getCode() . ' ' . $e->getMessage() . "\n";
    }


    $transaction = null;
    //contact_code,ledger_account_code,journal_code,transaction_type,price,quantity,effect_at
    $contacts = Contact::all();
    $ledgerAccounts = Ledgeraccount::all();
    $journals = Journal::all();

    // let's try again
    if (count($contacts) && count($ledgerAccounts) && count($journals))
    {
        $transaction = new Transaction();
        $transaction->setContactCode($contacts[0]->getCode());
        $transaction->setLedgerAccountCode($ledgerAccounts[0]->getCode());
        $transaction->setJournalCode($journals[0]->getCode());
        $transaction->setTransactionType('charge');
        $transaction->setPrice(100);
        $transaction->setQuantity(100);
        $transaction->setEffectAt('2016-03-04');

        $transaction->save();

        echo 'new id ' . $transaction->getId() . "\n";
    }

    if ($transaction)
    {
        $transaction->setQuantity(200);
        $transaction->save();
    }
}
catch(\Exception $e)
{
    echo $e->getCode() .' '.$e->getMessage()."\n";
}


echo '<pre>';
//print_r($transactions);
echo '</pre>';

