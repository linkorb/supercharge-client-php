Use these examples to test Supercharge functionality

## Setup environment variables

These examples assume the following three environment variables are set:

* SUPERCHARGE_USERNAME
* SUPERCHARGE_PASSWORD
* SUPERCHARGE_URL

SUPERCHARGE_URL should be full api endpoint with version and administrationCode/accountCode 

For example:
```
export SUPERCHARGE_USERNAME="joe"
export SUPERCHARGE_PASSWORD="secret"
export SUPERCHARGE_URL="http://localhost:8080/api/v1/admcode/accountcode"
```

Now run the examples like this:
```
php ./example/contacts.php
```
