<?php
namespace App\controllers;

class UserController
{
    public function createUser(): void
    {
        if ($_POST['btnAdd'] != null) {
            require "app/views/new.php";
        }
    }

    public function newUser(): void
    {
        if (isset($_POST['btnAdd'])) {
            //var_dump($_POST);
            // $user = new User($_POST['email'], $_POST['name'], $_POST['gender'], $_POST['status'] == "active");
            //$user = new User();
            $email = $_POST['email'];
            $name = $_POST['name'];
            $gender = $_POST['gender'];
            $status = $_POST['status'] == "active";

            $db_host = "localhost";
            $db_user = "root";
            $db_password = "mynewpassword";
            $db_base = 'Users';
            $db_table = 'user';

            try {
                $db = new \PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);
                $db->exec("set names utf8");
                $data = array('email' => $email, 'name' => $name, 'gender' => $gender, 'status' => $status);
                $query = $db->prepare("INSERT INTO $db_table(email, name, gender, active) values(:email, :name, :gender, :status)");
                $query->execute($data);
                $result = true;
            } catch (\PDOException $e) {
                print "Error: " . $e->getMessage() . "<br/>";
            }

            if ($result) {
                echo "<script>alert('We added information into database!')</script>";
            }
        }

        require "app/views/mainPage.php";
    }

    public function show($id): void
    {
        require "app/views/showAll.php";
        $conn = new \mysqli("localhost", "root", "mynewpassword", "Users");
        if ($conn->connect_error) {
            die("Ошибка: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM user";
        if ($result = $conn->query($sql)) {
            $rowsCount = $result->num_rows; // количество полученных строк
            echo "<table>";
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["gender"] . "</td>";
                echo "<td>" . $row["active"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            $result->free();
        } else {
            echo "Ошибка: " . $conn->error;
        }
        $conn->close();
    }

    public function edit($id): void
    {
        echo 'edit';
        require "app/views/mainPage.php";
    }

    public function update(): void
    {
        echo 'update';
        if ($_POST['btnUpdate'] != null) {
            echo 'update';
            require "app/views/mainPage.php";
        }
    }

    public function delete($id): void
    {
        echo 'delete';
    }
}

?>
