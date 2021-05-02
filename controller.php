<?php 
    include 'helper.php';
    include 'model.php';
    include 'connection.php';


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

    function getTransactions($id) {
        $pdo = (object)['pdo' => DBConnection::getDB()];
        $transactions =  Model::find($pdo, array('user_id' => $id), 'transactions');

        return $transactions;
    }

    function getInvestments($id) {
        $pdo = (object)['pdo' => DBConnection::getDB()];
        $investments =  Model::find($pdo, array('user_id' => $id), 'investments');

        return $investments; 
    }

    function getDashboardDetails($id) {
        $pdo = (object)['pdo' => DBConnection::getDB()];

        $transactions =  Model::find($pdo, array('user_id' => $id), 'transactions');
        $investments = Model::find($pdo, array('user_id' => $id), 'investments');

        return array('transactions' => $transactions, 'investments' => $investments);
    }

    function withdrawFunds() {
        $pdo = (object)['pdo' => DBConnection::getDB()];
        $id = $_SESSION['userInfo']['id'];

        if (!is_numeric($_POST['amount'])) {
            Helper::jsonResponse(array('success' => false, 'message' => 'Invalid amount'));
        }

        $balance = getBalance($details['transactions'], $details['investments']);

        if ($_POST['amount'] > $balance) {
            Helper::jsonResponse(array('success' => false, 'message' => 'Insufficient balance'));
        }

        $result = Model::create($pdo, array('amount' => $_POST['amount'], 'transaction_type' => 0, 'status' => 1, 
                        'date_created' => date('d-m-y h:i:s'), 'user_id' => $id), 'transactions');


            
        
        
        if ($result) {
            Model::create($pdo, array('user_id' => $id, 'amount' => $_POST['amount']));
            Helper::jsonResponse(array('success' => true, 'message' => 'Your wthdrawal request submitted successfully'));
        }

        Helper::jsonResponse(array('success' => false, 'message' => 'Server error'));
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

    function addInvestment($data) {
        $pdo = (object)['pdo' => DBConnection::getDB()];
        $investment = Model::create($pdo, $data, 'investments');

        $data['transaction_type'] = 1;
        $data['status'] = 2;
        $transaction = Model::create($pdo, $data, 'transactions');
        if ($investment) {
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
?>