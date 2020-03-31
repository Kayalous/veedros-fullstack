$('.sidebar').height($('.video-wrapper').height());
window.addEventListener('resize', () => {
    $('.sidebar').height($('.video-wrapper').height());
});
feather.replace();

    var options, player;

    options = {
        controlBar: {
            children: [
                'playToggle',
                'volumePanel',
                'progressControl',
                'remainingTimeDisplay',
                'qualitySelector',
                'fullscreenToggle',
            ],
        },
    };

    player = videojs('player', options);

    let likeButtons = document.querySelectorAll('.like-btn');
    for(let i = 0; i < likeButtons.length; i++){

        likeButtons[i].onclick = ()=>{
            axios({
                method:'get',
                url:baseUrl + '/like/' + likeButtons[i].id,
                data:{}
            })
                .then(data=>{
                    if(data.data.status === 'Liked'){
                        likeButtons[i].classList.add('liked');
                        likeButtons[i].nextElementSibling.innerHTML = Number(likeButtons[i].nextElementSibling.innerHTML) + 1;
                    }
                    else{
                        likeButtons[i].classList.remove('liked');
                        likeButtons[i].nextElementSibling.innerHTML = Number(likeButtons[i].nextElementSibling.innerHTML) - 1;
                    }
                })
                .catch(err=>{
                    showAlertMessage('You need to be logged in to like this comment.')
                })
        }
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


