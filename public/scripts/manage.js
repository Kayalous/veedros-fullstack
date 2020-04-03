
FilePond.parse(document.body);
// We register the plugins required to do
// image previews, cropping, resizing, etc.
FilePond.registerPlugin(
    FilePondPluginFileValidateType,
    FilePondPluginImageExifOrientation,
    FilePondPluginImagePreview,
    FilePondPluginImageCrop,
    FilePondPluginImageResize,
    FilePondPluginImageTransform,
    FilePondPluginFilePoster
);



// Select the file input and use
// create() to turn it into a pond
FilePond.create(
    document.querySelector('.filepond'),
    {
        labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
        imagePreviewHeight: 170,
        imageCropAspectRatio: '1:1',
        imageResizeTargetWidth: 300,
        imageResizeTargetHeight: 300,
        styleLoadIndicatorPosition: 'bottom',
        styleButtonRemoveItemPosition: 'bottom',
        stylePanelLayout: 'compact circle',
        acceptedFileTypes: ['image/*'],

    }
);

FilePond.setOptions({
    server: {
        url: '/filepond/api',
        process: '/process',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    }
});




//input validation
password = document.querySelector("#password");
passwordRepeat = document.querySelector("#password-repeat");

function validateEmail(emailField) {
    if (/^\S+@\S+\.\S+$/.test(emailField.value)) {
        fieldIsValid(emailField);
        return true;
    }
    else if (emailField.value.length === 0) {
        fieldIsNeutral(emailField)
        return true;
    }
    else {
            fieldIsInvalid(emailField)
            return false;
    }
}

function validateTextFields(field) {
    if(/^[\S\s]{1,100}$/.test(field.value)){
        fieldIsValid(field);
        return true;
    }
    else if (field.value.length === 0) {
        fieldIsNeutral(field)
        return true;
    }
    else
    {
        fieldIsInvalid(field);
        return false;
    }
}
function validateTextArea(field) {
    if(/^[\S\s]{1,500}$/.test(field.value)){
        fieldIsValid(field);
        return true;
    }
    else if (field.value.length === 0) {
        fieldIsNeutral(field)
        return true;
    }
    else
    {
        fieldIsInvalid(field);
        return false;
    }
}
function validateNumberField(field) {
    if(/^(\+?)[0-9]{8,15}$/.test(field.value)){
        fieldIsValid(field);
        return true;
    }
    else if (field.value.length === 0) {
        fieldIsNeutral(field)
        return true;
    }
    else
    {
        fieldIsInvalid(field);
        return false;
    }
}

function validatePassword(passwordField, passwordRepeat) {
        if (/^[A-Za-z0-9!@#\$%\^&\*]{8,100}$/.test(passwordField.value)) {
            fieldIsValid(passwordField);
            fieldIsInvalid(passwordRepeat);
            if(passwordRepeat.value === passwordField.value){
                fieldIsValid(passwordRepeat);
                return true;
            }
            return false;
        }
        else if (passwordField.value.length === 0 && passwordRepeat.value.length === 0) {
            fieldIsNeutral(passwordField);
            fieldIsNeutral(passwordRepeat);
        }
        else {
            fieldIsInvalid(passwordField);
            fieldIsInvalid(passwordRepeat);
            return false;
        }
    if (passwordField.value != passwordRepeat.value) {
        fieldIsInvalid(passwordRepeat);
        return false;
    }
        return true;

}
function fieldIsValid(field){
    field.classList.remove("is-invalid");
    field.classList.add("is-valid");
}
function fieldIsInvalid(field){
    field.classList.add("is-invalid");
    field.classList.remove("is-valid");
}
function fieldIsNeutral(field){
    field.classList.remove("is-invalid");
    field.classList.remove("is-valid");
}
function validateInputs() {
    namef = document.querySelector("#name");
    numberf = document.querySelector("#phone");
    email = document.querySelector("#email");
    about = document.querySelector("#about");
    position = document.querySelector("#position");
    locationf = document.querySelector("#location");
    if (
        validateTextFields(namef) &&
        validateNumberField(numberf) &&
        validateEmail(email) &&
        validatePassword(password, passwordRepeat) &&
        validateTextFields(position) &&
        validateTextFields(locationf) &&
        validateTextArea(about)) {
        return true;
    } else {
        return false;
    }
}
inputFields = document.querySelectorAll('.form-control');
for(let i = 0; i < inputFields.length; i++){
    switch (inputFields[i].id) {
        case 'name':
        case 'position':
        case 'location':
        case 'twitter':
        case 'linkedin':
        case 'facebook':
            inputFields[i].onfocusout = function () {
                validateTextFields(inputFields[i]);
            };
            break;
        case 'phone':
            inputFields[i].onfocusout = function () {
                validateNumberField(inputFields[i]);
            };
            break;
        case 'email':
            inputFields[i].onfocusout = function () {
                validateEmail(inputFields[i]);
            };
            break;
        case 'about':
            inputFields[i].onfocusout = function () {
                validateTextArea(inputFields[i]);
            };
            break;
    }
}

password.onfocusout = function () {
    validatePassword(password,passwordRepeat);
};

passwordRepeat.onfocusout = function () {
    validatePassword(password,passwordRepeat);
};

submitButton = document.querySelector('#btnsubmit');
form = document.querySelector('#form');
submitButton.onclick = function (e) {
    e.preventDefault();
    if (validateInputs()) {
        form.submit();
    }
};
showPasswordButton = document.querySelector('#show-password-btn');
showPasswordButton.onclick = function (e) {
    if (password.type === "password") {
        password.type = "text";
        password.placeholder = "password";
        passwordRepeat.type = "text";
        passwordRepeat.placeholder = "password";
        showPasswordButton.style.color = "#28a745";
        showPasswordButton.innerHTML = '<i data-feather="eye"></i>';

    } else {
        password.type = "password";
        password.placeholder = "● ● ● ● ● ● ● ●";
        passwordRepeat.type = "password";
        passwordRepeat.placeholder = "● ● ● ● ● ● ● ●";
        showPasswordButton.style.color = "#c1272d";
        showPasswordButton.classList.remove("eye");
        showPasswordButton.innerHTML = '<i data-feather="eye-off"></i>';

    }
    feather.replace();

};

let aboutField = document.querySelector("#about");
aboutField.oninput = () => {
document.querySelector('#about-counter').innerHTML = aboutField.value.length;
}

