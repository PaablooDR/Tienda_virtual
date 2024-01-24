document.addEventListener("DOMContentLoaded", function() {
    let signUpForm = document.querySelector("form[action='index.php?controller=User&action=checkSignUp']");
    signUpForm.addEventListener("submit", function(event) {

        event.preventDefault();

        if (validateName() && validateSurname() && validateTelephone() && validateAddress() && validatePassword()) {
            signUpForm.submit();
        } else {
            alert("Complete the data correctly");
        }
    });

    function validateName() {
        let nameInput = signUpForm.querySelector("input[name='name']").value;
        let name = nameInput.trim();
        if(name.includes("-") || name.includes("_") || name.includes("/") || name.includes(".") || name.includes(":") || name.includes(",") || name.includes(";") || name.includes("*") || name.includes("?") || name.includes("!") ) {
            return false;
        } else {
            return true;
        }
    }

    function validateSurname() {
        let surnameInput = signUpForm.querySelector("input[name='surname']").value;
        let surname = surnameInput.trim();
        if(surname.includes("-") || surname.includes("_") || surname.includes("/") || surname.includes(".") || surname.includes(":") || surname.includes(",") || surname.includes(";") || surname.includes("*") || surname.includes("?") || surname.includes("!") ) {
            return false;
        } else {
            return true;
        }
    }

    function validateTelephone() {
        let telephoneInput = signUpForm.querySelector("input[name='telephone']").value;
        if(telephoneInput.includes("-") || telephoneInput.includes(".") ) {
            return false;
        } else {
            return true;
        }
    }

    function validateAddress() {
        let addressInput = signUpForm.querySelector("input[name='address']").value;
        let address = addressInput.trim();
        if(address.includes("_") || address.includes(":") || address.includes(";") || address.includes("*") || address.includes("?") || address.includes("!") ) {
            return false;
        } else {
            return true;
        }
    }

    function validatePassword() {
        let passwordInput = signUpForm.querySelector("input[name='password']").value;
        if (passwordInput.length <= 5 || passwordInput.includes(" ")) {
            return false;
        } else {
            return true;
        }
    }
});
