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


