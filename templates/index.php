<?php
require_once("header.php"); 
?>
<head>
    <title>Posts</title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function post()
    {
        let text = document.getElementById("text").value;
        if(text)
        {
            $.ajax({
                type:   'post',
                url:    '../index.php',
                data:   {
                    user_comm:text
                },
                success:    function (response)
                {
                    document.getElementById("all_comments").innerHTML=response+document.getElementById("all_comments").innerHTML;
                    document.getElementById("text").value="";
                }
            })
        }
        return false;
    }

    function deleteComment(id) {
        if (confirm("Do you want delete this comment?")) {
            $.ajax({
               type:    'post',
                url:    '../index.php',
                data:   'id=' + id,
                success: function (data) {
                   if (data) {
                       $("#comment-" + id).remove();
                   }
                }
            });
        }
    }

    function editComment(id) {
        $.ajax({
            type:   'post',
            url:    '../index.php',
            data:   'id=' + id,
            success: function (data) {

            }
        });
    }

</script>
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
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" id="all_comments">
                <?php foreach ($comments as $comment => $val): ?>
                <div class="col" id="comment-<?php echo $val['id'];?>">
                    <div class="card shadow-sm">

                        <div class="card-body">
                            <p class="card-text"><?php echo $val['comment']; ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <small class="text-muted"><?php echo Comment::getAuthor($val['user_id']); ?></small>
                                </div>
                                <small class="text-muted"><?php echo $val['date']; ?></small>
                                <?php
                                if ($uid["id"] === $val["user_id"])
                                {
                                    $id = $val['id'];
                                    echo "<button type='button' class='btn btn-warning' onclick='editComment($id)'>Edit</button>";
                                    echo "<button type='button' class='btn btn-danger' onclick='deleteComment($id)'>Delete</button>";
                                }
                                ?>
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
