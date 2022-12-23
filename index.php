<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST" id="my_form">
    <input type="hidden" name="user_id" id="user_id" /><br>
    <label>Username : </label><br>
    <input type="text" name="username" id="txt_user"/><br>
    <label>Password : </label><br>
    <input type="text" name="username" id="txt_pass"/><br>
    <button id="insert_btn">Insert</button>
</form>

<div class="main">
    <table border="1" cellspacing="0" width="80%">
        <tr>
            <td>Userid</td>
            <td>Username</td>
            <td>Password</td>
            <td>Date</td>
            <td>Operation</td>
        </tr>
        <tbody id="tbody">

        </tbody>
    </table>
</div>

<script src="ajax.js"></script>
</body>
</html>