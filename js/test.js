function query(url, body = "", method = "GET", callback) {
  const domain = "https://agile-sands-59528.herokuapp.com/";
  var myHeaders = new Headers();
  myHeaders.append("Content-Type", "application/json");
  var raw = JSON.stringify(body);
  var requestOptions = {
    method: method,
    headers: myHeaders,
    body: raw,
    redirect: "follow",
  };
  var finalUrl = `${domain}${url}`;
  fetch(finalUrl, requestOptions)
    .then(function (response) {
      return response.json();
    })
    .then((text) => {
      console.log(text);
      return callback(text);
    })
    .catch(function (error) {
      console.log(error);
    });
}
function getCodes() {
  fetch("g/get_codes")
    .then(function (response) {
      return response.json();
    })
    .then(function (text) {
      console.log(text);
      document.querySelector(".getCodes").innerHTML = JSON.stringify(text);
    })
    .catch(function (error) {
      console.log(error);
    });
}
function getFoods() {
  fetch("g/get_foods")
    .then(function (response) {
      return response.json();
    })
    .then(function (text) {
      console.log(text);
      document.querySelector(".getFoods").innerHTML = JSON.stringify(text);
    })
    .catch(function (error) {
      console.log(error);
    });
}
function getNews() {
  fetch("g/get_news")
    .then(function (response) {
      return response.json();
    })
    .then(function (text) {
      console.log(text);
      document.querySelector(".getNews").innerHTML = JSON.stringify(text);
    })
    .catch(function (error) {
      console.log(error);
    });
}
function get_provider() {
  fetch("g/get_provider")
    .then(function (response) {
      return response.json();
    })
    .then(function (text) {
      console.log(text);
      document.querySelector(".get_provider").innerHTML = JSON.stringify(text);
    })
    .catch(function (error) {
      console.log(error);
    });
}
function create_user(data) {
  query("wepetusers", data, "POST", (text) => {
    document.querySelector(".create_user").innerHTML = JSON.stringify(text);
  });
}
function login_user(data) {
  query("wepetusers/login", data, "POST", (text) => {
    document.querySelector(".login_user").innerHTML = JSON.stringify(
      text.response
    );
  });
}
