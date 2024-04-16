<?php

include("controller/auth.php");
include("controller/transaction.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-3">
        <?php
        /**
         * 
         * Switch view by session login
         * If logged in, show transaction datas
         * else, show login/register menu
         * 
         */
        switch(isLoggedIn()) {
            case SessionCondtion::loggedIn:
                $profile = getProfile($_SESSION["username"]);
                $balances = getBalanceRecords($profile["account_number"]);
        ?>
        
        <!-- Account -->
        <form action="auth.php" method="get"><input type="submit" class="btn btn-primary" name="submit" value="Logout"></form><br>
        <table>
            <tr>
                <td style="padding: 0px 20px 0px 0px;">Name</td>
                <td style="padding: 0px 20px 0px 20px;">:</td>
                <td style="padding: 0px 20px 0px 20px;"><?=$profile["name"]?></td>
            </tr>
            <tr>
                <td style="padding: 0px 20px 0px 0px;">Address</td>
                <td style="padding: 0px 20px 0px 20px;">:</td>
                <td style="padding: 0px 20px 0px 20px;"><?=$profile["address"]?></td>
            </tr>
            <tr>
                <td style="padding: 0px 20px 0px 0px;">Email</td>
                <td style="padding: 0px 20px 0px 20px;">:</td>
                <td style="padding: 0px 20px 0px 20px;"><?=$profile["email"]?></td>
            </tr>
            <tr>
                <td style="padding: 0px 20px 0px 0px;">Account Number</td>
                <td style="padding: 0px 20px 0px 20px;">:</td>
                <td style="padding: 0px 20px 0px 20px;"><?=$profile["account_number"]?></td>
            </tr>
        </table><br/>
        

        <table border="1">
            <tr>
                <td style="padding: 0px 20px 0px 20px;">
                    <h3>Saving Form</h3>
                    <form action="transaction.php" method="post">
                        <input type="hidden" name="account_number" value="<?=$profile["account_number"]?>">
                        <label for="amount">Amount</label><br/>
                        <input type="number" name="amount" id="saving_amount"><br/>
                        <div class="mt-3">
                            <input type="submit" class="btn btn-primary" name="submit" value="Save">
                            <input type="submit" class="btn btn-primary" name="submit" value="Withdraw">
                        </div>
                    </form>
                </td>
                <td style="padding: 0px 20px 0px 20px;">
                    <h3>Transfer Form</h3>
                    <form action="transaction.php" method="post">
                        <input type="hidden" name="sender_account_number" value="<?=$profile["account_number"]?>">
                        <label for="receiver_account_number">Account Number</label><br/>
                        <input type="text" name="receiver_account_number" id="transfer_receiver_account_number"><br/>
                        <label for="amount">Amount</label><br/>
                        <input type="number" name="amount" id="transfer_amount"><br/>
                        
                        <div class="mt-3 mb-3">
                            <input type="submit" class="btn btn-primary" name="submit" value="Transfer">
                        </div>
                    </form>
                </td>
            </tr>
        </table><br/>
        

        <!-- Balances -->
        <table border="1">
            <tr>
                <th style="padding: 0px 20px 0px 20px;">No</th>
                <th style="padding: 0px 20px 0px 20px;">Date</th>
                <th style="padding: 0px 20px 0px 20px;">Debit</th>
                <th style="padding: 0px 20px 0px 20px;">Credit</th>
                <th style="padding: 0px 20px 0px 20px;">Balance</th>
            </tr>
            
            <?php
            $idx = 1;
            foreach ($balances as $balance) {
            ?>
            <tr>
                <td style="padding: 0px 20px 0px 20px;"><?=$idx?></td>
                <td style="padding: 0px 20px 0px 20px;"><?=$balance["record_date"]?></td>
                <td style="padding: 0px 20px 0px 20px;">Rp. <?=number_format($balance["debit"], 2, ",", ".")?></td>
                <td style="padding: 0px 20px 0px 20px;">Rp. <?=number_format($balance["credit"], 2, ",", ".")?></td>
                <td style="padding: 0px 20px 0px 20px;">Rp. <?=number_format($balance["balance"], 2, ",", ".")?></td>
            </tr>
            <?php
            }
            ?>
        </table>

        <!-- Login Register Menu -->
        <?php
                    break;
                default:
        ?>
        <h2>Log In</h2>
        <form action="auth.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">username</label>
                <input type="text" class="form-control" name="username" id="login_username">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">password</label>
                <input type="password" class="form-control" name="password" id="login_password">
            </div>

            <div class="mb-3">
                <input type="submit" class="btn btn-primary" name="submit" value="Login">
            </div>
        </form>

        
        <h2>Register</h2>
    
        <form method="post" action="register.php">
            <div class="mb-3">
                <label for="name" class="form-label">name</label>
                <input type="text" class="form-control" name="name" id="register_name">
            </div>

            <div class="mb-3">
                <label for="jalan" class="form-label" id="lbl_jalan">jalan</label>
                <input type="text" class="form-control" name="address[jalan]" id="register_jalan">
            </div>

            <div class="mb-3">
                <label for="provinsi" class="form-label" id="lbl_provinsi">provinsi</label>
                <select class="form-control" name="address[provinsi]" id="register_provinsi"></select>
            </div>

            <div class="mb-3">
                <label for="kabupaten" class="form-label" id="lbl_kabupaten">kabupaten/kota</label>
                <select class="form-control" name="address[kabupaten]" id="register_kabupaten"></select>
            </div>

            <div class="mb-3">
                <label for="kecamatan" class="form-label" id="lbl_kecamatan">kecamatan</label>
                <input type="text" class="form-control" name="address[kecamatan]" id="register_kecamatan">
            </div>

            <div class="mb-3">
                <label for="kelurahan" class="form-label" id="lbl_kelurahan">kelurahan</label>
                <input type="text" class="form-control" name="address[kelurahan]" id="register_kelurahan">
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">username</label>
                <input type="text" class="form-control" name="username" id="register_username">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <input type="text" class="form-control" name="email" id="register_email">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">password</label>
                <input type="password" class="form-control" name="password" id="register_password">
            </div>

            <div class="mb-3">
                <input type="submit" class="btn btn-primary" name="submit" value="Register">
            </div>
        </form>
        <?php
                    break;
                }
        ?>
    </div>
</body>
</html>