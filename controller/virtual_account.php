<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/database/config.php");
include_once($_SERVER["DOCUMENT_ROOT"] . "/controller/transaction.php");

function generateVirtualAccountNumber($receiverAccountNumber) {
    // concat date and receiver account number to get virtual account number
    $virtualAccountNumber = date("YmdHis") . $receiverAccountNumber;

    // erase headpas of year: like 19, 20.
    $virtualAccountNumber = substr($virtualAccountNumber, 2);

    return $virtualAccountNumber;
}

function getVirtualAccountData($request) {
    $conn = dbConnect("orbit_bank_db");
    $sql = "SELECT virtual_account_id, receiver_account_id, amount, information, creation_datetime, expired_date, transaction_conditon
            FROM virtual_accounts
            WHERE virtual_account_number = '{$request["virtual_account_number"]}'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $data;
}

function createVirtualAccount($request) {
    $conn = dbConnect("orbit_bank_db");
    
    // get data needed
    $account_id = _getAccountId($request["receiver_account_number"], $conn);
    $virtualAccountNumber = generateVirtualAccountNumber($request["receiver_account_number"]);
    
    // insert data
    $sql = "INSERT INTO `virtual_accounts`
            (`receiver_account_id`, `virtual_account_number`, `amount`, `information`, `creation_datetime`, `expired_date`, `transaction_conditon`)
            VALUES
            ($account_id, '$virtualAccountNumber', {$request["amount"]}, '{$request["information"]}', current_timestamp(), ADDDATE(current_timestamp(), INTERVAL 1 DAY), 'waiting for transaction')";
    $result = mysqli_query($conn, $sql);
    
    $virtualAccountId = mysqli_insert_id($conn);
    
    mysqli_close($conn);

    // get data
    $data = getVirtualAccountData(["virtual_account_number" => $virtualAccountNumber]);
    $data["virtual_account_number"] = $virtualAccountNumber;

    // don't return all data
    return $data;
}

function editVirtualAccount($request, $virtualAccount) {
}