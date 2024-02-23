export async function mainNavbar()
{
    let burgerContainer = $('#burgerContainer');
    let linksMobile = $('#linksMobile');

    burgerContainer.on('click', function() {
        linksMobile[0].classList.toggle("show");
    });
}
