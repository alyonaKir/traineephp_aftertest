<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="/assets/css/btn_users.css" rel="stylesheet">
    <script src="/assets/javascript/confirm.js"></script>
    <title>All users</title>
</head>
<?php
function showAll($users)
{
    ?>
    <body>
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Email</th>
            <th scope="col">Name</th>
            <th scope="col">Gender</th>
            <th scope="col">Active</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($users as $row) {
            ?>
            <tr>
                <td><?php echo $row->getId(); ?></td>
                <td><?php echo $row->getEmail(); ?></td>
                <td><?php echo $row->getName(); ?></td>
                <td><?php echo $row->getGender(); ?></td>
                <td><?php echo $row->isActive() ? "yes" : "no"; ?></td>
                <td>
                    <form method="post" action="http://<?php echo $_SERVER["HTTP_HOST"]?>/user/delete/<?php echo $row->getId();?>" onsubmit="return deleletconfig()">
                        <button name="btnDel" class="w-50 btn btn-lg btn-primary" type="submit" value="btnClick">Delete user</button>
                    </form>
                    <form method="post" action="http://<?php echo $_SERVER["HTTP_HOST"]?>/user/edit/<?php echo $row->getId(); ?>">
                        <button name="btnEdit" class="w-50 btn btn-lg btn-primary" type="submit" value="btnClick">Edit user</button>
                    </form>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php include 'back_button.php'?>
    </body>
    <?php ;
} ?>
</html>
