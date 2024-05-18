window.onload = function() {
    document.getElementById("uname_input").addEventListener("input", validateUsername);
    document.getElementById("pass_input").addEventListener("input", validatePassword);
};

function validateUsername() {
    var username = document.getElementById("uname_input").value;
    var errorDiv = document.getElementById("usernameError");

    if (username === "") {
        errorDiv.innerHTML = "Please enter a username";
        return false;
    } else {
        errorDiv.innerHTML = "";
        return true;
    }
}

function validatePassword() {
    var password = document.getElementById("pass_input").value;
    var errorDiv = document.getElementById("passwordError");

    if (password === "") {
        errorDiv.innerHTML = "Please enter a password";
        return false;
    } else if (password.length < 8) {
        errorDiv.innerHTML = "Password must be at least 8 characters long";
        return false;
    } else {
        errorDiv.innerHTML = "";
        return true;
    }
}

function validateForm() {
    return validateUsername() && validatePassword();
}