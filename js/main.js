function checkForm() {
    let x = document.forms["registerForm"]["phone"].value;
    let phone = "^(0\d{9})$";
    if (x != phone) {
        return "Wrong number"
    }
}

function deleteComment(id) {
    if (confirm("Do you want delete this comment?")) {
        $.ajax({
            type:    'post',
            url:    '../index.php',
            data:   'comm_id=' + id,
            success: function (data) {
                if (data) {
                    $("#comment-" + id).remove();
                }
            }
        });
    }
}

function deletePost(id) {
    if (confirm("Do you want delete this comment?")) {
        $.ajax({
            type:    'post',
            url:    '../index.php',
            data:   'id=' + id,
            success: function (data) {
                if (data) {
                    $("#post-" + id).remove();
                }
            }
        });
    }
}

let globalId;

function getId(id) {
    globalId = id;
}

function addPost() {
    let text = document.getElementById("text").value;
    $.ajax({
       type: 'post',
       url: '../sendPostData.php',
       data: {
           text: text
       },
        success: function (data) {
           document.getElementById("text").value = '';
           let x = JSON.parse(data);
           let test = $("#all_comments").html();
            $("#all_comments").html('<div class="col" id="post-' + x.id + '">' +
                '<div class="card shadow-sm"><div class="card-body">' +
                '<p class="card-text">'+ text +'</p>' +
                '<div class="d-flex justify-content-between align-items-center">' +
                '<div class="btn-group">' +
                '<small class="text-muted">'+ x.uName +'</small>' +
                '</div>' +
                '<small className="text-muted">'+ x.pDate +'</small>' +
                '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="getId('+ x.id +')">\n' +
                'Add comment' +
                '</button>' +
                '<button type=\'button\' class=\'btn btn-warning\' onclick=\'editComment('+ x.id +')\'>Edit</button>' +
                '<button type=\'button\' class=\'btn btn-danger\' onclick=\'deletePost('+ x.id +')\'>Delete</button>' +
                '</div>' +
                '<div class="container g-3" id="commentsContainer-'+ x.id +'">' +
                '</div></div></div></div> ' + test)
        }
    });
}

function addComment() {
    let comment = document.getElementById("comment").value;
    let cDate = document.getElementById("cDate").value;
    let id = globalId;
    $.ajax({
        type: 'post',
        url: '../sendCommentData.php',
        data: {
            post_id: id,
            comment: comment,
            cDate: cDate
        },
        success: function (data) {
            document.getElementById("comment").value = "";
            document.getElementById("closeModal").click();
            let test = $("#commentsContainer-" + id).html();
            let x = JSON.parse(data);
            $("#commentsContainer-" + id).html('<div class="card w-50 mt-2" id="comment-' + x.id + '">' +
                '<div class="card-body" id="commentBody">' +
                '<p class="card-text" id="comment-text">' + comment + '</p>' +
                '<small class="text-muted">' + x.username + '</small> ' +
                '<small class="text-muted">' + cDate + '</small>' +
                '<button type=\'button\' class=\'btn btn-warning\' onclick=\'editComment(' + x.id + ')\'>Edit</button>' +
                '<button type=\'button\' class=\'btn btn-danger\' onclick=\'deleteComment(' + x.id + ')\'>Delete</button>' +
                '</div></div>' + test);

        }
    });
}

function editComment() {
    let editedComment = document.getElementById("editedComment").value;
    let id = globalId;
    $.ajax({
        type: 'post',
        url: '../editComment.php',
        data: {
            edit: true,
            editId: id,
            editText: editedComment
        },
        success: function (data) {
            document.getElementById("editedComment").value = "";
            document.getElementById("closeEdit").click();
            document.getElementById("comment-text").innerHTML = editedComment;
    }
    });
}