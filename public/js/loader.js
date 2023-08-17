
// Load the "loading.html" content after the page has fully loaded.
window.onload = function () {
    loadLoadingPage();
};

function loadLoadingPage() {
    // Create an iframe to load the "loading.html" page.
    var iframe = document.createElement('iframe');
    iframe.src = '/loader';
    iframe.style.display = 'none'; // Hide the iframe

    // When the iframe is loaded, remove it to stop "loading.html" content.
    iframe.onload = function () {
        document.body.removeChild(iframe);
    };

    // Append the iframe to the body to trigger the loading of "loading.html".
    document.body.appendChild(iframe);
}
