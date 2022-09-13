function checkForm() {
    let x = document.forms["registerForm"]["phone"].value;
    let phone = "^(0\d{9})$";
    if (x != phone) {
        return "Wrong number"
    }
}

function popUpAddComment() {

}