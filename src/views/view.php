<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Chat App</title>
    <link rel="stylesheet" href="../../public/scss/main.css">
    <script defer src="../../public/js/app.js"></script>
</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <header>
                <h3 class="username-display">
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo "{$_SESSION["username"]}";
                    } else {
                        echo "User";
                    }
                    ?>
                </h3>
                <?php
                if (isset($_SESSION['username'])) {
                    echo "<p class='logout'>Log Out</p>";
                } else {
                    echo "<p class='login' onclick='showLoginModal()'>Login</p>";
                }
                ?>
            </header>
            <div>
                <h4 class="users-header">Users</h4>
                <ul class="names">
                    <?php
                    $rows = get_users($conn);
                    foreach ($rows as $row) {
                        echo "<li class='user'>" . $row['name'] . "</li>";
                    }
                    ?>
                </ul>
            </div>
        </aside>
        <main>
            <div class="chat-box-header">
                <select name="recipients" id="recipients">
                    <?php
                    if (isset($_SESSION['username'])) {
                        $rows = get_users($conn);
                        foreach ($rows as $row) {
                            if ($row['name'] != $_SESSION['username']) {
                                echo "<option class='recipient'>" . $row['name'] . "</option>";
                            }
                        }
                    } else {
                        echo "<option> Users </option>";
                    }
                    ?>
                </select>
            </div>
            <div class="chat-box"></div>
            <div class="message-box">
                <textarea name="send-message" id="send-message"></textarea>
                <button type="submit" class="submit-message">Send</button>
            </div>
        </main>
    </div>
    <div id="login-form-container">
        <span class="close-login"></span>
        <h2>Login Form</h2>
        <?php
        if (!empty($error_message)) {
            echo "<div class='error-messages'>
            <p> $error_message</p>
            </div>";
        } else if (!empty($success_message)) {
            echo "<div class='success-messages'>
            <p> $success_message</p>
            </div>";
        }
        ?>
        <form id="login-form" method="POST">
            <label for="user-name">Name: </label>
            <input type="text" name="user-name" id="user-name">
            <label for="user-password">Password: </label>
            <input type="password" name="user-password" id="user-password">
            <input type="submit" class="submit-btn" name="Submit" value="Submit">
        </form>
    </div>
</body>

</html>