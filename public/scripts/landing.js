function createTippyTemplates() {
  for (let i = 0; i < cardArr.length; i++) {
    let tipContent = `<div class="tip">
      <div class="container">
        <h4 class="tip-header text-center">
          Probability and Statistics - Math 9
        </h4>
        <hr />
        <div class="row">
          <div class="col-8">

            <div class="tip-instructor">
              <div class="">
                <h6>
                  By: <br />
                  <b>Ahmed Saeed</b>
                  <br />
                  <span>TA at AAST</span>
                  <br />
                </h6>
                <a href="profile.html" class="btn btn-veedros btn-veedros-sm border-0 mt-1">
                  Visit profile
                </a>
              </div>
            </div>
          </div>
          <div class="tip-instructor-avatar col-4">
            <img src="images/05.jpg" alt="instructor" class="round" />
          </div>
        </div>
        <hr />
        <div class="tip-meta">
          <div class="row">
            <div class="col-6">
              <div class="badge tip-badge">
                <div class="tip-badge-item">  <i class="fas fa-hand-holding-usd"></i> <span>1200 EGP</span></div>
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
            <li>
              AAST Students - Computer Department <span>7th term</span>
            </li>
            <li>
              FOE - Communications Department <span>8th term</span>
            </li>
          </ul>
        </div>
        <a href="player.html" class="row">
          <button class="btn btn-veedros btn-veedros-md border-0 mx-auto" type="button">
            Apply now
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
// createTippyTemplates();

function populateTippies() {
  for (i = 0; i < tippyArr.length; i++) {
    let tip = tippy(`${".a" + i}`, {
      allowTitleHTML: true,
      content: tippyArr[i],
      delay: [400, 200],
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


