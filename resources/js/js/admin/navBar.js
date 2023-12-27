export async function mainNavbar(options) {
    let navBarToggle = $('#navBarToggle');
    let searchSection = $('#searchSection');
    let searchLink = $('#searchLink');
    let searchIcon = $('#searchIcon');

    let searchForm = $('#searchForm');
    let desktopSearchForm = $('#desktopSearchForm');
    let submitInput = $('#submitInput');

    if (window.getComputedStyle(searchSection[0]).display == 'none') {
        desktopSearchForm[0].hidden = false;
        searchIcon.on("click", function() {
            desktopSearchForm.submit();
        });
    }

    document.onclick = function(e) {
        if (e.target.id === navBarToggle[0].id || e.target.id === searchIcon[0].id) {
            searchSection[0].classList.toggle('show');
        }
    }

    submitInput.on("click", function() {
        searchForm.submit();
    });
}
