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

    player = videojs('player', options,()=>{
        console.log(player);
    });


