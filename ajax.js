const insertData = (e) => {
    e.preventDefault();

    let user_id = document.getElementById("user_id").value;
    let username = document.getElementById("txt_user").value;
    let password = document.getElementById("txt_pass").value;

    let mydata = { user_id: user_id, username: username, password: password };
    let data = JSON.stringify(mydata);

    console.log(data);

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "insert_data.php", true);
    xhttp.onload = () => {
        if (xhttp.status == 200) {
            console.log(xhttp.responseText);
            document.getElementById("my_form").reset();
            fetchData();
        }
    }
    xhttp.send(data);
}

document.getElementById("insert_btn").addEventListener("click", insertData);

const fetchData = () => {
    document.getElementById("tbody").innerHTML = "";
    let xhttp = new XMLHttpRequest();
    xhttp.responseType = "json";
    xhttp.open("POST", "fetch_data.php", true);
    xhttp.setRequestHeader("Content-Type", "application/json");
    xhttp.onload = () => {
        if (xhttp.status == 200) {
            if (xhttp.response) {
                x = xhttp.response;
            } else {
                xhttp.response = "";
            }

            for (let i = 0; i < x.length; i++) {
                document.getElementById("tbody").innerHTML += `<tr>
                    <td>${x[i].user_id}</td>
                    <td>${x[i].username}</td>
                    <td>${x[i].user_password}</td>
                    <td>${x[i].user_date}</td>
                    <td><button user_id="${x[i].user_id}" class="del_btn">Delete</button></td>
                    <td><button user_id="${x[i].user_id}" class="up_btn">Update</button></td>
                    </tr>`;
            }
            deleteData();
            updateData();
        }
    }
    xhttp.send();
}
fetchData();

const deleteData = () => {
    x = document.getElementsByClassName("del_btn");

    for (let i = 0; i < x.length; i++) {
        x[i].addEventListener('click', function () {
            id = x[i].getAttribute('user_id');

            let xhttp = new XMLHttpRequest();
            xhttp.open("POST", "delete_data.php", true);
            xhttp.onload = () => {
                if (xhttp.status == 200) {
                    alert(xhttp.response);
                    fetchData();
                }
            }
            let mydata = { id: id };
            let data = JSON.stringify(mydata);
            xhttp.send(data);
        })
    }
}

const updateData = () => {

    let user_id = document.getElementById("user_id");
    let username = document.getElementById("txt_user");
    let password = document.getElementById("txt_pass");

    x = document.getElementsByClassName('up_btn');

    for (let i = 0; i < x.length; i++) {
        x[i].addEventListener('click', () => {
            id = x[i].getAttribute('user_id');

            let xhttp = new XMLHttpRequest();
            xhttp.open("POST", "update_data.php", true);
            xhttp.responseType = "json";
            xhttp.onload = () => {
                if (xhttp.status == 200) {
                    y = xhttp.response;
                    for (let i = 0; i < y.length; i++) {
                        user_id.value = id;
                        username.value = y[i].username;
                        password.value = y[i].user_password;
                    }
                }
            }
            let mydata = { id: id };
            let data = JSON.stringify(mydata);
            xhttp.send(data);
        })
    }
    document.getElementById("my_form").reset();
    console.log(data);
}


