<?php

require_once 'common.php';

use Supercharge\Client\Contact;
use Supercharge\Client\Supercharge;

Supercharge::setApiBase($url);
Supercharge::setPassword($password);
Supercharge::setUsername($username);

// get all contacts
$contacts = Contact::all(); // array of Contact objects

if (count($contacts))
{
    // retrieve one by code
    $contact = Contact::retrieve($contacts[0]->getCode()); // single Contact
}

// try to create new one
try {
    $newContact = Contact::create(['code' => md5(rand()), 'firstname' => 'John', 'email' => 'valid_email@example.com']); // this one fails because lastname is missing
}
catch (\Exception $e)
{
    echo $e->getCode() . ' ' . $e->getMessage() . "\n";
}


// create new one
$newContact = Contact::create(['code' => md5(rand()), 'firstname' => 'John', 'lastname'=> 'Dow', 'email' => 'valid_email@example.com']);

// update
$newContact->setOrganization('bigOne');
$newContact->save();


// or you even can create like this one
$newContact2 = new Contact();
$newContact2->setCode(md5(rand()));
$newContact2->setFirstname('John');
$newContact2->setLastname('Dow');
$newContact2->setEmail('valid_email@example.com');
$newContact2->save();

echo 'new id: '.$newContact2->getId() . "\n";


echo '<pre>';
//print_r($newContact);
echo '</pre>';

