export async function mainFooter() {
    let shopDropdown = $('#shopDropdown');
    let shopLinks = $('#shopLinks');
    let aboutUsDropdown = $('#aboutUsDropdown');
    let aboutUsLinks = $('#aboutUsLinks');
    let socialMediaDropdown = $('#socialMediaDropdown');
    let socialMediaLinks = $('#socialMediaLinks');

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
}
