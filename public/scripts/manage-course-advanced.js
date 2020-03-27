function auto_grow(element) {
    element.style.height = "5px";
    element.style.height = (element.scrollHeight)+"px";
}


//Manage sessions
let addSessionButton = document.querySelector('#add-session');
let sessionsContainer = document.querySelector('#sessions-container');
let editSessionButtons = document.querySelectorAll('.edit-rec');
let editSessionFields = document.querySelectorAll('.rec');
let sessionUrl = `${baseUrl}manage/instructor/course/recommendation`;
stageButtonsAndInputsToController(editSessionButtons, editSessionFields, sessionUrl, "session")
let lastSessionSubmitted = true;
addSessionButton.onclick = () => {
    if(lastSessionSubmitted){
        //Update container
        sessionsContainer = document.querySelector('#Session-container');
        //Insert new row into Session container
        sessionsContainer.innerHTML+=`<li class="row">
                                <div class="col-10">
                                    <h5 class="align-items-center row"><i data-feather="arrow-right" class="my-auto col-1 m-0 p-0"></i>
                                        <textarea rows="1" class="Session form-control course-form-field border-light border-radius-sm col-10" placeholder="Type your recommendation here" oninput="auto_grow(this)" id="new"></textarea>
                                    </h5>
                                </div>
                                <div>
                                    <button
                                        class="btn btn-secondary-veedros btn-secondary-veedros-normal border-medium edit-btn edit-Session" type="button"><i
                                        data-feather="check" style="stroke: #0D984F"></i>
                                    Save</button>
                                </div>
                            </li>`;
        //Update collections
        editSessionButtons = document.querySelectorAll('.edit-Session');
        editSessionFields = document.querySelectorAll('.Session');
        //focus on last element;
        editSessionFields[editSessionFields.length-1].focus();
        stageButtonsAndInputsToController(editSessionButtons, editSessionFields, sessionUrl, "recommendation")
        addSessionButton.disabled = true;
        lastSessionSubmitted = false;
        feather.replace();
    }
    else
    {
        showAlertMessage('You need to submit the last recommendation before adding a new one.')
    }

}



//Manage chapters
let addChapterButton = document.querySelector('#add-chapter');
let chaptersContainer = document.querySelector('#chapters-container');
let editChapterNameButtons = document.querySelectorAll('.edit-chapter-name');
let editChapterNameFields = document.querySelectorAll('.chapter-name-field');
let editChapterDescButtons = document.querySelectorAll('.edit-chapter-desc');
let editChapterDescFields = document.querySelectorAll('.chapter-desc-field');
let chapterUrl = `${baseUrl}manage/instructor/course/recommendation`;
//Edit chapter name staging
stageButtonsAndInputsToController(editChapterNameButtons, editChapterNameFields, 'url', 'valueToUpdate')
//edit chapter desc staging
stageButtonsAndInputsToController(editChapterDescButtons, editChapterDescFields, 'url', 'valueToUpdate')
let lastChapterSubmitted = true;
addChapterButton.onclick = () => {
    if(lastChapterSubmitted){
        //Update container
        chaptersContainer = document.querySelector('#chapters-container');
        //Insert new row into Chapter container
        chaptersContainer.innerHTML+=`<li>
            <button class="list-group-item collapse-button mx-auto" aria-expanded="false" data-toggle="collapse"
                    href="#collapse{{$loop->iteration}}" >
                <span>Chapter ${editChapterNameFields.count} </span>
                <div class="vertical-seperator"></div>
                <span class="chapter-name">
                Chapter name
                </span>
                <div class="chevron"><i data-feather="chevron-down"></i></div>
            </button>

                <div class="list-group collapse my-2 px-5" id="collapse{{$loop->iteration}}">
                    <div>
                <h2 class="mb-2">Chapter's name</h2>
                <div class="row">
                    <div class="col-10">
                        <h5 class="align-items-center row">
                            <textarea rows="1" class="chapter-name-field form-control course-form-field border-light border-radius-sm col-12" placeholder="Type chapter name here" oninput="auto_grow(this)" readonly id="{{$chapter->id}}">{{$chapter->name}}</textarea>
                        </h5>
                    </div>
                    <div>
                        <button
                            class="btn btn-secondary-veedros btn-secondary-veedros-normal border-0 edit-btn edit-chapter-name" type="button"><i
                                data-feather="edit"></i>
                            Edit</button>
                    </div>
                </div>
                <br>
                <h2 class="mb-2">Chapter's description</h2>
                <div class="row">
                    <div class="col-10">
                        <h5 class="align-items-center row">
                            <textarea rows="1" class="chapter-desc-field form-control course-form-field border-light border-radius-sm col-12" placeholder="Type chapter description here" oninput="auto_grow(this)" readonly id="{{$chapter->id}}">{{$chapter->about}}</textarea>
                        </h5>
                    </div>
                    <div>
                        <button
                            class="btn btn-secondary-veedros btn-secondary-veedros-normal border-medium edit-btn edit-chapter-desc" type="button"><i
                                data-feather="edit"></i>
                            Edit</button>
                    </div>
                </div>
                    </div>
                    </div>
                    @foreach($chapter->sessions as $session)
                        <button class="list-group-item collapse-button mx-auto" aria-expanded="false" data-toggle="collapse"
                                href="#collapse-sessions-{{$loop->iteration}}">
                            <span>Session {{$loop->iteration}} </span>
                            <div class="vertical-seperator"></div>
                            <span class="chapter-name">
                                {{$session->name}}
                            </span>
                            <div class="chevron"><i data-feather="chevron-down"></i></div>
                        </button>
                            <div class="list-group collapse py-4 px-5" id="collapse-sessions-{{$loop->iteration}}">
                                <h2>Session {{$loop->iteration}}</h2>
                            </div>

                    @endforeach
                    <div class="w-100 mt-5 row mx-auto">
                        <button id="add-session"
                                class="btn btn-secondary-veedros btn-secondary-veedros-xl border-medium edit-btn py-3" type="button">
                            <h2 class="m-0">
                                <i data-feather="plus"></i>
                                Add a new session.
                            </h2>
                        </button>
                    </div>
                </div>
            </li>`;
        //Update collections
        editChapterButtons = document.querySelectorAll('.edit-Chapter');
        editChapterFields = document.querySelectorAll('.Chapter');
        //focus on last element;
        editChapterFields[editChapterFields.length-1].focus();
        stageButtonsAndInputsToController(editChapterButtons, editChapterFields, chapterUrl, "recommendation")
        addChapterButton.disabled = true;
        lastChapterSubmitted = false;
        feather.replace();
    }
    else
    {
        showAlertMessage('You need to submit the last Chapter before adding a new one.')
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

