<?php

include '../includes/head.php'; 
require_once '../classes/account.class.php'; 


$accountObj = new Account();


$accounts = $accountObj->fetchAllAccounts(); 

?>

<div class="content-page">
    <h2>Accounts</h2>
    
   
    <a href="../account/add-account.php" class="btn btn-primary">Add Account</a>
    
    <div class="table-responsive">
        <table id="table-accounts" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($accounts as $account): ?>
                <tr>
                    <td><?php echo htmlspecialchars($account['id']); ?></td>
                    <td><?php echo htmlspecialchars($account['username']); ?></td>
                    <td><?php echo htmlspecialchars($account['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($account['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($account['username']); ?></td>
                    <td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; 

?>
