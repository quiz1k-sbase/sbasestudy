<?php
require_once("header.php"); 
?>
<body class="bg-light">
<main>

    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Posts:</h1>
                <p class="lead text-muted">If you want add post - click on the button and do it!</p>
                <p>
                    <a href="../addPost.php" class="btn btn-primary my-2">Add post</a>
                    <a href="../logout.php" class="btn btn-danger">Logout</a>
                </p>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($comments as $comment => $val): ?>
                <div class="col">
                    <div class="card shadow-sm">

                        <div class="card-body">
                            <p class="card-text"><?php echo $val['comment']; ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <small class="text-muted"><?php echo $val['username']; ?></small>
                                </div>
                                <small class="text-muted"><?php echo $val['date']; ?></small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</main>
</body>
</html>
