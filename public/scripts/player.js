document.addEventListener('DOMContentLoaded', () => {
        $('.sidebar').height($('.video-wrapper').height());
        window.addEventListener('resize', () => {
            $('.sidebar').height($('.video-wrapper').height());
        });
        let progressContainer = document.querySelector('.plyr__progress')
        for (let i = 0; i < 4; i++) {
            let dot = document.createElement('div');
            dot.classList.add('player-dot');
            dot.classList.add(`p${i}`);


            let randomOffset = Math.ceil(Math.random() * 100)
            dot.style.left = `${randomOffset}%`;
            let tprToCurrentDot = 0;
            dot.onclick = () => {
                tprToCurrentDot = ((player.duration * randomOffset) / 100);
                player.currentTime = tprToCurrentDot;
                // player.pause();
                window.location = '#comments';
            }

            let tip = tippy(dot, {
                allowTitleHTML: true,
                content: `Do something (Go to cheat sheet, pause video, go to quiz, etc...)`,
                delay: [100, 50],
                interactive: true,
                placement: "top",
                theme: "light",
                touch: false
            });
            progressContainer.appendChild(dot);
        }

        feather.replace();
    })
    // var options, player;
    //
    // options = {
    //     controlBar: {
    //         children: [
    //             'playToggle',
    //             'volumePanel',
    //             'progressControl',
    //             'remainingTimeDisplay',
    //             'qualitySelector',
    //             'fullscreenToggle',
    //         ],
    //     },
    // };
    //
    // player = videojs('player', options);


const player = new Plyr('#player');

let likeButtons = document.querySelectorAll('.like-btn');
for (let i = 0; i < likeButtons.length; i++) {

    likeButtons[i].onclick = () => {
        axios({
                method: 'post',
                url: baseUrl + '/like/' + likeButtons[i].id,
                data: {}
            })
            .then(data => {
                if (data.data.status === 'Liked') {
                    likeButtons[i].classList.add('liked');
                    likeButtons[i].children[1].innerHTML = Number(likeButtons[i].children[1].innerHTML) + 1;
                } else {
                    likeButtons[i].classList.remove('liked');
                    likeButtons[i].children[1].innerHTML = Number(likeButtons[i].children[1].innerHTML) - 1;
                }
            })
            .catch(err => {
                showAlertMessage('You need to be logged in to like this comment.')
            })
    }
}

function showAlertMessage(message) {
    Swal.fire({
        toast: true,
        position: 'top',
        icon: 'warning',
        title: message,
        showConfirmButton: false,
        timer: 2000
    })
}