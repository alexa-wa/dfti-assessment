function validation() {
    const usernameHolder = document.querySelector('.js-reg-usr').value;
    const passwordHolder = document.querySelector('.js-reg-pas').value;
    const jsErrorLogger = document.querySelector('.js-errors');

    if (usernameHolder.match(/[^a-z0-9]/)) {
        jsErrorLogger.innerHTML = "That doesn't look like a good username";
        return false;
    }

    if (usernameHolder.length < 5 || usernameHolder.length > 20) {
        jsErrorLogger.innerHTML = "Login should be in range of 5 - 20";
        return false;
    }

    if (passwordHolder.length < 5 || passwordHolder.length > 20) {
        jsErrorLogger.innerHTML = "Password should be in range of 5 - 20";
        return false;
    }

    return true;
}

function ajaxRequest() {
    const xmlHttp = new XMLHttpRequest();
    const value = document.getElementById('value').value;
    const response = document.getElementById('response');

    if (!xmlHttp) {
        console.error("Unable to establish the connection!");
        return false;
    }

    xmlHttp.addEventListener('load', (e) => {
        try {
            const jsonData = JSON.parse(e.target.responseText);

            for (let property in jsonData) {
                if (jsonData.hasOwnProperty(property)) {
                    response.innerHTML = jsonData.map((element) =>
                        `<div class="record">${element.name} ${element.type} ${element.country} ${element.region} ${element.description}</div>`)
                        .join('<br/>');
                }
            }
        } catch (exception) {
            return false;
        }
    });

    xmlHttp.open("GET", "/solent-slim/public/poi/search?region=" + value, true);
    xmlHttp.send();
}
