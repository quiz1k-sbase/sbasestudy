function checkForm() {
    let x = document.forms["registerForm"]["phone"].value;
    let phone = "^(0\d{9})$";
    if (x != phone) {
        return "Wrong number"
    }
}


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
        });
    }
    return false;
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

function editComment(id) {
    $.ajax({
        type:   'post',
        url:    '../index.php',
        data:   'id=' + id,
        success: function (data) {

        }
    });
}

let globalId;

function getId(id) {
    globalId = id;
}

function addComment() {
    let comment = document.getElementById("comment").value;
    let uName = document.getElementById("uName").value;
    let cDate = document.getElementById("cDate").value;
    let id = globalId;
    $.ajax({
        type:    'post',
        url:     'index.php',
        data:   {
            post_id: id,
            comment: comment,
            uName: uName,
            cDate: cDate
        },
        success: function (data) {
            document.getElementById("comment").value="";
            document.getElementById("closeModal").click();
            let test = $("#commentsContainer-" + id).html();
            console.log(data);
            $("#commentsContainer-" + id).html('<div class="card w-50 mt-2" id="comment">' +
                 '<div class="card-body" id="commentBody">' +
                     '<p class="card-text" id="comment-text">' + comment + '</p>' +
                    '<small class="text-muted">' + uName + '</small>' +
                    '<small class="text-muted">' + cDate + '</small>' +
                 '</div></div>' + test);

        }
    });
}


function popUpAddComment() {

}