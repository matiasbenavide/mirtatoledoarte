export async function mainFooter(options) {
    let shopDropdown = $('#shopDropdown');
    let shopLinks = $('#shopLinks');

    let aboutUsDropdown = $('#aboutUsDropdown');
    let aboutUsLinks = $('#aboutUsLinks');

    let socialMediaDropdown = $('#socialMediaDropdown');
    let socialMediaLinks = $('#socialMediaLinks');

    let contactBtn = $('#contactBtn');

    let aboutUs = $('#aboutUs');
    let aboutUsLink = $('#aboutUsLink');

    let url;
    let contactUrl = "/contacto";

    initFooter(options);

    function initFooter(options)
    {
        url = options.url;

        contactBtn.on("click", function()
        {
            window.location.href = url + contactUrl;
        });

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
}
