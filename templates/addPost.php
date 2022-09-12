<?php
require_once("header.php"); 
?>
<head>
<title>Add Post</title>
</head>
<body class="bg-light">
<div class="container-xxl center-page">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <form method="post">
                <label class="form-label">Input your post:</label><br>
                <textarea class="form-control" type="text" name="text" rows="3"></textarea><br>
                <button class="btn btn-outline-primary w-100" type="submit">Add</button>
            </form>
            <div class="col-md-12 d-flex justify-content-center">
                <a class="link-primary" href="../index.php">Back to all posts</a>
            </div>
        </div>
    </div>
</body>
</html>