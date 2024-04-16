<?php
/**
 * 
 * API Virtual Account
 * Used to make payments to certain accounts online
 * 
 */

include_once($_SERVER['DOCUMENT_ROOT'] . "/controller/virtual_account.php");

// make connection to db
$conn = dbConnect("orbit_bank_db");

// code here

// close connection to db
mysqli_close($conn);