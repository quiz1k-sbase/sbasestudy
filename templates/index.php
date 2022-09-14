<?php
require_once("header.php"); 
?>
<head>
    <title>Posts</title>
</head>
<script src="../js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<body class="bg-light">
<main>

    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Posts:</h1>
                <form method="post">
                    <label class="form-label">Input your post:</label><br>
                    <textarea class="form-control" type="text" name="text" rows="3" id="text"></textarea><br>
                    <button class="btn btn-outline-primary w-100" type="submit">Add</button>
                </form>
                <p class="mt-2">
                    <a href="../logout.php" class="btn btn-danger">Logout</a>
                </p>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 g-3" id="all_comments">
                <?php foreach ($posts as $post => $val): ?>
                    <div class="col" id="post-<?php echo $val['id'];?>">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <p class="card-text"><?php echo $val['text']; ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <small class="text-muted"><?php echo Post::getAuthor($val['user_id']); ?></small>
                                    </div>
                                    <small class="text-muted"><?php echo $val['date']; ?></small>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="getId(<?php echo $val['id'];?>)">
                                        Add comment
                                    </button>
                                    <?php
                                    if ($uid["id"] === $val["user_id"])
                                    {
                                        $id = $val['id'];
                                        echo "<button type='button' class='btn btn-warning' onclick='editComment($id)'>Edit</button>";
                                        echo "<button type='button' class='btn btn-danger' onclick='deletePost($id)'>Delete</button>";
                                    }
                                    ?>
                                </div>
                                <div class="container g-3" id="commentsContainer-<?php echo $val['id'];?>">
                                <?php foreach ($comments as $comment => $comVal): ?>
                                    <?php if ($val['id'] === $comVal['post_id']): ?>
                                        <div class="card w-50 mt-2" id="comment-<?php echo $comVal['id']; ?>">
                                            <div class="card-body" id="commentBody">
                                                <p class="card-text" id="comment-text"><?php echo $comVal['comment']; ?></p>
                                                <small class="text-muted"><?php echo Comment::getAuthor($comVal['user_id']); ?></small>
                                                <small class="text-muted"><?php echo Comment::getDate($comVal['id']); ?></small>
                                                <?php
                                                    if ($uid["id"] === $comVal["user_id"])
                                                    {
                                                    $id = $comVal['id'];
                                                    echo "<button type='button' class='btn btn-warning' onclick='editComment($id)'>Edit</button>";
                                                    echo "<button type='button' class='btn btn-danger' onclick='deleteComment($id)'>Delete</button>";
                                                    }
                                                ?>
                                                <input class="d-none" id="uName" value="<?php echo Comment::getAuthor($comVal['user_id'])?>">
                                                <input class="d-none" id="cDate" value="<?php echo Comment::getDate($comVal['id'])?>">
                                            </div>
                                        </div>
                                    <?php endif ?>
                                <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add comment</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <label class="form-label">Input your comment:</label><br>
                                            <textarea class="form-control" type="text" name="comment" rows="3" id="comment"></textarea><br>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeModal">Close</button>
                                            <button type="submit" class="btn btn-primary" onclick="addComment()">Add</button>
                                        </div>
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
