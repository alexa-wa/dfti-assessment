let startTime = Date.now();
let endTime, timeElapsed = 0;

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
                        `<div class="record">
                           <div class="record_item">${element.name}</div> 
                           <div class="record_item">${element.type}</div> 
                           <div class="record_item">${element.country}</div> 
                           <div class="record_item">${element.region}</div> 
                           <div class="record_item">${element.description}</div>
                           <button onclick="ajaxRecommend('${element.id}')">Recommend</button>
                        </div>`).join('');
                }
            }
        } catch (exception) {
            return false;
        }
    });

    xmlHttp.open("GET", "/solent-slim/public/poi/search?region=" + value, true);
    xmlHttp.send();
}

function ajaxRecommend(region) {
    const xmlHttp = new XMLHttpRequest();

    if (!xmlHttp) {
        console.error("Unable to establish the connection!");
        return false;
    }

    xmlHttp.open("GET", "/solent-slim/public/poi/recommend?id=" + region, true);
    xmlHttp.send();
}

function ajaxReviewRequest() {
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
                        `<div class="record">
                           <div class="record_item">${element.name}</div> 
                           <div class="record_item">${element.type}</div> 
                           <div class="record_item">${element.country}</div> 
                           <div class="record_item">${element.region}</div> 
                           <input type="text" id="field-${element.id}" class="review" name="review" placeholder="Type your review"/>
                           <button onclick="ajaxReview('${element.id}')" class="submit_review">Review</button>
                        </div>`).join('');
                }
            }
        } catch (exception) {
            return false;
        }
    });

    xmlHttp.open("GET", "/solent-slim/public/poi/search?region=" + value, true);
    xmlHttp.send();
}

function getTimeElapsed() {
    endTime = Date.now();
    timeElapsed = endTime - startTime;
    startTime = Date.now();

    return timeElapsed * 0.001;
}

function ajaxReview(id) {
    const xmlHttp = new XMLHttpRequest();
    const reviewValue = document.getElementById("field-" + id);

    if (!xmlHttp) {
        console.error("Unable to establish the connection!");
        return false;
    }

    const timeOut = getTimeElapsed();

    if(timeOut < 25) {
        alert( "Please wait for " + Math.round((25 - timeOut)) + " more seconds to leave a review!");
        return false;
    }

    xmlHttp.open("GET", "/solent-slim/public/poi/review?id=" + id + "&review=" + reviewValue.value, true);
    xmlHttp.send();
}
