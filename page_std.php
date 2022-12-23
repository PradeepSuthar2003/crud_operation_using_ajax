<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table{
            text-align:center;
        }
        ul{
            display:flex;
            list-style:none;
        }
        li{
            width:15px;
            height:20px;
            background-color:blue;
            margin:0 10px;
            text-align:center;
            color:white;
            cursor:pointer;
        }
        #active{
            background-color:yellowgreen;
        }
        input{
            width:80%;
            outline:none;
            border:none;
            border-radius:3px;
            background-color:grey;
            height:1.5rem;
            color:white;
            text-align:center;
        }
        ::placeholder{
            color:white;
            text-align:center;
        }
    </style>

    <script>
        
        const fetchRow = (pg_id=0) => {
            let xhttp = new XMLHttpRequest();
            xhttp.open("POST","paginition.php",true);
            xhttp.onload = () => {
                let rows = xhttp.response;

                let pages = Math.ceil((rows/3));

                let ul = document.getElementById("page");
                ul.innerHTML = "";
                for(let i=0;i<pages;i++){
                    if(i==pg_id){
                        active = "active";
                    }else{
                        active = "";
                    }
                    ul.innerHTML += `<li id="${active}" page="${i+1}" class="page_btn">${i+1}</li>`;
                }
                fetchPage();
            }
            xhttp.send();
            }

            fetchRow();
             

        const fetchData = () => {
            let xhttp = new XMLHttpRequest();
            xhttp.open("POST","std_data.php",true);
            xhttp.responseType = "json";
            xhttp.setRequestHeader("Content-Type","application/json");
            xhttp.onload = () => {
                let tbody = document.getElementById("content");
                tbody.innerHTML = "";
                x = xhttp.response;
                
                for(let i=0;i<x.length;i++){
                    tbody.innerHTML += `
                                <tr>
                                    <td>${x[i].sid}</td>
                                    <td>${x[i].sname}</td>
                                    <td>${x[i].saddress}</td>
                                    <td>${x[i].sclass}</td>
                                    <td>${x[i].sphone}</td>
                                </tr>
                                    `;
                }
            }
            xhttp.send();
        }
        fetchData();

        const fetchPage = () => {
                let page = document.getElementsByClassName('page_btn');
                id = 1;
                for(let i=0;i<page.length;i++){
                    page[i].addEventListener('click',() => { 
                        id = page[i].getAttribute('page');
                        let xhttp = new XMLHttpRequest();
                        xhttp.open("post","std_data.php",true);
                        xhttp.responseType="json";
                        xhttp.onload = () => {
                            console.log(xhttp.response);
                        let tbody = document.getElementById("content");
                        x = xhttp.response;
                        document.getElementById("content").innerHTML = "";
                        fetchRow(i);
                        for(let i=0;i<x.length;i++){
                            tbody.innerHTML += `
                                        <tr>
                                            <td>${x[i].sid}</td>
                                            <td>${x[i].sname}</td>
                                            <td>${x[i].saddress}</td>
                                            <td>${x[i].sclass}</td>
                                            <td>${x[i].sphone}</td>
                                        </tr>
                                            `;
                        }
                     }
                    let mydata = {page:id};
                    let data = JSON.stringify(mydata);
                    xhttp.send(data);
                    });
                }
            }
            
            fetchPage();

            const searchData = (inp) => {
                if(inp.length > 1){
                let xhttp = new XMLHttpRequest();
                xhttp.open("GET","searchData.php?search="+inp,true);
                xhttp.responseType = "json";
                xhttp.onload = () => {
                    let tbody = document.getElementById("content");
                    x = xhttp.response;
                    if(x != null){
                        tbody.innerHTML = "";
                        for(let i=0;i<x.length;i++){
                            tbody.innerHTML += `
                                        <tr>
                                            <td>${x[i].sid}</td>
                                            <td>${x[i].sname}</td>
                                            <td>${x[i].saddress}</td>
                                            <td>${x[i].sclass}</td>
                                            <td>${x[i].sphone}</td>
                                        </tr>
                                            `;
                        }
                    }else{

                        tbody.innerHTML = `<tr><td colspan="7">No Record Found</td></tr>`;
                    }
            
                }
                xhttp.send();
            }else{
                fetchRow();
                fetchData();
                fetchPage();
            }
        }
            
    </script>
</head>
<body>
    <table border="1" cellpadding="10" cellspacing="0" width="80%">
        <tr>
            <td colspan="7">Student</td>
        </tr>
        <tr>
            <td colspan="7"><input type="text" name="search" id="txt_search/" placeholder="Search Here !" autocomplete="off" onkeydown="searchData(this.value)"></td>
        </tr>
        <tr>
            <td>Roll No.</td>
            <td>Name</td>
            <td>Address</td>
            <td>Class</td>
            <td>Phone</td>
        </tr>
        <tbody id="content">
        </tbody>
    </table>
    <ul id="page">
    </ul>
</body>
</html>