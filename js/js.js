if (!getCookie('viewPopup')) {
    openPopup();
}

if (getCookie('actionResult')) {
    $('.result-container').append(getCookie('actionResult'));
}

function allowCookies() {
    document.cookie = "viewPopup=0; max-age=86400";
    closePopup();
}

function closePopup() {
    $('.cookie-consent').addClass('d-none');
}

function openPopup() {
    $('.cookie-consent').removeClass('d-none');
}

function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined
}