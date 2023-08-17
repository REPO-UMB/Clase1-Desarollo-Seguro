function validateLoginForm() {
    var emailField = document.forms["loginform"]["email"];
    var passwordField = document.forms["loginform"]["password"];

    if (emailField.value === "" || passwordField.value === "") {
        alert("Debe llenar todos los campos");
        return false;
    }

    if (passwordField.value.length < 6) {
        alert("La contraseña debe ser de minimo 6 caracteres");
        return false;
    }
    
    return true;
}

function validateRegisterForm() {
    var fullNameField = document.forms["registerform"]["full_name"];
    var emailField = document.forms["registerform"]["email"];
    var usernameField = document.forms["registerform"]["username"];
    var passwordField = document.forms["registerform"]["password"];
    var tycCheckbox = document.forms["registerform"]["tyc"];
    if (fullNameField.value === "" || emailField.value === "" || usernameField.value === "" || passwordField.value === "") {
        alert("All fields must be filled out.");
        return false;
    }
    if (!/^[A-Za-z\s]+$/.test(fullNameField.value)) {
        alert("Invalid name format.");
        return false;
    }
    if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(emailField.value)) {
        alert("Invalid email format.");
        return false;
    }
    if (!/^[A-Za-z0-9]+$/.test(usernameField.value)) {
        alert("Invalid username format.");
        return false;
    }
    if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/.test(passwordField.value)) {
        alert("Password must contain at least one uppercase letter, one lowercase letter, one digit, one special character, and be at least 6 characters long.");
        return false;
    }
    if (!tycCheckbox.checked) {
        alert("You must accept the terms and conditions.");
        return false;
    }
    return true;
}

