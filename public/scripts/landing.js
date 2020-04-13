let tippyArr = [];

function createTippyTemplates() {
    let card = document.querySelectorAll('.card-body-inner');
    for (let i = 0; i < courses.length; i++) {
        let recString = '';
        for (let j = 0; j < recommendations[i].length; j++) {
            recString += `<li>
              ${recommendations[i][j].recommendation}
            </li>`
        }
        let tipContent = `<div class="tip">
      <div class="container">
        <h4 class="tip-header text-center">
          ${courses[i].name}
        </h4>
        <hr />
        <div class="row">
          <div class="col-8">

            <div class="tip-instructor">
              <div class="">
                <h6>
                  By: <br />
                  <b>${instructors[i].name}</b>
                </h6>
                <a href="profile/${instructors[i].id}" class="btn btn-veedros-new btn-veedros-sm border-0 mt-1">
                  Visit profile
                </a>
              </div>
            </div>
          </div>
          <div class="tip-instructor-avatar col-4">
            <img src="${instructors[i].img}" alt="instructor" class="round" />
          </div>
        </div>
        <hr />
        <div class="tip-meta">
          <div class="row">
            <div class="col-6">
              <div class="badge tip-badge">
                <div class="tip-badge-item">  <i class="fas fa-hand-holding-usd"></i> <span>${courses[i].price} EGP</span></div>
              </div>
            </div>
            <div class="col-6">
              <div class="badge tip-badge">
                <h5 class="tip-badge-item">  <i class="far fa-clock"></i>  <span>16 Hours</span></h5>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="tip-recommendation">
          <h6 class="tip-header">Recommended to</h6>
          <ul>
                ${recString}
          </ul>
        </div>
        <a href="${card[i].href}" class="row">
          <button class="btn btn-veedros-new btn-veedros-md border-0 mx-auto" type="button">
            Visit now
          </button>
        </a>

      </div>
      </div>`;
        let tippyTemp = document.createElement("div");
        tippyTemp.innerHTML = tipContent;
        tippyArr.push(tippyTemp);
        populateTippies();
    }
}
createTippyTemplates();

function populateTippies() {
    for (i = 0; i < tippyArr.length; i++) {
        let tip = tippy(`${".a" + i}`, {
            allowTitleHTML: true,
            content: tippyArr[i],
            delay: [100, 100],
            interactive: true,
            placement: "right",
            theme: "veedros",
            touch: false
        });
    }
}
$(".owl-carousel").owlCarousel({
    rewind: true,
    margin: 10,
    autoplay: true,
    autoplayTimeout: 4000,
    nav: true,
    dotsEach: true,
    dots: true,
    responsive: {
        1200: {
            items: 2
        },
        992: {
            items: 1
        },
        768: {
            items: 1
        },
        0: {
            items: 1
        }
    },
    autoplayHoverPause: true
});