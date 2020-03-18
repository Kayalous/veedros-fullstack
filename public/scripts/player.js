$('.sidebar').height($('.video-wrapper').height());
window.addEventListener('resize', () => {
    $('.sidebar').height($('.video-wrapper').height());
});
feather.replace();

let elementsArray = document.querySelectorAll(".collapse-button");

elementsArray.forEach(function (elem) {
    elem.addEventListener("click", function () {
        elem.classList.toggle('activated')
    });
});
let player = videojs(document.querySelector('#player'));

console.log(player.tech_.ytPlayer.getAvailableQualityLevels());
// player.controlBar.addChild('QualitySelector');
