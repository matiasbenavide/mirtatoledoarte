export async function mainNavbar()
{
    let burgerContainer = $('#burgerContainer');
    let linksMobile = $('#linksMobile');

    burgerContainer.on('click', function() {
        if (linksMobile[0].classList[1] == 'navbar-mobile-hide') {
            linksMobile[0].classList.remove("navbar-mobile-hide");
            linksMobile[0].classList.add("navbar-mobile-show");
        }
        else
        {
            linksMobile[0].classList.remove("navbar-mobile-show");
            linksMobile[0].classList.add("navbar-mobile-hide");
        }
    });
}
