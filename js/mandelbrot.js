var scalar = 5;
var xTranslate = 5;
var yTranslate;

var height;
var width;

var controlsWidth = 170; // The width of the left bar.

function setup() {

  height = innerHeight;
  width = innerWidth-controlsWidth;

  // Creates a canvas element in the document, and 
  // sets the dimensions of it in pixels. 
  // createCanvas(): https://p5js.org/reference/#/p5/createCanvas
  canvas = createCanvas(width, height);
  canvas.position(controlsWidth, 0);
  canvas.style('z-index', '-1');

  pixelDensity(1);

  // Number of iterations
  createDiv('&nbsp;# of iterations');
  iterations = createSlider(2,1000,50,10);

  yTranslate = height / 2 - width / 2;
}

function draw() {

  //The maximum number of iterations to the below loop
  var maxIterations = iterations.value();

  loadPixels();
  //This nested for-loop touches every pixel
  for (var x = 0; x < width; x++) {
    for (var y = 0; y < height; y++) {

      //a + bi
      var a = map(x, 0 + xTranslate, width + xTranslate, -scalar, scalar);
      var b = map(y, 0 + yTranslate, width + yTranslate, -scalar, scalar);

      //Temp var
      var tempA = a;
      var tempB = b;

      //Calculate real-components of each iteration
      var n = 0 //count variable

      while (n < maxIterations) {

        //Calculating components of next iterations:
        //(a + bi) * (a + bi)
        //a^2 + abi + abi + b^2 * i^2
        //a^2 + 2abi - b^2
        //a^2 - b^2 + 2abi

        var a_component = a * a - b * b;
        var b_component = 2 * a * b;

        //A is set to the calculated component + the previous value
        a = a_component + tempA;
        b = b_component + tempB;

        //Does the iteration diverge?
        if (a * a + b * b > 16) {
          break;
        }

        n++;
      }

      var red = map(sin(n * 0.25), -1, 1, 0, 145);
      var green = map(cos(n * 0.25), -1, 1, 170, 0);
      var blue = map(sin(n * 0.25), -1, 1, 150, 0);
      var pix = (x + y * width) * 4;
      pixels[pix + 0] = red;
      pixels[pix + 1] = green;
      pixels[pix + 2] = blue;
      pixels[pix + 3] = 255;
    }
  }
  updatePixels();
  scalar *= 0.9;
  xTranslate = (1 / scalar) * (width * 0.805);
}
