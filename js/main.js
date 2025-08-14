document.addEventListener("DOMContentLoaded", function () {
    const ctaButton = document.getElementById("cta-button");
    if (ctaButton) {
        ctaButton.addEventListener("click", function () {
            alert("Redirecting to shop page...");
            window.location.href = "shop.html";
        });
    }
});

 