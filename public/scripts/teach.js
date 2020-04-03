$(".owl-carousel").owlCarousel({
    rewind: true,
    margin: 10,
    autoplay: true,
    autoplayTimeout: 4000,
    nav: true,
    dotsEach: true,
    dots: true,
    responsive: {
        1200: {
            items: 2
        },
        992: {
            items: 1
        },
        768: {
            items: 1
        },
        0: {
            items: 1
        }
    },
    autoplayHoverPause: true
});



FilePond.parse(document.body);
// We register the plugins required to do
// image previews, cropping, resizing, etc.
FilePond.registerPlugin(
    FilePondPluginFileValidateType,
    FilePondPluginFileValidateSize
);



// Select the file input and use
// create() to turn it into a pond
FilePond.create(
    document.querySelector('.filepond'),
    {
        labelIdle: `Drag & Drop your CV or <span class="filepond--label-action">Browse</span>`,
        styleButtonRemoveItemPosition: 'center',
        acceptedFileTypes: ['application/pdf'],
        allowFileSizeValidation:true,
        maxFileSize: '5MB',

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

inputFields = document.querySelectorAll('.form-control');
for(let i = 0; i < inputFields.length; i++){
    switch (inputFields[i].id) {
        case 'name':
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
        case 'body':
            inputFields[i].onfocusout = function () {
                validateTextArea(inputFields[i]);
            };
            break;
    }
}
function validateEmail(emailField) {
    if (/^\S+@\S+\.\S+$/.test(emailField.value)) {
        fieldIsValid(emailField);
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
    else
    {
        fieldIsInvalid(field);
        return false;
    }
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
    let namef = document.querySelector("#name");
    let numberf = document.querySelector("#phone");
    let email = document.querySelector("#email");
    let about = document.querySelector("#body");
    if (
        validateTextFields(namef) &&
        validateNumberField(numberf) &&
        validateEmail(email) &&
        validateTextArea(about)) {
        return true;
    } else {
        return false;
    }
}

submitButton = document.querySelector('#btnsubmit');
form = document.querySelector('#form');
submitButton.onclick = function (e) {
    e.preventDefault();
    if (validateInputs()) {
        form.submit();
    }
};
