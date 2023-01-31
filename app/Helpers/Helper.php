<?php

function contants($cons)
{
    $contants = [
        'refreshToken' => '1000.4ba2e2d715694e641ae60786387b1b4c.84a1ad979d583f71069551f36ce7ce4e',
        'clientId' => '1000.EDWDQS40X91L8N7BGKF7W9AVGE86AN',
        'clientSecret' => '7fb0dabfe7bf52c21007b1f988dfe651fcb2c3cbd1',
        'grantType' => 'refresh_token',
    ];
    return $contants[$cons];
}

function urlGetRecord($formLinkName)
{
    return 'https://people.zoho.com/people/api/forms/' . $formLinkName . '/getRecords';
}

function urlAddRecord($formLinkName)
{
    return 'https://people.zoho.com/people/api/forms/json/' . $formLinkName . '/insertRecord';
}

function urlDeleteRecord()
{
    return 'https://people.zoho.com/people/api/deleteRecords';
}

function urlShowRecord($formLinkName)
{
    return 'https://people.zoho.com/people/api/forms/' . $formLinkName . '/getRecordByID';
}

function urlUpdateRecord($formLinkName)
{
    return 'https://people.zoho.com/people/api/forms/json/' . $formLinkName . '/updateRecord';
}

function strZohoId($response)
{
    $newParent = [];
    if ($response['response']['status'] == 0) {
        $json = $response['response']['result'];

        $newParent = [];
        foreach ($json as $zoho_id => $object[0]) {
            $newObject = [];
            foreach ($object[0] as $child) {
                $child[0]['Zoho_ID'] = (string) $child[0]['Zoho_ID'];
                $newObject = $child;
            }
            $newParent[$zoho_id] = $newObject;
        }
    }

    return $newParent;
}

function errorCode($code)
{
    $errors = [
        7037 =>  'Permission denied to perform the attempted action',
        7040 =>    'Permission denied to view records',
        7038 =>    'Permission denied to add records',
        7039 =>    'Permission denied to edit records',
        7041 =>    'Invalid search operator / permission denied / no data',
        7042 =>    'Invalid search value',
        7034 =>    'Invalid input value',
        7029 =>    'Save as draft option is disabled for form',
        7024 =>    'No records found',
        7043 =>    'Invalid search operator',
        7031 =>    'Single field edit not allowed',
        7016 =>    'Invalid input data',
        7048 =>    'Invalid user / No such user found',
        7049 =>    'Missing record for the specified record Id',
        7050 =>    'Invalid value for the field',
        7020 =>    'Invalid field / No such field present',
        7019 =>    'Missing parameter',
        7012 =>    'Invalid view name',
        7051 =>    'Value already exists',
        7052 =>    'Missing mandatory field values',
        7053 =>    'Invalid email address',
        7054 =>    'Invalid date field value',
        7055 =>    'Invalid date format',
        7056 =>    'Invalid number field value',
        7057 =>    'Field length exceeded limit',
        7058 =>    'Number field input is not in specified range',
        7059 =>    'Invalid URL for a URL type field ➥ A valid URL Must be entered ✔',
        7060 =>    'Attempting to change role of super admin ➥ Change role of non-admin user ✔',
        7061 =>    'Invalid change in employee status',
        7101 =>    'Inactive leave type',
        7102 =>    'Invalid hours taken format',
        7103 =>    'Leave type not chosen',
        7104 =>    'Leave type not applicable',
        7105 =>    'From date is ahead of To date ➥ From date must fall before To date ✔',
        7106 =>    'Leave applied before or after leave type validity period ➥ Leave can only be applied within a leave type validity period ✔',
        7107 =>    'Leave applied during noticed period ➥ Leave must be applied before notice period ✔',
        7108 =>    'Expired leave type selected',
        7109 =>    'Leave already taken on leave applied period',
        7110 =>    'Leave applied beyond allowed limit',
        7111 =>    'Leave application date must be ahead of date of joining',
        7112 =>    'Leave period must be lesser than consecutive days of leave allowed',
        7119 =>    'Location access error',
        7201 =>    'Invalid URL',
        7200 =>    'API Invocation Failure',
        7202 =>    'Invalid Authtoken',
        7203 =>    'Invalid extra parameters found',
        7204 =>    'Invalid data type found for input parameter',
        7205 =>    'Mismatch in input format',
        7207 =>    'Attempted to invoke URL with wrong method ➥ This URL can be invoked via GET method only ✔',
        7216 =>    'Attempted to invoke URL with wrong method ➥ This URL can be invoked via POST method only ✔',
        7062 =>    'Cyclic dependency in departments found',
        7022 =>    'Invalid input format',
        7011 =>    'Invalid form name',
        8000 =>    'No parameter specified ⏱',
        8001 =>    'Wrong value for parameter ⏱',
        8002 =>    'Wrong format for date parameter ⏱',
        8003 =>    'Invalid From and To date ⏱',
        8004 =>    'Error in job deletion ⏱',
        8005 =>    'Error in timer operations ⏱',
        8006 =>    'Error in changing job status ⏱',
    ];

    return $errors[$code];
}
