feather.replace();
let loginRequirePassword = true,
  signupRequirePassword = true;
let signupToggle = document.querySelector(".signup-toggle");
let signinToggle = document.querySelector(".signin-toggle");

signupToggle.onclick = function () {
  $("#loginModal").modal("hide");
  setTimeout(() => {
    $("#signupModal").modal("show");
  }, 350);
};
signinToggle.onclick = function () {
  $("#signupModal").modal("hide");
  setTimeout(() => {
    $("#loginModal").modal("show");
  }, 350);
};
// sign in validation
let signinButton = document.querySelector(".btn-submit");

function userFieldsValidation(
  form,
  submitButton,
  emailField,
  passwordField,
  requirePassword,
  passwordToggle,
  passwordCont,
  altCont,
  magicLink,
  modalHeader
) {
  submitButton.onclick = function (e) {
    e.preventDefault();
    if (validateEmail() && validatePassword()) {
        submitButton.innerHTML = '<span class="spinner-grow text-light spinner-grow-sm mr-2"></span> Loading...';
        submitButton.disabled = true;
      form.submit();
    }
  };

  function validateEmail() {
    if (/\S+@\S+\.\S+/.test(emailField.value)) {
      emailField.classList.remove("is-invalid");
      emailField.classList.add("is-valid");
      return true;
    } else {
      emailField.classList.add("is-invalid");
      emailField.classList.remove("is-valid");
      return false;
    }
  }

  function validatePassword() {
    if (!requirePassword) return true;
    else {
      if (/^[A-Za-z0-9!@#\$%\^&\*]{8,100}$/.test(passwordField.value)) {
        passwordField.classList.remove("is-invalid");
        passwordField.classList.add("is-valid");
        return true;
      } else {
        passwordField.classList.add("is-invalid");
        passwordField.classList.remove("is-valid");
        return false;
      }
    }
  }

  emailField.onfocusout = function () {
    validateEmail();
  };

  passwordField.onfocusout = function () {
    validatePassword();
  };


    passwordField.oninput = function () {
        if (/^[A-Za-z0-9!@#\$%\^&\*]{8,100}$/.test(passwordField.value)) {
            passwordField.classList.remove("is-invalid");
            passwordField.classList.add("is-valid");
        }
    };
    emailField.oninput =  () => {
        if (/\S+@\S+\.\S+/.test(emailField.value)) {
            emailField.classList.remove("is-invalid");
            emailField.classList.add("is-valid");
        }
    };
  passwordToggle.onclick = function () {
    passwordCont.classList.add("d-none");
    passwordField.value = '';
    console.log(passwordField.value);
    requirePassword = false;
    altCont.classList.add("d-none");
    magicLink.classList.add("d-none");
    if(form.classList.contains('login'))
        modalHeader.innerHTML = "Just enter your email and we'll send you a magic link to your email to login with. <br/>";
    else
        modalHeader.innerHTML = "Just enter your email to sign up. It's easier and more secure! <br/> You'll receive an email each time you want to login with a magic link that will log you in."

  };
}
//login validation
userFieldsValidation(
  document.querySelector(".login"),
  document.querySelector("#login-button"),
  document.querySelector("#login-email-field"),
  document.querySelector("#login-password-field"),
  loginRequirePassword,
  document.querySelector(".login-with-password"),
  document.querySelector("#login-password-cont"),
  document.querySelector("#login-alt-cont"),
  document.querySelector("#login-magic-link"),
  document.querySelector(".login-modal-header"),
);

//signup validation
userFieldsValidation(
  document.querySelector(".signup"),
  document.querySelector("#signup-button"),
  document.querySelector("#signup-email-field"),
  document.querySelector("#signup-password-field"),
  signupRequirePassword,
  document.querySelector(".signup-with-password"),
  document.querySelector("#signup-password-cont"),
  document.querySelector("#signup-alt-cont"),
  document.querySelector("#signup-magic-link"),
  document.querySelector(".signup-modal-header"),

);


