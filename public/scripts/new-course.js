
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
        imagePreviewHeight: 440,
        imageCropAspectRatio: '1:1',
        imageResizeTargetWidth: 330,
        imageResizeTargetHeight: 440,
        styleLoadIndicatorPosition: 'bottom',
        styleButtonRemoveItemPosition: 'bottom',
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
    },
});

const pond = document.querySelector('.filepond');
pond.addEventListener('FilePond:processfile', e => {
    submitButton.disabled = false;
});
pond.addEventListener('FilePond:removefile', e => {
    submitButton.disabled = true;
});


//input validation
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
    if(/^[0-9]{1,6}$/.test(field.value)){
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
    namef = document.querySelector("#name");
    price = document.querySelector("#price");
    about = document.querySelector("#description");
    if (
        validateTextFields(namef) &&
        validateNumberField(price) &&
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
            inputFields[i].onfocusout = function () {
                validateTextFields(inputFields[i]);
            };
            break;
        case 'price':
            inputFields[i].onfocusout = function () {
                validateNumberField(inputFields[i]);
            };
            break;
        case 'description':
            inputFields[i].onfocusout = function () {
                validateTextArea(inputFields[i]);
            };
            break;
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
