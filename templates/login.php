<?php
require_once("header.php"); 
?>
<head>
    <title>Login</title>
</head>
<body class="bg-light">
    <div class="container-xxl center-page">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <?php foreach ($errors as $error) :?>
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                        <div><?php echo $error;?></div>
                    </div>
                <?php endforeach; ?>
                <form method="post">
                    <label class="form-label">Email:</label><br>
                    <input class="form-control" type="text" name="email"><br>
                    <label class="form-label">Password:</label><br>
                    <input class="form-control" type="password" name="password"><br>
                    <input class="form-check-input" type="checkbox" name="remember">
                    <label class="form-check-label">Remember me</label>
                    <button class="btn btn-outline-primary w-100" type="submit">Log in</button>
                </form>
                <div class="col-md-12 d-flex justify-content-center">
                    <a class="link-primary" href="registration.php">Registration</a>
                </div>
            </div>
        </div>
</body>
</html>