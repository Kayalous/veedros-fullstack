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
    }
});

const pond = document.querySelector('.filepond--root');

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
        editAboutButton.disabled = true;

        axios({
            method:'post',
            url:url,
            data:{
                about: aboutField.value,
                slug: slug
            }
        })
        .then(data=>{
            showSuccessMessage(data.data);
            editAboutButton.innerHTML = '<i data-feather="edit"></i> Edit';
            editAboutButton.children[0].style.stroke = "rgba(0,0,0,.7)";
        })
        .catch(err=>{
            showFailureMessage('Error updating about. Try again.');

            editAboutButton.innerHTML = '<i data-feather="x"></i> Error';
            editAboutButton.children[0].style.stroke = "#FF9494";
        })
        .finally(()=>{
            feather.replace();
            editAboutButton.disabled = false;
        });
    }
    feather.replace();
}


//Edit price
let editPriceButton = document.querySelector('#edit-price');
let priceField = document.querySelector('#price');
editPriceButton.onclick = () => {
    let priceUrl = `${baseUrl}manage/instructor/course/price`;
    if(priceField.hasAttribute('readonly')){
        priceField.removeAttribute('readonly');
        priceField.focus();
        //This is here so that the cursor goes to the end of the input field on some browsers.
        var val = priceField.value;
        priceField.value = '';
        priceField.value = val;

        editPriceButton.innerHTML = '<i data-feather="check"></i>';
        editPriceButton.children[0].style.stroke = "#0D984F";
    }
    else {
        editPriceButton.innerHTML = '<span class="spinner-grow text-secondary spinner-grow-sm"></span>';
        priceField.setAttribute('readonly', true);
        editPriceButton.disabled = true;

        axios({
            method:'post',
            url:priceUrl,
            data:{
                price: priceField.value,
                slug: slug
            }
        })
            .then(data=>{
                showSuccessMessage(data.data);
                editPriceButton.innerHTML = '<i data-feather="edit"></i>';
                editPriceButton.children[0].style.stroke = "rgba(0,0,0,.7)";
            })
            .catch(err=>{
                showFailureMessage('Error updating course price. Try again.');

                editPriceButton.innerHTML = '<i data-feather="x"></i>';
                editPriceButton.children[0].style.stroke = "#FF9494";
            })
            .finally(()=>{
                feather.replace();
                editPriceButton.disabled = false;
            });
    }
    feather.replace();
}

//Edit img
let editImgButton = document.querySelector('#edit-img');
let imgField = document.querySelector('#img');
let imgCancel = document.querySelector('#img-cancel');
let imgSubmit = document.querySelector('#img-submit');
let imgForm = document.querySelector('#img-form');

editImgButton.onclick = () => {
    editImgButton.classList.add('d-none')
    imgField.classList.remove('d-none');
}
imgCancel.onclick = () => {
    imgField.classList.add('d-none')
    editImgButton.classList.remove('d-none');
}


//Manage objectives
let addObjButton = document.querySelector('#add-obj');
let objContainer = document.querySelector('#obj-container');
let editObjButtons = document.querySelectorAll('.edit-obj');
let editObjFields = document.querySelectorAll('.objective');
let objectiveUrl = `${baseUrl}manage/instructor/course/objective`;
stageButtonsAndInputsToController(editObjButtons, editObjFields, objectiveUrl, "objective")
let lastObjSubmitted = true;
addObjButton.onclick = () => {
    if(lastObjSubmitted){
        //Update container
        objContainer = document.querySelector('#obj-container');
        //Insert new row into obj container
        objContainer.innerHTML+=`<li class="row mt-2">
                            <div class="col-10">
                                <h5 class="align-items-center row"><i data-feather="check" class="my-auto col-1 m-0 p-0"></i>
                                    <textarea rows="1" class="objective form-control course-form-field border-light border-radius-sm col-10" placeholder="Type your objective here" oninput="auto_grow(this)" id="new"></textarea>
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
        stageButtonsAndInputsToController(editObjButtons, editObjFields, objectiveUrl, "objective")
        addObjButton.disabled = true;
        lastObjSubmitted = false;
        feather.replace();
    }
    else
    {
        showAlertMessage('You need to submit the last objective before adding a new one.')
    }

}


//Manage recommendations
let addRecButton = document.querySelector('#add-rec');
let recContainer = document.querySelector('#obj-container');
let editRecButtons = document.querySelectorAll('.edit-rec');
let editRecFields = document.querySelectorAll('.rec');
let recommendationUrl = `${baseUrl}manage/instructor/course/recommendation`;
stageButtonsAndInputsToController(editRecButtons, editRecFields, recommendationUrl, "recommendation")
let lastRecSubmitted = true;
addRecButton.onclick = () => {
    if(lastRecSubmitted){
        //Update container
        recContainer = document.querySelector('#rec-container');
        //Insert new row into rec container
        recContainer.innerHTML+=`<li class="row">
                                <div class="col-10">
                                    <h5 class="align-items-center row"><i data-feather="arrow-right" class="my-auto col-1 m-0 p-0"></i>
                                        <textarea rows="1" class="rec form-control course-form-field border-light border-radius-sm col-10" placeholder="Type your recommendation here" oninput="auto_grow(this)" id="new"></textarea>
                                    </h5>
                                </div>
                                <div>
                                    <button
                                        class="btn btn-secondary-veedros btn-secondary-veedros-normal border-medium edit-btn edit-rec" type="button"><i
                                        data-feather="check" style="stroke: #0D984F"></i>
                                    Save</button>
                                </div>
                            </li>`;
        //Update collections
        editRecButtons = document.querySelectorAll('.edit-rec');
        editRecFields = document.querySelectorAll('.rec');
        //focus on last element;
        editRecFields[editRecFields.length-1].focus();
        stageButtonsAndInputsToController(editRecButtons, editRecFields, recommendationUrl, "recommendation")
        addRecButton.disabled = true;
        lastRecSubmitted = false;
        feather.replace();
    }
    else
    {
        showAlertMessage('You need to submit the last recommendation before adding a new one.')
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
                button.disabled = true;
                field.setAttribute('readonly', true);

                //See if this field is to be edited or added.
                let ax;
                let id = field.id;
                let idName;
                if(valueToUpdate === "objective")
                    idName = "objId"
                else
                    idName = "recId"

                if(id !== 'new'){
                    ax = new axios({
                        method:'post',
                        url:url,
                        data:{
                            [valueToUpdate]: field.value,
                            slug: slug,
                            [idName]: id
                        }
                    })
                }
                else
                {
                    ax = new axios({
                        method:'post',
                        url:url,
                        data:{
                            [valueToUpdate]: field.value,
                            slug: slug
                        }
                    })
                }
                    ax.then(data=>{
                        showSuccessMessage(data.data.status)
                        field.id = data.data.id;
                        button.innerHTML = '<i data-feather="edit"></i> Edit';
                        button.children[0].style.stroke = "rgba(0,0,0,.7)";
                        field.innerHTML = field.value;
                        if(valueToUpdate === "objective"){
                        addObjButton.disabled = false;
                            lastObjSubmitted = true;
                        }
                        else{
                            addRecButton.disabled = false;
                            lastRecSubmitted = true;
                        }
                    })
                    .catch(err=>{
                        showFailureMessage(`Failed to update ${valueToUpdate}. Please try again.`)
                        button.innerHTML = '<i data-feather="x"></i> Error';
                        button.children[0].style.stroke = "#FF9494";
                    })
                    .finally(()=>{
                        feather.replace();
                        button.disabled = false;
                    });
            }
            feather.replace();
        }
    }
}





function showSuccessMessage(message){
    Swal.fire({
        toast:true,
        position: 'top',
        icon: 'success',
        title: message,
        showConfirmButton: false,
        timer: 2000
    })
}

function showAlertMessage(message){
    Swal.fire({
        toast:true,
        position: 'top',
        icon: 'warning',
        title: message,
        showConfirmButton: false,
        timer: 2000
    })
}

function showFailureMessage(message){
    Swal.fire({
        toast:true,
        position: 'top',
        icon: 'error',
        title: message,
        showConfirmButton: false,
        timer: 2500
    })
}

