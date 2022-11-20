<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<?php function show (\Models\User $user):void{?>
<body>
<div id="nav">
    <form>
        <div class="form-floating">
            <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?php echo $user->getEmail();?>">
<!--            <label for="floatingInput"> </label>-->
        </div>
        <div class="form-floating">
            <input name="name" type="text" class="form-control" id="floatingPassword" placeholder="Name" value="<?php echo $user->getName();?>">
<!--            <label for="floatingPassword">--><!--</label>-->
        </div>

        <div class="form-floating">
            <select name="gender" class="form-select" aria-label="Default select example" >
                <option value="male" <?php if($user->getGender()=="male") echo "selected";?>>male</option>
                <option value="female"<?php if($user->getGender()=="female") echo "selected";?>>female</option>
            </select>
        </div>

        <div class="form-floating">
            <select name="status" class="form-select" aria-label="Default select example">
                <option value="active" <?php if($user->isActive()) echo "selected";?>>active</option>
                <option value="inactive" <?php if(!$user->isActive()) echo "selected";?>>inactive</option>
            </select>
        </div>
    </form>

    <form method="post" action="http://<?php echo $_SERVER["HTTP_HOST"]?>/users/delete">
        <button name="btnAdd" class="w-100 btn btn-lg btn-primary" type="submit" value="btnClick">Delete user</button>
    </form>
    <form method="post" action="/users/edit">
        <button name="btnShow" class="w-100 btn btn-lg btn-primary" type="submit" value="btnClick">Edit users</button>
    </form>

    <form method="post" action="http://<?php echo $_SERVER["HTTP_HOST"]?>/">
        <button name="btnUpdate" class="w-100 btn btn-lg btn-primary" type="submit" value="btnClick">Return to main page</button>
    </form>


</div>
</body>
<?php }?>
</html>