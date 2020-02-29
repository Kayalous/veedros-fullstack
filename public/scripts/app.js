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



        <button class="btn btn-veedros btn-veedros-sm border-0 m-auto" type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Log out
        </button>

</div>
</div>`;

let nav_tip = document.createElement("div");
nav_tip.innerHTML = tip_content;
if(document.querySelector('#singleElement'))
tippy('#singleElement', {
    allowTitleHTML: true,
    content: tip_content,
    interactive: true,
    placement: "bottom",
    theme: "veedros",
    trigger: "click focus",
    boundary: 'window'
});
