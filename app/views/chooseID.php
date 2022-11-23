<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="/assets/css/style.css" rel="stylesheet">
    <title>Choose user ID</title>
</head>
<?php
function showAllID($users)
{
    ?>
    <body>
    <div id="nav">
        <form  action="http://<?php echo $_SERVER["HTTP_HOST"] ?>/user/1" method="post" name="userForm">
            <div class="form-floating">
                <select name="id" class="form-select" aria-label="Default select example">
                    <?php
                    foreach ($users as $row) {
                        ?>
                        <option value="<?php echo $row->getId(); ?>"><?php echo $row->getId(); ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Show user by ID</button>
        </form>
        <?php include 'back_button.php' ?>
    </div>
    </body>
    <?php
}

?>
</html>
