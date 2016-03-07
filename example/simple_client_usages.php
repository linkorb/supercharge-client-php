<?php

require_once 'common.php';

use Supercharge\Client\Client;

// get all contacts
$client = new Client($username, $password, $url);

$contacts = $client->getContacts();


if (count($contacts))
{
    // get one by code
    $contact = $client->getContact($contacts[0]->getCode());
}

// create new one
$newContact = $client->createContact(['code' => md5(rand()), 'firstname' => 'John', 'lastname'=> 'Dow', 'email' => 'valid_email@example.com']);

// update existing
$newContact->setOrganization('organozation_name');
$newContact->save();



// workaround with other resources is the same


