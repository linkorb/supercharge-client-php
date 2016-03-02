<?php

require_once 'common.php';

use Supercharge\Client\Subscription;
use Supercharge\Client\Contact;
use Supercharge\Client\Plan;
use Supercharge\Client\Supercharge;

Supercharge::setApiBase($url);
Supercharge::setPassword($password);
Supercharge::setUsername($username);

// get all subscriptions
$subscriptions = Subscription::all(); // array of Subscription objects

if (count($subscriptions))
{
    // retrieve one by id
    $subscription = Subscription::retrieve($subscriptions[0]->getId()); // single Subscription
}

// try to create new one
try {
    $newSubscription = Subscription::create(['contact_code' => 'code', 'plan_code' => 'plan_code', 'quantity' => 10, 'start_date' => '2015-03-02 22:00:00']); // this one fails
}
catch (\Exception $e)
{
    echo $e->getCode() . ' ' . $e->getMessage() . "\n";
}

$plans = Plan::all();
$contacts = Contact::all();

if (count($plans) && count($contacts)) // subscription requires plan_code and contact_code
{
    // create new one
    $newSubscription = Subscription::create(['contact_code' => $contacts[0]->getCode(), 'plan_code' => $plans[0]->getCode(), 'quantity' => 10, 'start_date' => '2015-03-02 22:00:00']);

    // update
    // only end_date is editable
    $newSubscription->setEndDate('2015-03-10 00:00:00');
    $newSubscription->save();


    // or you even can create like this one
    $newSubscription2 = new Subscription();
    $newSubscription2->setContactCode($contacts[0]->getCode());
    $newSubscription2->setPlanCode($plans[0]->getCode());
    $newSubscription2->setQuantity(5);
    $newSubscription2->setStartDate('2015-04-12 00:00:00');
    $newSubscription2->save();

    echo 'new id: '.$newSubscription2->getId() . "\n";
}


echo '<pre>';
//print_r($newSubscription);
echo '</pre>';

