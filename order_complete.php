<?php
    include $_SERVER['DOCUMENT_ROOT'].'/config.php';
    $stmt = $db->prepare('select status FROM bitcoin WHERE address = :addr AND bitcoin_amount = :amount');
    $stmt->bindParam(':addr', $_GET['addr']);
    $stmt->bindParam(':amount', $_GET['amount']);
    $stmt->execute();
    $status = $stmt->fetchColumn();
    if($status == 'pending') {
        echo '
            <a class="cancel" href="">X</a><img src="/testing/check.png" style="margin: auto;display: block;"><h1 style="color: green;">PAYMENT<br> SUCCESSFUL!</h1><p style="text-align: center;margin-top: 100px;">Your Purchase will be processed after 2 blockchain confirmations. This can take between 20 minutes and 24 hours.</p>
        ';
        http_response_code(200);
    } else {
        http_response_code(202);
    }