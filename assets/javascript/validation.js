function validateForm() {
    var email = document.forms["userForm"]["email"].value;
    var name = document.forms["userForm"]["name"].value;
    if (email == "" || name=="") {
        alert("Необходимо заполнить все поля");
        return false;
    }
}