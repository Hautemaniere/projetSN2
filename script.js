// script.js
document.addEventListener("DOMContentLoaded", function () {
    const gifs = document.querySelectorAll(".gif");

    gifs.forEach((gif) => {
        gif.addEventListener("mouseover", () => {
            gif.src = gif.src.replace(".gif", "-hover.gif");
        });

        gif.addEventListener("mouseout", () => {
            gif.src = gif.src.replace("-hover.gif", ".gif");
        });
    });
});
