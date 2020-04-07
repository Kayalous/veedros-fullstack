FilePond.parse(document.body);
// We register the plugins required to do
// image previews, cropping, resizing, etc.
FilePond.registerPlugin(
);



// Select the file input and use
// create() to turn it into a pond
FilePond.create(
    document.querySelector('.filepond'),
    {
        labelIdle: `Drag & Drop your session or <span class="filepond--label-action">Browse</span>`,
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


function auto_grow(element) {
    element.style.height = "5px";
    element.style.height = (element.scrollHeight)+"px";
}


//Manage sessions
let addSessionButtons = document.querySelectorAll('.add-session');
//Manage chapters
let editSessionNameButtons = document.querySelectorAll('.edit-session-name');
let editSessionNameFields = document.querySelectorAll('.session-name-field');
let editSessionDescButtons = document.querySelectorAll('.edit-session-desc');
let editSessionDescFields = document.querySelectorAll('.session-desc-field');
let editSessionUrl = `${baseUrl}manage/instructor/course/editSession`;
//Edit chapter name staging
stageButtonsAndInputsToController(editSessionNameButtons, editSessionNameFields, editSessionUrl, 'session', 'name')
//edit chapter desc staging
stageButtonsAndInputsToController(editSessionDescButtons, editSessionDescFields, editSessionUrl, 'session', 'about')
let lastSessionSubmitted = true;
for(let i = 0; i<addSessionButtons.length; i++){
    let addSessionButton = addSessionButtons[i];
addSessionButton.onclick = () => {
    if(lastSessionSubmitted){
        lastSessionSubmitted = false;
        //create new chapter
        let ax = new axios({
            method:'post',
            url:baseUrl + 'manage/instructor/course/newSession',
            data:{
                'course_slug': slug,
                'chapterId': addSessionButton.id,
            }
        });
        ax.then(data=>{
            showSuccessMessage(data.data.status);
            //reload after 100ms
            setTimeout(() => {
                location.reload();
            }, 800)
        })
            .catch(err=>{
                showFailureMessage(`Failed to create a new session. Please try again.`)})
    }
    else
    {
        showAlertMessage('You need to submit the last session before adding a new one.')
    }

}

}


//Manage chapters
let addChapterButton = document.querySelector('#add-chapter');
let chaptersContainer = document.querySelector('#chapters-container');
let editChapterNameButtons = document.querySelectorAll('.edit-chapter-name');
let editChapterNameFields = document.querySelectorAll('.chapter-name-field');
let editChapterDescButtons = document.querySelectorAll('.edit-chapter-desc');
let editChapterDescFields = document.querySelectorAll('.chapter-desc-field');
let editChapterUrl = `${baseUrl}manage/instructor/course/editChapter`;
//Edit chapter name staging
stageButtonsAndInputsToController(editChapterNameButtons, editChapterNameFields, editChapterUrl, 'chapter', 'name')
//edit chapter desc staging
stageButtonsAndInputsToController(editChapterDescButtons, editChapterDescFields, editChapterUrl, 'chapter', 'about')
let lastChapterSubmitted = true;
addChapterButton.onclick = () => {
    if(lastChapterSubmitted){
        lastChapterSubmitted = false;
        //create new chapter
        let ax = new axios({
            method:'post',
            url:baseUrl + 'manage/instructor/course/newChapter',
            data:{
                'course_slug': slug,
            }
        });
        ax.then(data=>{
            showSuccessMessage(data.data.status);
            //reload after 100ms
            setTimeout(() => {
                location.reload();
            }, 800)
        })
            .catch(err=>{
                showFailureMessage(`Failed to create a new chapter. Please try again.`)})
    }
    else
    {
        showAlertMessage('You need to submit the last Chapter before adding a new one.')
    }
}


function stageButtonsAndInputsToController(buttons, fields, url, tableToUpdate , valueToUpdate){
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
                if(tableToUpdate === "chapter")
                    idName = "chapterId"
                else
                    idName = "sessionId"

                    ax = new axios({
                        method:'post',
                        url:url,
                        data:{
                            [valueToUpdate]: field.value,
                            slug: slug,
                            [idName]: id
                        }
                    })

                ax.then(data=>{
                    showSuccessMessage(data.data.status)
                    button.innerHTML = '<i data-feather="edit"></i> Edit';
                    button.children[0].style.stroke = "rgba(0,0,0,.7)";
                    field.innerHTML = field.value;
                    if(valueToUpdate === "objective"){
                        lastObjSubmitted = true;
                    }
                    else{
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

async function deleteSession(id) {

    let answer = await Swal.fire({
        title: 'Confirm deleting session.',
        text: `Are you sure you want to delete this session? This action is irreversible.`,
        icon: 'error',
        confirmButtonText: 'Yes.',
        showCancelButton:true,
        cancelButtonText: "No."
    })

    if(answer.value ===true){
        window.location.href = `${baseUrl}manage/instructor/course/deleteSession/${id}`;
    }

}

async function deleteChapter(id) {

    let answer = await Swal.fire({
        title: 'Confirm deleting chapter.',
        text: `Are you sure you want to delete this chapter? This will delete the chapter and all of it's sessions. This action is irreversible.`,
        icon: 'error',
        confirmButtonText: 'Yes.',
        showCancelButton:true,
        cancelButtonText: "No."
    })

    if(answer.value ===true){
        window.location.href = `${baseUrl}manage/instructor/course/deleteChapter/${id}`;
    }

}
