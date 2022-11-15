<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="/assets/css/style_btn.css" rel="stylesheet">
</head>
<body>
<div id="nav">
<form method="post" action="http://<?php echo $_SERVER["HTTP_HOST"]?>/users/create">
    <button name="btnAdd" class="w-100 btn btn-lg btn-primary" type="submit" value="btnClick">Add user</button>
</form>
<form method="post" action="http://<?php echo $_SERVER["HTTP_HOST"]?>/users">
    <button name="btnShow" class="w-100 btn btn-lg btn-primary" type="submit" value="btnClick">Show users</button>
</form>
<form method="post" action="http://<?php echo $_SERVER["HTTP_HOST"]?>/users/update">
    <button name="btnUpdate" class="w-100 btn btn-lg btn-primary" type="submit" value="btnClick">Update users</button>
</form>
</div>
</body>
</html>