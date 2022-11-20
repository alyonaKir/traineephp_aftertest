<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>All users</title>
</head>
<?php
function showAll($users){
?>
<body>
    <table class="table">
    <thead class="thead-light">
    <tr>
<!--        <th scope="col">Email</th>-->
<!--        <th scope="col">First</th>-->
<!--        <th scope="col">Last</th>-->
<!--        <th scope="col">Handle</th>-->
    </tr>
    </thead>
    <tbody>
    <?php
        foreach ($users as $row) {
    ?>
                <tr>
<!--                    <th scope="row"></th>-->
                    <td><?php echo $row ?></td>
<!--                    <td>Otto</td>-->
<!--                    <td>@mdo</td>-->
                </tr>

    <?php
        }
    ?>
    </tbody>
    </table>
</body>
<?php ;}?>
</html>
