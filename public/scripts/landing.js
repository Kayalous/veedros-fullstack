// let init = function (el, timing) {
//   var blob = new paper.PaperScope();
//   blob.setup(el);

//   var view = blob.view,
//     Point = blob.Point,
//     Path = blob.Path,
//     Group = blob.Group;

//   // adjustable variables
//   var mouseForce = 0.2;
//   // other variables
//   var mousePoint = new Point(-1000, -1000);

//   function Bacterium(center, size, color) {
//     this.build(center, size, color);
//   }

//   Bacterium.prototype = {
//     build: function (center, radius, color) {
//       var padding = Math.min(view.size.width, view.size.height) * 0.1;
//       var timeScale = 1;
//       var maxWidth = view.size.width - padding * 2;
//       var maxHeight = view.size.height - padding * 2;
//       var w = maxWidth * timeScale;
//       var h = maxHeight * timeScale;

//       this.fitRect = new Path.Rectangle({
//         point: [view.size.width / 2 - w / 2, view.size.height / 2 - h / 2],
//         size: [w, h]
//       });

//       this.circlePath = new Path.Circle(center, radius);

//       this.group = new Group([this.circlePath]);
//       this.group.strokeColor = "#efefef";
//       this.group.position = view.center;
//       this.circlePath.fillColor = color;
//       this.circlePath.fullySelected = false;
//       this.threshold = radius * 1.9;
//       this.center = center;
//       this.circlePath.flatten(radius * 1.9);
//       this.circlePath.smooth();
//       this.circlePath.fitBounds(this.fitRect.bounds);
//       this.controlCircle = this.circlePath.clone();
//       this.controlCircle.fullySelected = false;
//       this.controlCircle.visible = false;

//       var rotationMultiplicator = radius / 180;

//       this.settings = [];
//       for (var i = 0; i < this.circlePath.segments.length; i++) {
//         var segment = this.circlePath.segments[i];
//         this.settings[i] = {
//           relativeX: segment.point.x - this.center.x,
//           relativeY: segment.point.y - this.center.y,
//           offsetX: rotationMultiplicator,
//           offsetY: rotationMultiplicator,
//           momentum: new Point(0, 0)
//         };
//       }
//     },
//     clear: function () {
//       this.circlePath.remove();
//       this.fitRect.remove();
//     },
//     animate: function (event) {
//       this.group.rotate(-0.2, view.center);

//       for (var i = 0; i < this.circlePath.segments.length; i++) {
//         var segment = this.circlePath.segments[i];

//         var settings = this.settings[i];
//         var controlPoint = new Point();
//         controlPoint = this.controlCircle.segments[i].point;

//         // Avoid the mouse
//         var mouseOffset = mousePoint.subtract(controlPoint);
//         var mouseDistance = mousePoint.getDistance(controlPoint);
//         var newDistance = 0;

//         var newPosition = controlPoint.add(this.newOffset);

//         var distanceToNewPosition = segment.point.subtract(newPosition);

//         settings.momentum = settings.momentum.subtract(
//           distanceToNewPosition.divide(18)
//         );
//         settings.momentum = settings.momentum.multiply(0.6);

//         // Add automatic rotation
//         var amountX = settings.offsetX;
//         var amountY = settings.offsetY;
//         var sin = Math.sin(event.time + i * timing);
//         var cos = Math.cos(event.time + i * timing);
//         settings.momentum = settings.momentum.add(
//           new Point(cos * -amountX, sin * -amountY)
//         );

//         segment.point = segment.point.add(settings.momentum);
//       }
//     }
//   };

//   var radius = (Math.min(view.size.width, view.size.height) / 2) * 0.7;
//   // color and radius
//   var bacterium = new Bacterium(view.bounds.center, radius, "#f7f7f7");

//   view.onFrame = function (event) {
//     bacterium.animate(event);
//   };
//   // var tool = new blob.Tool();
//   // tool.onMouseMove = function (event) {
//   //   mousePoint = event.lastPoint;
//   // };
// };

// var blob = document.getElementById("blob");
// init(blob, 2);
// var blob2 = document.getElementById("blob2");
// init(blob2, 3);
// var blob3 = document.getElementById("blob3");
// init(blob3, 4);
// style="background-image: url(images/card${i +
//   1}.jpg)"
let cardClass;
let cardArr = [];
let tippyArr = [];
let dest = document.querySelector(".card-columns");
for (let i = 0; i < 6; i++) {
  cardClass = i;
  let mcard = `<div class="card course-card development-card noJquery ${"a" +
    cardClass} wow fadeIn" data-wow-delay="${0.1 *
    i}s" style="background-image: url('images/img_0${i +
    1}.png')" data-toggle="modal"
    data-target="#exampleModal">
    <div class="course-card-overlay overlay-${i % 6}"></div>
    <div class="card-body m-0">
      <a href="player.html" class="card-body-inner noscroll card-bg-img"  >
        <div class="play-circle play-circle-${i %
          6}"> <img style="height:40px; width:40px " src="images/Play_button.svg" alt=""/> </div>
        <h4 class="card-title title-mine">
          Full Stack Web Development
        </h4>
      </a>
    </div>
    </div>`;
  dest.innerHTML += mcard;
  cardArr.push(mcard);
}

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
createTippyTemplates();

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
      items: 4
    },
    992: {
      items: 3
    },
    768: {
      items: 2
    },
    0: {
      items: 1
    }
  },
  autoplayHoverPause: true
});
new WOW().init();

function afterReveal(el) {
  el.addEventListener("animationstart", function(event) {
    $(".wow").each(function() {
      $(this).css("opacity", 1);
    });
  });
}
new WOW({
  callback: afterReveal
}).init();


