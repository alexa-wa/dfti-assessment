
function validation() {
    const usernameHolder = document.querySelector('.js-reg-usr').value;
    const passwordHolder = document.querySelector('.js-reg-pas').value;
    const jsErrorLogger = document.querySelector('.js-errors');

    if(usernameHolder.match(/[^a-z0-9]/)) {
        jsErrorLogger.innerHTML = "That doesn't look like a good username";
        return false;
    }

    if(usernameHolder.length < 5 || usernameHolder.length > 20) {
        jsErrorLogger.innerHTML = "Login should be in range of 5 - 20";
        return false;
    }

    if(passwordHolder.length < 5 || passwordHolder.length > 20) {
        jsErrorLogger.innerHTML = "Password should be in range of 5 - 20";
        return false;
    }

    return true;
}