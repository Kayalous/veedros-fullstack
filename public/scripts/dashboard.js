function ProgressCalc() {
    let NumOfEpisodes = 20;
    let seen = 10
    let progress = (seen / NumOfEpisodes) * 100;
    //for (let i =1 ; i<=2 ; i++);
    let prog1 = document.getElementById("prog-bar1")
    prog1.style.setProperty("--width", progress)
}

ProgressCalc();

let tip_content = `<div class="tip">
<div class="container">
    <a href="#">
        <div class="row">
            <div class="col-8">
                <h6>My profile</h6>
            </div>
            <div class=" text-center col-4">
                <i class="far iconsize-mine fa-user-circle"></i>
            </div>
        </div>
    </a>

    <hr>
    <a href="#">
        <div class="row">
            <div class="col-8">

                <h6>My dashboard</h6>
            </div>
            <div class="text-center col-4">
                <i class="far iconsize-mine fa-play-circle"></i>
            </div>
        </div>
    </a>

    <hr>



    <a href="player.html" class="row">
        <button class="btn btn-veedros btn-veedros-sm border-0 m-auto" type="button">
            Log out
        </button>
    </a>

</div>
</div>`;

let nav_tip = document.createElement("div");
nav_tip.innerHTML = tip_content;

tippy('#singleElement', {
    allowTitleHTML: true,
    content: 'tip_content',
    interactive: true,
    placement: "bottom",
    theme: "veedros"
});