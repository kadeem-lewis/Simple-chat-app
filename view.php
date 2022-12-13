<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Chat App</title>
    <link rel="stylesheet" href="scss/main.css">
    <script src="js/app.js"></script>
</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <header>
                <h3 class="username"><?php
                                        if (isset($_SESSION['logged_in'])) {
                                        } else {
                                            echo "User";
                                        }
                                        ?></h3>
                <?php
                if (isset($_SESSION['logged_in'])) {
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
                <textarea name="chatter" id="chatter"></textarea>
            </div>
            <div class="chat-box"></div>
            <div class="message-box">
                <textarea name="send-message" id="send-message"></textarea>
                <button type="submit">hey</button>
            </div>
        </main>
    </div>
    <div id="login-form">
        <span class="close-login" onclick="hideLoginModal()"></span>
        <h2>Login Form</h2>
        <form>
            <label for="user-name">Name: </label>
            <input type="text" name="user-name" id="user-name">
            <label for="user-password">Password: </label>
            <input type="password" name="user-password" id="user-password">
            <input type="submit" name="Submit" value="Submit">
        </form>
    </div>
</body>

</html>