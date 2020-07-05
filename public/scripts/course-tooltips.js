let tippyArr = [];

function createTippyTemplates() {
    let card = document.querySelectorAll('.card-body-inner');
    console.log(courses);
    for (let i = 0; i < courses.length; i++) {

        let recString = '';
        for (let j = 0; j < recommendations[i].length; j++) {
            recString += `<li>
              ${recommendations[i][j].recommendation}
            </li>`
        }
        let wholeRec = '';
        if(recString.length > 0) {
            wholeRec = `<div class="tip-recommendation">
                <h6 class="tip-header">Recommended to</h6>
            <ul>
            ${recString}
            </ul>
            </div>`;
        }

        //Get a short version of the duration
        courses[i].duration = courses[i].duration.split(' ');
        if (parseInt(courses[i].duration[3]) > 30) {
            if (courses[i].duration[0] <= 1) {
                courses[i].duration[1] += 's';
            }
            courses[i].duration[0]++;
        }
        courses[i].duration = `${courses[i].duration[0]} ${courses[i].duration[1]}`;
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
                <h5>
                  <small class="text-muted">By</small> <br />
                  <span class="text-muted font-weight-bold">${instructors[i].name}</span>
                </h5>
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
                <div class="tip-badge-item">  <i class="fas fa-hand-holding-usd"></i> <span class="font-weight-bold">${courses[i].price} EGP</span></div>
              </div>
            </div>
            <div class="col-6">
              <div class="badge tip-badge">
                <h5 class="tip-badge-item">  <i class="far fa-clock"></i>  <span class="font-weight-bold">${courses[i].duration}</span></h5>
              </div>
            </div>
          </div>
        </div>
        <hr>
        ${wholeRec}
        <a href="${card[i].href}" class="row">
          <a href="/cart/add/${courses[i].id}" class="btn btn-veedros-red btn-veedros-md border-0 mx-auto" type="button">
             Add to cart <i class=" mx-2 fas fa-cart-plus"></i>
          </a>
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
            touch: false,
            boundary: document.querySelector("#featured-courses"),
        });
    }
}
