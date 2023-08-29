export async function mainFooter() {
    let shopDropdown = $('#shopDropdown');
    let shopLinks = $('#shopLinks');
    let aboutUsDropdown = $('#aboutUsDropdown');
    let aboutUsLinks = $('#aboutUsLinks');
    let socialMediaDropdown = $('#socialMediaDropdown');
    let socialMediaLinks = $('#socialMediaLinks');

    shopDropdown.on("click", function() {
        shopLinks[0].classList.toggle('active-links');
    });
    aboutUsDropdown.on("click", function() {
        aboutUsLinks[0].classList.toggle('active-links');
    });

    socialMediaDropdown.on("click", function() {
        socialMediaLinks[0].classList.toggle('active-links');
    });
}
