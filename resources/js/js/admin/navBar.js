export async function mainNavbar() {
    let navBarToggle = $('#navBarToggle');
    let searchSection = $('#searchSection');
    let searchIcon = $('#searchIcon');

    let searchForm = $('#searchForm');
    let submitInput = $('#submitInput');

    document.onclick = function(e) {
        if (e.target.id === navBarToggle[0].id || e.target.id === searchIcon[0].id) {
            searchSection[0].classList.toggle('show');
        }
    }

    submitInput.on("click", function() {
        console.log('hola');
        searchForm.submit();
    });
}
