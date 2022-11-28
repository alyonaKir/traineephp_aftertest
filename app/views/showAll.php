<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="/assets/css/btn_users.css" rel="stylesheet">
    <link href="/assets/css/media.css" rel="stylesheet">
    <script src="/assets/javascript/confirm.js"></script>
    <script src="/assets/javascript/infinityScroll.js"></script>
    <script src="/assets/javascript/selectAll.js"></script>
    <title>All users</title>
</head>
<?php
function showAll($users, $page, $offset, $total_pages)
{
    ?>
    <body>
    <form method="post" action="http://<?php echo $_SERVER["HTTP_HOST"] ?>/users/deleteChecked"
          onsubmit="return deleletconfig()">

        <a class="btn btn-primary" href="?page=1">First</a>
        <a class="btn <?php if ($page <= 1) {echo 'btn-secondary';} else {echo 'btn-primary';} ?>" href="<?php echo "?page=".($page-1); ?>">Prev</a>
        <a class="btn btn-primary <?php if ($page >= $total_pages) {echo 'btn-secondary';} else {echo 'btn-primary';} ?>" href="<?php if ($page >= $total_pages) {echo '#';} else {echo "?page=" . ($page + 1); $page++;} ?>">Next</a>
        <a class="btn btn-primary" href="?page=<?php echo $total_pages; $page=$total_pages?>">Last</a>
        <a class="btn btn-primary" href="http://<?php echo $_SERVER["HTTP_HOST"] ?>">Main Page</a>
        <button name="btnCheck" class="btn btn-primary" type="submit" value="btnClick">Delete checked</button>
    <table class="table" id ="data_preview">
        <thead class="thead-light">
        <tr>
            <th scope="col"></th>
            <th scope="col">ID</th>
            <th scope="col">Email</th>
            <th scope="col">Name</th>
            <th scope="col">Gender</th>
            <th scope="col">Active</th>
        </tr>
        </thead>
        <tbody>

        <input id="select_all" type="checkbox"> Select All
        <?php
//        for($i = $offset; $i < (min($offset + 10, count($users))); $i++){
        for($i = $offset; $i < (min($offset + 10, count($users))); $i++){
?>
        <div class="web-post" id="<?php echo $users[$i]->getId();?>">
            <tr>
                <td><input class="checkbox" type="checkbox" name="users[]" value="<?php echo $users[$i]->getId();?>"></td>
                <td><?php echo $users[$i]->getId(); ?></td>
                <td><?php echo $users[$i]->getEmail(); ?></td>
                <td><?php echo $users[$i]->getName(); ?></td>
                <td><?php echo $users[$i]->getGender(); ?></td>
                <td><?php echo $users[$i]->isActive() ? "yes" : "no"; ?></td>
                <td>
                    <form method="post"
                          action="http://<?php echo $_SERVER["HTTP_HOST"] ?>/user/delete/<?php echo $users[$i]->getId(); ?>"
                          onsubmit="return deleletconfig()">
                        <button name="btnDel" class="w-50 btn btn-lg btn-primary" type="submit" value="btnClick">Delete
                            user
                        </button>
                    </form>
                    <form method="post"
                          action="http://<?php echo $_SERVER["HTTP_HOST"] ?>/user/edit/<?php echo $users[$i]->getId(); ?>">
                        <button name="btnEdit" class="w-50 btn btn-lg btn-primary" type="submit" value="btnClick">Edit
                            user
                        </button>
                    </form>
                </td>
            </tr>
        </div>
            <?php
        }

        ?>

        </tbody>
    </table>

    </form>
    </body>
    <?php ;
} ?>
</html>
