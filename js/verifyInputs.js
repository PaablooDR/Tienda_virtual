document.addEventListener("DOMContentLoaded", function () {
    let signUpForm = document.querySelector("form");
    signUpForm.addEventListener("submit", function (event) {
        event.preventDefault();

        let isValid = true;

        if (!validateName()) isValid = false;
        if (!validateSurname()) isValid = false;
        if (!validateTelephone()) isValid = false;
        if (!validateAddress()) isValid = false;
        if (!validatePassword()) isValid = false;
        if (!validateDni()) isValid = false;

        if (isValid) {
            signUpForm.submit();
        } else {
            alert("Complete the data correctly");
        }
    });

    function validateName() {
        let nameInput = signUpForm.querySelector("input[name='name']");
        let nameInputValue = nameInput.value.trim();

        if (nameInputValue.includes("-") || nameInputValue.includes("_") || nameInputValue.includes("/") || nameInputValue.includes(".") || nameInputValue.includes(":") || nameInputValue.includes(",") || nameInputValue.includes(";") || nameInputValue.includes("*") || nameInputValue.includes("?") || nameInputValue.includes("!")) {
            nameInput.classList.add('invalid');
            return false;
        } else {
            nameInput.classList.remove('invalid');
            return true;
        }
    }

    function validateSurname() {
        let surnameInput = signUpForm.querySelector("input[name='surname']");
        let surnameInputValue = surnameInput.value.trim();

        if (surnameInputValue.includes("-") || surnameInputValue.includes("_") || surnameInputValue.includes("/") || surnameInputValue.includes(".") || surnameInputValue.includes(":") || surnameInputValue.includes(",") || surnameInputValue.includes(";") || surnameInputValue.includes("*") || surnameInputValue.includes("?") || surnameInputValue.includes("!")) {
            surnameInput.classList.add('invalid');
            return false;
        } else {
            surnameInput.classList.remove('invalid');
            return true;
        }
    }

    function validateTelephone() {
        let telephoneInput = signUpForm.querySelector("input[name='telephone']");
        let telephoneInputValue = telephoneInput.value;

        if (telephoneInputValue.includes("-") || telephoneInputValue.includes(".")) {
            telephoneInput.classList.add('invalid');
            return false;
        } else {
            telephoneInput.classList.remove('invalid');
            return true;
        }
    }

    function validateAddress() {
        let addressInput = signUpForm.querySelector("input[name='address']");
        let addressInputValue = addressInput.value.trim();

        if (addressInputValue.includes("_") || addressInputValue.includes(":") || addressInputValue.includes(";") || addressInputValue.includes("*") || addressInputValue.includes("?") || addressInputValue.includes("!")) {
            addressInput.classList.add('invalid');
            return false;
        } else {
            addressInput.classList.remove('invalid');
            return true;
        }
    }

    function validatePassword() {
        let passwordInput = signUpForm.querySelector("input[name='password']");
        let passwordInputValue = passwordInput.value;

        if (passwordInputValue.length <= 5 || passwordInputValue.includes(" ")) {
            passwordInput.classList.add('invalid');
            return false;
        } else {
            passwordInput.classList.remove('invalid');
            return true;
        }
    }

    function validateDni() {
        let dniInput = signUpForm.querySelector("input[name='dni']");
        let dniInputValue = dniInput.value.trim();

        if (dniInputValue.includes("-") || dniInputValue.includes("_") || dniInputValue.includes("/") || dniInputValue.includes(".") || dniInputValue.includes(":") || dniInputValue.includes(",") || dniInputValue.includes(";") || dniInputValue.includes("*") || dniInputValue.includes("?") || dniInputValue.includes("!")) {
            dniInput.classList.add('invalid');
            return false;
        } else {
            if(comprobationDni(dniInputValue)) {
                dniInput.classList.remove('invalid');
                return true;
            } else {
                dniInput.classList.add('invalid');
                return false;
            }
            
        }
    }

    function comprobationDni(dni) {
        let letters = 'TRWAGMYFPDXBNJZSQVHLCKE';
        let number = dni.substring(0, 8);
        if (/^\d+$/.test(number)) {
            let remainder = parseInt(number) % 23;
            if (dni.charAt(8).toUpperCase() === letters.charAt(remainder)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
});
