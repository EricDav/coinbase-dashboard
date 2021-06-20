<?php 
    include 'helper.php';
    include 'model.php';
    include 'connection.php';
    include 'customrand.php';
    include 'keygen.php';
    include 'SendMail.php';

    function getDescription($status) {
        $INVESTMENT_TYPE = 1;
        $REFERRAL_BONUS_TYPE = 2;
        $PROFIT_TYPE = 3;
        if ($status == $INVESTMENT_TYPE) {
            return 'Investment deposit';
        }

        if ($status == $INVESTMENT_TYPE) {
            return 'Referal Bonus';
        }

        if ($status == $PROFIT_TYPE) {
            return 'Return from investment or profit';
        }

        return 'Nill';
    }

    function getUser($id) {
        $pdo = (object)['pdo' => DBConnection::getDB()];
        $user = Model::findOne($pdo, array('id' => $id), 'users');

        return $user;
    }

    function findUser($data) {
        $pdo = (object)['pdo' => DBConnection::getDB()];
        $user = Model::findOne($pdo, $data, 'users');

        return $user;
    }

    function getReferral($data) {
        $pdo = (object)['pdo' => DBConnection::getDB()];
        $referral = Model::findOne($pdo, $data, 'referrals');

        return $referral;
    }

    function getTransactions($id) {
        $pdo = (object)['pdo' => DBConnection::getDB()];
        $transactions =  Model::getTransactions($pdo, $id);
        var_dump($transactions); exit;

        return $transactions;
    }

    function getInvestments($id) {
        $pdo = (object)['pdo' => DBConnection::getDB()];
        $investments =  Model::find($pdo, array('user_id' => $id), 'investments');

        return $investments; 
    }

    function getDashboardDetails($id) {
        $pdo = (object)['pdo' => DBConnection::getDB()];

        $transactions = Model::getTransactions($pdo, $id);
        
        // var_dump($transactions); exit;
        $investments = Model::find($pdo, array('user_id' => $id), 'investments');
        $balance = 0;
        $newTransactions = array();
        foreach($transactions as $transaction) {
            $balance = $transaction['transaction_type'] == 0 ? ($balance - $transaction['amount']) : ($balance + $transaction['amount']);
            $transaction['balance'] = $balance;
            array_push($newTransactions, $transaction);
        }

        return array('transactions' => $newTransactions, 'investments' => $investments);
    }

    function withdrawFunds($details) {
        $pdo = (object)['pdo' => DBConnection::getDB()];
        $id = $_SESSION['user']['id'];
        // echo $_POST['amount']; exit;
        // $details = isset($_SESSION['user']) ? getDashboardDetails($_SESSION['user']['id']) : null;
        // var_dump($details); exit;

        if (!is_numeric($_POST['amount'])) {
            Helper::jsonResponse(array('success' => false, 'message' => 'Invalid amount'));
        }

        $balance = number_format(getWithdrawableBalance($details['transactions'], $details['investments']), 2);
       // echo $balance; exit;

        if ($_POST['amount'] > $balance) {
            Helper::jsonResponse(array('success' => false, 'message' => 'Insufficient balance, you can only withdraw your profit'));
        }

        $result = Model::create($pdo, array('amount' => $_POST['amount'], 'transaction_type' => 0, 'status' => 1, 
                        'date_created' => gmdate('Y-m-d\ H:i:s'), 'user_id' => $id), 'transactions');

       
            Model::create($pdo, array('user_id' => $id, 'name' => $_SESSION['user']['name'], 'date_created' => gmdate('Y-m-d\ H:i:s'), 'transaction_id' => $result, 'status' => 1, 'wallet' => $_POST['wallet'], 'amount' => $_POST['amount']), 'withdrawal_request');
            Helper::jsonResponse(array('success' => true, 'message' => 'Your wthdrawal request submitted successfully'));
        // }

        Helper::jsonResponse(array('success' => false, 'message' => 'Server error'));
    }

    function getRequests() {
        $pdo = (object)['pdo' => DBConnection::getDB()];
        $requests =  Model::find($pdo, array('status' => 1), 'withdrawal_request');

        return $requests;
    }

    function confirmRequest() {
        $pdo = (object)['pdo' => DBConnection::getDB()];

        Model::update($pdo, array('status' => 2), array('id' => $_GET['t_id']), 'transactions');
        Model::update($pdo, array('status' => 2), array('id' => $_GET['w']), 'withdrawal_request');
        header('Location: /requests');
    }

    function getAccountDetails() {
        $id = $_SESSION['userInfo']['id'];
        $pdo = (object)['pdo' => DBConnection::getDB()];
        $bankDetails = Model::findOne($pdo, array('user_id' => $id), 'bank_details');

        return $bankDetails ? $bankDetails : array();
    }

    function updateUserDetails() {
        $id = $_SESSION['user']['id'];
        $pdo = (object)['pdo' => DBConnection::getDB()];
        $errorMessages = array();

        $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : null;
        $phoneNumber = isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : null;
        $isValidFirstName = Helper::isValidName($firstName);
        if (!$isValidFirstName['isValid']) {
            $errorMessages['firstName'] = $isValidFirstName['message'];
        }

        if (!is_numeric($phoneNumber)) {
            $errorMessages['phoneNumber'] = 'Phone number is invalid';
        }

        if (sizeof($errorMessages) != 0) {
            Helper::jsonResponse(array('success' => false, 'message' => $errorMessages));
        }

        $userDetails = array(
            'name' => $firstName,
            'phone_number' => $phoneNumber
        );

        if(Model::update($pdo, $userDetails, array('id' => $id), 'users')) {
            $_SESSION['userInfo']['name'] = $userDetails['name'];
            $_SESSION['userInfo']['phone_number'] = $userDetails['phone_number'];
            Helper::jsonResponse(array('success' => true, 'message' => 'User details updated successfully'));
        }

        Helper::jsonResponse(array('success' => false, 'message' => 'Server error'));
    }

    function signup($data) {
        $pdo = (object)['pdo' => DBConnection::getDB()];
        $user = Model::create($pdo, $data, 'users');
        return $user;
    }

    function login($username, $passwordHash) {
        $pdo = (object)['pdo' => DBConnection::getDB()];
        $user = Model::findOne($pdo, array('email' => $username, 'password' => $passwordHash), 'users');

        return $user;
    }

    function getUsers() {
        $pdo = (object)['pdo' => DBConnection::getDB()];
        $users = Model::find($pdo, array(), 'users');
        return $users;
    }

    function getPlan($price) {
        $pdo = (object)['pdo' => DBConnection::getDB()];
        $plans = Model::find($pdo, array(), 'plans');

        foreach($plans as $plan) {
            $priceRange = str_replace(',', '', $plan['price_rang']);
            $rangeArr = explode(' - ', $priceRange);
            if ($price >= $rangeArr[0] && $price < $rangeArr[1]) {
                return $plan;
            }
        }

        return null;
    }

    function addInvestment($data) {
        $INVESTMENT_TYPE = 1;
        $REFERRAL_BONUS_TYPE = 2;
        $PROFIT_TYPE = 3;
        $pdo = (object)['pdo' => DBConnection::getDB()];
        $investment = Model::create($pdo, $data, 'investments');
        $plan = getPlan($data['amount']);
        $originalAmount = $data['amount'];

        for ($i = 0; $i < 2; $i++) {
            $hours = ((int)$plan['time_frame'] * 24) + 24;
            $date = date('Y-m-d H:m', strtotime("+" . $hours ." hours", strtotime(gmdate('Y-m-d\ H:i:s'))));
            $data['transaction_type'] = $i == 0 ? $INVESTMENT_TYPE : $PROFIT_TYPE;
            $data['status'] = 2;
            $data['date_created'] = $date;
            $data['amount'] = $i == 0 ? $data['amount'] : ($data['amount'] * ($plan['percent']/100));
            $transaction = Model::create($pdo, $data, 'transactions');
        }
        if ($investment) {
            // Adding referrals
            addReferralBonus($pdo, $data['user_id'], $originalAmount);
            $referal = getReferral(array('user_id' => $data['user_id']));
            Helper::jsonResponse(array(
                'success' => true,
                'message' => 'Investment created successfully'
            ));
        }
        Helper::jsonResponse(array(
            'success' => false,
            'message' => 'Server error'
        )); 
    }

    function addReferralBonus($pdo, $userId, $amount) {
        $referral = getReferral(array('user_id' => $userId));
        if ($referral) {
            $referralCode = $referral['referral_code'];
            $user = findUser(array('referral_code' => $referralCode));
            $plan = getPlan($amount);

            $referralBonus = $amount * ($plan['referral_percent']/100);
            $data = array('amount' => $referralBonus, 'user_id' => $user['id'], 'date_created' => gmdate('Y-m-d\ H:i:s'), 'type' => 'referral');
            $hours = 96;
            unset($data['type']);
            $data['transaction_type'] = 2;
            $data['status'] = 2;
            $transaction = Model::create($pdo, $data, 'transactions');
        }
    }

    function getPlans() {
        $pdo = (object)['pdo' => DBConnection::getDB()];
        $plans = Model::find($pdo, array(), 'plans');

        return $plans;
    }

    function addReferral($data) {
        $pdo = (object)['pdo' => DBConnection::getDB()];
        Model::create($pdo, $data, 'referrals');
        return true;
    }

    function getAllReferalBonus() {
        $userId = $_SESSION['user']['id'];

        $pdo = (object)['pdo' => DBConnection::getDB()];
        $referralBonuses = Model::find($pdo, array('user_id' => $userId, 'transaction_type' => 2), 'transactions');
        $bonuses = 0;
        foreach($referralBonuses as $referal) {
            $bonuses = $bonuses + (int)$referal['amount'];
        }

        return $bonuses;
    }
    function updateToken($userId, $token) {
        $pdo = (object)['pdo' => DBConnection::getDB()];
        Model::update($pdo, array('token' => $token), array('id' => $userId), 'users');
        return true;
    }

    function resetPassword($userId, $password) {
        $pdo = (object)['pdo' => DBConnection::getDB()];
        Model::update($pdo, array('password' => $password), array('id' => $userId), 'users');
    }
?>