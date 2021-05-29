<?php

    $amount = isset($_POST['amount']) ? $_POST['amount'] : null;
    if (!is_numeric($amount)) {
        Helper::jsonResponse(array(
            'success' => false,
            'data' => 'Amount must be in numbers alone',
        ));
    }
    $userId = isset($_POST['userId']) ? $_POST['userId'] : null;
    if ($userId && $amount) {
        $user = getUser($userId);
        if ($user) {
            $data = array('amount' => $amount, 'user_id' => $userId, 'date_created' => gmdate('Y-m-d\ H:i:s'));
            addInvestment($data);
        }
    }

    Helper::jsonResponse(array(
        'success' => false,
        'data' => 'Server error',
    ));
?>
