feather.replace();
let loginRequirePassword = false,
  signupRequirePassword = false;
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
  magicLink
) {
  submitButton.onclick = function (e) {
    e.preventDefault();
    if (validateEmail() && validatePassword()) {
        submitButton.innerHTML = '<span class="spinner-grow text-light spinner-grow-sm"></span>';
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
  passwordToggle.onclick = function () {
    passwordCont.classList.remove("d-none");
    requirePassword = true;
    altCont.classList.remove("d-none");
    magicLink.classList.add("d-none");
  };
    $(".btn-veedros-inline-input").click(function () {
        let landingInput = $(this)
            .parent()
            .siblings(".email-input")
            .val();
        $("#signup-email-field").val(landingInput);

        if (/\S+@\S+\.\S+/.test(landingInput)){
            document.querySelector(".signup").submit();
            document.querySelector(".btn-veedros-inline-input").innerHTML = '<span class="spinner-grow text-light spinner-grow-sm mr-2"></span> Loading...';
            document.querySelector(".btn-veedros-inline-input").disabled = true;
        }
        else{
            validateEmail()
            $('#signupModal').modal('show')
        }
    });
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
  document.querySelector("#login-magic-link")
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
  document.querySelector("#signup-magic-link")
);


