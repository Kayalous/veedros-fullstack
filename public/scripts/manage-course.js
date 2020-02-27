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
    files: [
        {
            // the server file reference
            source: `${courseImgUrl}`,

        }
    ]
});

function auto_grow(element) {
    element.style.height = "5px";
    element.style.height = (element.scrollHeight)+"px";
}


//Edit about
let courseForm = document.querySelector("#course-management-form");
let editAboutButton = document.querySelector('#edit-about');
let aboutField = document.querySelector('#about');
editAboutButton.onclick = () => {
    let url = `${baseUrl}manage/instructor/course/about`;
    if(aboutField.hasAttribute('readonly')){
        aboutField.removeAttribute('readonly');
        aboutField.focus();
        //This is here so that the cursor goes to the end of the input field on some browsers.
        var val = aboutField.value;
        aboutField.value = ' ';
        aboutField.value = val;

        editAboutButton.innerHTML = '<i data-feather="check"></i> Save';
        editAboutButton.children[0].style.stroke = "#0D984F";
    }
    else {
        editAboutButton.innerHTML = '<span class="spinner-grow text-secondary spinner-grow-sm"></span> Loading...';
        aboutField.setAttribute('readonly', true);
        axios({
            method:'post',
            url:url,
            data:{
                about: aboutField.value,
                slug: slug
            }
        })
        .then(data=>{
            editAboutButton.innerHTML = '<i data-feather="edit"></i> Edit';
            editAboutButton.children[0].style.stroke = "rgba(0,0,0,.7)";
        })
        .catch(err=>{
            editAboutButton.innerHTML = '<i data-feather="x"></i> Error';
            editAboutButton.children[0].style.stroke = "#FF9494";
        })
        .finally(()=>{feather.replace();});
    }
    feather.replace();
}


//Manage objectives

//add new objective

let addObjButton = document.querySelector('#add-obj');
let objContainer = document.querySelector('#obj-container');
let editObjButtons = document.querySelectorAll('.edit-obj');
let editObjFields = document.querySelectorAll('.objective');
let lastObjSubmitted = true;
addObjButton.onclick = () => {
    if(lastObjSubmitted){
        objContainer.innerHTML+=`<li class="row mt-2">
                            <div class="col-10">
                                <h5 class="align-items-center row"><i data-feather="check" class="my-auto col-1 m-0 p-0"></i>
                                    <textarea rows="1" class="objective form-control course-form-field border-light border-radius-sm col-10" placeholder="Type your objective here" oninput="auto_grow(this)"></textarea>
                                </h5>
                            </div>
                            <div>
                                <button
                                        class="btn btn-secondary-veedros btn-secondary-veedros-normal border-medium edit-btn edit-obj" type="button"><i
                                        data-feather="check" style="stroke: #0D984F"></i>
                                    Save</button>
                            </div>
                        </li>`;
        //Update collections
        editObjButtons = document.querySelectorAll('.edit-obj');
        editObjFields = document.querySelectorAll('.objective');
        //focus on last element;
        editObjFields[editObjFields.length-1].focus();
        stageButtonsAndInputsToController(editObjButtons, editObjFields, "hi", "me")
        feather.replace();
    }
    else
    {

    }

}

function stageButtonsAndInputsToController(buttons, fields, url, valueToUpdate){
    for(let i = 0; i < buttons.length; i++){
        let button = buttons[i];
        let field = fields[i];
        button.onclick = () => {
            if(field.hasAttribute('readonly')){
                field.removeAttribute('readonly');
                field.focus();
                //This is here so that the cursor goes to the end of the input field on some browsers.
                var val = field.value;
                field.value = ' ';
                field.value = val;

                button.innerHTML = '<i data-feather="check"></i> Save';
                button.children[0].style.stroke = "#0D984F";
            }
            else {
                button.innerHTML = '<span class="spinner-grow text-secondary spinner-grow-sm"></span> Loading...';
                field.setAttribute('readonly', true);
                axios({
                    method:'post',
                    url:url,
                    data:{
                        valueToUpdate: field.value,
                        slug: slug
                    }
                })
                    .then(data=>{
                        button.innerHTML = '<i data-feather="edit"></i> Edit';
                        button.children[0].style.stroke = "rgba(0,0,0,.7)";
                    })
                    .catch(err=>{
                        button.innerHTML = '<i data-feather="x"></i> Error';
                        button.children[0].style.stroke = "#FF9494";
                    })
                    .finally(()=>{feather.replace();});
            }
            feather.replace();
        }
    }
}

