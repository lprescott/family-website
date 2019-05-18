var scalar = 5;
var xTranslate = 5;
var yTranslate;
var maxiterations = 50;

function setup() {
    createCanvas(windowWidth, windowHeight);
    pixelDensity(1);
    yTranslate = height / 2 - width / 2;
}

function draw() {
    loadPixels();
    for (var x = 0; x < width; x++) {
        for (var y = 0; y < height; y++) {
            var a = map(x, 0 + xTranslate, width + xTranslate, -scalar, scalar);
            var b = map(y, 0 + yTranslate, width + yTranslate, -scalar, scalar);
            var ca = a;
            var cb = b;
            var n = 0;
            while (n < maxiterations) {
                var aa = a * a - b * b;
                var bb = 2 * a * b;
                a = aa + ca;
                b = bb + cb;
                if (a + b > 16) {
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