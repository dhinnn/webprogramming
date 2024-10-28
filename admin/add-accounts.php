<?php

include '../includes/head.php'; 
require_once '../classes/account.class.php'; 

$accountObj = new Account();

$firstName = $lastName = $username = $password = '';
$firstNameErr = $lastNameErr = $usernameErr = $passwordErr = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate inputs
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    // Validate first name
    if (empty($firstName)) {
        $firstNameErr = 'First Name is required.';
    }

    // Validate last name
    if (empty($lastName)) {
        $lastNameErr = 'Last Name is required.';
    }

    // Validate username
    if (empty($username)) {
        $usernameErr = 'Username is required.';
    } elseif ($accountObj->usernameExist($username, null)) { // Check if the username already exists
        $usernameErr = 'Username already exists.';
    }

    // Validate password
    if (empty($password)) {
        $passwordErr = 'Password is required.';
    }

    // Check for any validation errors
    if (empty($firstNameErr) && empty($lastNameErr) && empty($usernameErr) && empty($passwordErr)) {
        // If validation passes, attempt to add the account
        $accountObj->first_name = $firstName;
        $accountObj->last_name = $lastName;
        $accountObj->username = $username;
        $accountObj->password = $password; // Set the plain password for hashing in the add method
        
        if ($accountObj->add()) {
            $message = "Account added successfully.";
            // Clear the input fields after successful submission
            $firstName = $lastName = $username = $password = '';
        } else {
            $message = "Failed to add account. Please try again.";
        }
    }
}
?>

<div class="content-page">
    <h2>Add Account</h2>
    <?php if (!empty($message)): ?>
        <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <form action="" method="POST">
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" value="<?php echo htmlspecialchars($firstName); ?>" required class="form-control">
            <?php if (!empty($firstNameErr)): ?>
                <div class="text-danger"><?php echo htmlspecialchars($firstNameErr); ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" value="<?php echo htmlspecialchars($lastName); ?>" required class="form-control">
            <?php if (!empty($lastNameErr)): ?>
                <div class="text-danger"><?php echo htmlspecialchars($lastNameErr); ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($username); ?>" required class="form-control">
            <?php if (!empty($usernameErr)): ?>
                <div class="text-danger"><?php echo htmlspecialchars($usernameErr); ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required class="form-control">
            <?php if (!empty($passwordErr)): ?>
                <div class="text-danger"><?php echo htmlspecialchars($passwordErr); ?></div>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Add Account</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
