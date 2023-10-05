export async function mainNavbar(options) {
    let navBarToggle = $('#navBarToggle');
    let searchSection = $('#searchSection');
    let searchLink = $('#searchLink');
    let searchIcon = $('#searchIcon');

    let searchForm = $('#searchForm');
    let submitInput = $('#submitInput');

    document.onclick = function(e) {
        if (e.target.id === navBarToggle[0].id || e.target.id === searchIcon[0].id) {
            searchSection[0].classList.toggle('show');

            if (window.getComputedStyle(searchSection[0]).display == 'none') {
                searchLink[0].setAttribute('href', options.url);
            }
        }
    }

    submitInput.on("click", function() {
        searchForm.submit();
    });
}
