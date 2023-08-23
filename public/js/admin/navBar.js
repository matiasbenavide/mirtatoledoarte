export async function mainNavbar() {
    let navBarToggle = $('#navBarToggle');
    let searchSection = $('#searchSection');

    let searchForm = $('#inputForm');
    let submitInput = $('#submitInput');

    let productSearchInput = $('#productSearchInput');
    let searchIcon = $('#searchIcon');

    // document.onclick = function(e) {
    //     if (e.target.id !== 'searchSection') {
    //         console.log(e.target.id);
    //         searchSection[0].classList.remove('active');
    //     }
    // }

    navBarToggle.on("click", function() {
        searchSection[0].classList.toggle('active');
    });

    submitInput.on("click", function() {
        searchForm.submit();
    });

    searchIcon.on("click", function() {
        searchSection[0].hidden = false;
        productSearchInput.focus();
    });
}
