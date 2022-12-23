<?php
namespace App\controllers;
include 'vendor/autoload.php';

use Models\User;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class UserController
{
    private User $user;
    private $loader;
    private $twig;

    //private String $dbType;

    public function __construct()
    {
        if (isset($_SESSION['dbType']))
            $dbType = $_SESSION['dbType'];
        else
            $dbType = "db";
        $this->loader = new FilesystemLoader(__DIR__ . '/../views');
        $this->twig = new Environment($this->loader);
        if (isset($_POST['email']) && $_POST['email'] != null) {
            $email = $this->test_input($_POST["email"]);
            $name = $this->test_input($_POST["name"]);
            $gender = $this->test_input($_POST["gender"]);
            $status = $this->test_input($_POST["status"]);
            $this->user = new User($email, $name, $gender, $status == "active" ? 1 : 0, $dbType);
        } else {
            $this->user = new User('', '', '', 1, $dbType);
        }
    }

    public function createUser(): void
    {
        $url = "http://" . $_SERVER["HTTP_HOST"] . "/users/new";
        echo $this->twig->render('additionForm.twig', [
                'addUser' => $url,
                'mainPage' => 'http://' . $_SERVER["HTTP_HOST"]]
        );
    }

    private function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function newUser(): void
    {
        if (!$this->user->isUserExist() == 0 && $_SESSION['dbType'] == "db") {
            header('Location: http://' . $_SERVER["HTTP_HOST"] . '/users/create');
            exit();
        }
        $this->user->addUsertoDB();
        header('Location: http://' . $_SERVER["HTTP_HOST"]);
        exit();
    }

    public function showAll(): void
    {
//        ini_set ('display_errors', 'on');
        if (isset($_GET['page'])) {
            $pageno = $_GET['page'];
        } else {
            $pageno = 1;
        }
        $size_page = 10;
        $offset = ($pageno - 1) * $size_page;
        if ($_SESSION['dbType'] == "db") {
            $arrUsers = $this->user->showAllUsersFromDB($offset, $size_page);
        } else {
            $arrUsers = $this->user->showAllUsersFromDB($pageno, $size_page);
        }

        $delUrl = 'http://' . $_SERVER["HTTP_HOST"] . '/user/delete/';
        //$id=2891;

        echo $this->twig->render('showAll.twig', [
            'deleteChecked' => 'http://' . $_SERVER["HTTP_HOST"] . '/users/deleteChecked',
            'mainPage' => 'http://' . $_SERVER["HTTP_HOST"],
            'users' => $arrUsers,
            'page' => $pageno,
            'deleteUser' => $delUrl,
            'editUser' => 'http://' . $_SERVER["HTTP_HOST"] . '/user/',
            'total_pages' => ($this->user->getNumberPages() == 0) ? 1 : ($this->user->getNumberPages()),
        ]);
        if (isset($_GET['btnMain']) && $_GET['btnMain'] != null) {
            header('Location: http://' . $_SERVER["HTTP_HOST"]);
            exit();
        }
    }

    public function deleteChecked(): void
    {
        if (isset($_POST['btnCheck']) && $_POST['btnCheck'] != null && $_POST['users'] != null) {
            if (count($_POST['users']) >= 10 && $_SESSION['dbType'] == "db") {
                $this->user->clearUsers();
            } else {
                for ($i = 0; $i < count($_POST['users']); $i++) {
                    $this->user->deleteUserFromDB($_POST['users'][$i]);
                }
            }
        }
        header('Location: http://' . $_SERVER["HTTP_HOST"] . '/users');
        exit();
    }

    private function getIdFromURL(): int
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $url = $url[0];
        $url = explode('/', $url);
        return $url[count($url) - 1];
    }

    public function showByID(): void
    {
        $id = $_POST['id'] ?? $this->getIdFromURL();
        $user = $this->user->showUserByID($id);
        echo $this->twig->render('showByID.twig', [
            'user' => $user,
            'editUserID' => 'http://' . $_SERVER["HTTP_HOST"] . '/user/edit/' . $id,
        ]);
    }

    public function edit(): void
    {
        $id = $this->getIdFromURL();
        $this->user->setId($id);
        $this->user->editUserInfoInDB($this->user);
        header('Location: http://' . $_SERVER["HTTP_HOST"] . '/users');
        exit();
    }

    public function delete(): void
    {
        $id = $this->getIdFromURL();
        $this->user->deleteUserFromDB($id);
        header('Location: http://' . $_SERVER["HTTP_HOST"] . '/users');
        exit();
    }
}

?>
