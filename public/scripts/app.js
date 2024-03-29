console.log('____   ____                .___                    \n' +
    '\\   \\ /   /____   ____   __| _/______  ____  ______\n' +
    ' \\   Y   // __ \\_/ __ \\ / __ |\\_  __ \\/  _ \\/  ___/\n' +
    '  \\     /\\  ___/\\  ___// /_/ | |  | \\(  <_> )___ \\ \n' +
    '   \\___/  \\___  >\\___  >____ | |__|   \\____/____  >\n' +
    '              \\/     \\/     \\/                  \\/ \n\n\n\n' +
    '01010110 01110011 00100000 01101100 01100010 01101000 00100000' +
    ' 01101110 01110000 01100111 01101000 01101110 01111001 01111001' +
    ' 01101100 00100000 01100111 01100010 01100010 01111000 00100000' +
    ' 01100111 01110101 01110010 00100000 01100111 01110110 01111010' +
    ' 01110010 00100000 01100111 01100010 00100000 01110001 01110010' +
    ' 01110000 01110110 01100011 01110101 01110010 01100101 00100000' +
    ' 01100111 01110101 01110110 01100110 00100000 01010110 00100111' +
    ' 01110001 00100000 01101111 01110010 00100000 01100101 01110010' +
    ' 01101110 01111001 01111001 01101100 00100000 01110110 01100001' +
    ' 01100111 01110010 01100101 01110010 01100110 01100111 01110010' +
    ' 01110001 00100000 01100111 01100010 00100000 01100111 01101110' +
    ' 01111001 01111000 00100000 01100111 01100010 00100000 01101100' +
    ' 01100010 01101000 00101110 00100000 01110010 01111010 01101110' +
    ' 01110110 01111001 00100000 01111010 01110010 00100000 01110101' +
    ' 01110010 01100101 01110010 00111010 00100000 01101110 01110010' +
    ' 01111001 01111000 01101110 01101100 01101110 01111001 00111000' +
    ' 00111000 01000000 01110100 01111010 01101110 01110110 01111001' +
    ' 00101110 01110000 01100010 01111010 00101110 ');
let tip_content = `<div class="tip">
<div class="container">
    <a href="/profile">
        <div class="row w-100">
            <div class="col-8">
                <h6 class="text-left">My profile</h6>
            </div>
            <div class=" text-center col-4">
                <i class="far iconsize-mine fa-user-circle"></i>
            </div>
        </div>
    </a>
    <a href="/dashboard">
        <div class="row w-100">
            <div class="col-8">

                <h6 class="text-left">My dashboard</h6>
            </div>
            <div class="text-center col-4">
                <i class="far iconsize-mine fa-play-circle"></i>
            </div>
        </div>
    </a>
        <br>
        <div class="btn-redeem-veedros m-auto ">
            <form method="POST" action="/promo/redeem">
                ${csrfToken}
                <input class="btn-redeem form-control profile-form-field email-field-props border-light border-radius-sm" placeholder="Redeem code" type="text" name="code">
                <button type="submit" class="btn-redeem-icon border-0">
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>
        </div>

        <br>
        <button class=" btn btn-veedros-new btn-veedros-sm border-0 m-auto" type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Log out
        </button>

</div>
</div>`;

let nav_tip = document.createElement("div");
nav_tip.innerHTML = tip_content;
if (document.querySelector('#singleElement'))
    tippy('#singleElement', {
        allowTitleHTML: true,
        content: tip_content,
        interactive: true,
        placement: "bottom",
        theme: "veedros",
        trigger: "click focus",
        boundary: 'viewport'
    });
var input = document.querySelector('.search-form');
var search = document.querySelector('.search-input');
var button = document.querySelector('.btn-nav-search');
if (button) {

    button.addEventListener('click', function(e) {
        e.preventDefault();
        if (search.value.length > 0) {
            search.form.submit();
        } else {
            search.focus();
            input.classList.toggle('active');
            search.classList.toggle('shadow-lg');
        }

    });
    search.addEventListener('focus', function() {
        input.classList.add('focus');
    });

    search.addEventListener('blur', function() {
        search.value.length != 0 ? input.classList.add('focus') : input.classList.remove('focus');
    })
}



$(function() {
    if (!($(this).scrollTop()) == 0) {

        $(".fixed-top").addClass("scrolled");
    }
    $(document).scroll(function() {
        var $nav = $(".fixed-top");
        $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
    });
});
