<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Add user</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body>
<div id="nav">
    <form action="http://<?php echo $_SERVER["HTTP_HOST"]?>/users/new" method="post" >
        <div class="form-floating">
            <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
            <input name="name" type="text" class="form-control" id="floatingPassword" placeholder="Name">
            <label for="floatingPassword">Your first and last name</label>
        </div>

        <div class="form-floating">
            <select name="gender" class="form-select" aria-label="Default select example">
                <option value="male">male</option>
                <option value="female">female</option>
            </select>
        </div>

        <div class="form-floating">
        <select name="status" class="form-select" aria-label="Default select example">
            <option value="active">active</option>
            <option value="inactive">inactive</option>
        </select>
        </div>
        <button name="btnAdd" class="w-100 btn btn-lg btn-primary" type="submit" value="Add user">Add user</button>
    </form>
</div>
</body>
</html>