export async function mainFooter() {
    let shopDropdown = $('#shopDropdown');
    let shopLinks = $('#shopLinks');
    let aboutUsDropdown = $('#aboutUsDropdown');
    let aboutUsLinks = $('#aboutUsLinks');
    let socialMediaDropdown = $('#socialMediaDropdown');
    let socialMediaLinks = $('#socialMediaLinks');

    let aboutUs = $('#aboutUs');
    let aboutUsLink = $('#aboutUsLink');

    shopDropdown.on("click", function() {
        shopDropdown[0].classList.toggle('open');
        shopLinks[0].classList.toggle('show');
    });
    aboutUsDropdown.on("click", function() {
        aboutUsDropdown[0].classList.toggle('open');
        aboutUsLinks[0].classList.toggle('show');
    });

    socialMediaDropdown.on("click", function() {
        socialMediaDropdown[0].classList.toggle('open');
        socialMediaLinks[0].classList.toggle('show');
    });

    aboutUsLink.on('click', function() {
        if (aboutUs[0]) {
            aboutUs[0].scrollIntoView({
                block: 'center',
            });
        }
    });
}
