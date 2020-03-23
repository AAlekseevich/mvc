<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 14.03.2020
 * Time: 19:14
 */

namespace App\User\Controller;

use Base\Context;
use Base\ControllerAbstract;
use App\User\Model\User as userModel;
use Base\Exception;
use Base\Request;
use Base\Session;
use Intervention\Image\ImageManager as Image;

class User extends ControllerAbstract
{
    private $imagePath;
    private $params;


    public function __construct()
    {
        /** @var Request $request */
        $request = Context::getInstance()->getRequest();
        $this->params = $request->getRequestParams();
    }


    public function loginAction()
    {
        $this->tpl = 'login.phtml';
        if($_POST) {
            $name = $_POST['login'];
            $password = $_POST['password'];
            $password = $this->genPasswordHash($password);

            $user = new userModel();
            try {
                $success = $user->authorize($name, $password);
                if (!$success) {
                    $error = 'Wrong login or password';
                }
            } catch (Exception $e) {
                $error = 'Sever error';
                trigger_error($e->getMessage());
                $success = false;
            }

            if ($success) {
                $this->redirect('/');
            } else {
                $this->view->error = $error;
                $this->tpl = 'register.phtml';
            }
        }
    }

    public function registerAction()
    {
        $this->tpl = 'register.phtml';

        if($_POST) {
            if(!empty($_FILES['photo']['tmp_name'])) {
                $tmpPhoto = $_FILES['photo']['tmp_name'];
                $namePhoto = $_FILES['photo']['name'];

                $this->imagePath = $_SERVER['DOCUMENT_ROOT'] . '/images/';
                $manager = new Image(array('driver' => 'gd'));
                $manager->make($tmpPhoto)->save($this->imagePath . $namePhoto);
                $photo = '/images/' . $namePhoto;
            }

            $data = [
                'name' => $_POST['login'],
                'password' => $this->genPasswordHash($_POST['password']),
                'email' => $_POST['email'],
                'age' => $_POST['age'],
                'description' => $_POST['description'],
                'photo' => empty($photo) ? '' : $photo,
            ];

            $user = new userModel();
            $user->saveToDb($data);
            $this->redirect('/');
        }
    }

    public function createAction()
    {
        $this->tpl = 'create.phtml';

        if($_POST) {
            if(!empty($_FILES['tmp_name'])) {
                $tmpPhoto = $_FILES['photo']['tmp_name'];
                $namePhoto = $_FILES['photo']['name'];

                $this->imagePath = $_SERVER['DOCUMENT_ROOT'] . '/images/';
                $manager = new Image(array('driver' => 'gd'));
                $manager->make($tmpPhoto)->save($this->imagePath . $namePhoto);
                $photo = '/images/' . $namePhoto;
            }

            $data = [
                'name' => $_POST['login'],
                'password' => $this->genPasswordHash($_POST['password']),
                'email' => $_POST['email'],
                'age' => $_POST['age'],
                'description' => $_POST['description'],
                'photo' => empty($photo) ? '' : $photo,
            ];

            $user = new userModel();
            $user->createUser($data);

            $this->redirect('/');
        }
    }

    public function editAction()
    {
        $this->tpl = 'edit.phtml';
        if($_POST) {
            $id = $this->params;

            if(!empty($_FILES['tmp_name'])) {
                $tmpPhoto = base64_decode($_FILES['photo']['tmp_name']);
                $namePhoto = $_FILES['photo']['name'];

                $this->imagePath = $_SERVER['DOCUMENT_ROOT'] . '/images/';
                $manager = new Image(array('driver' => 'gd'));
                $manager->make($tmpPhoto)->save($this->imagePath . $namePhoto);
                $photo = '/images/' . $namePhoto;
            }

            $data = [
                'name' => !empty($_POST['login']) ? $_POST['login'] : '',
                'password' => !empty($_POST['password']) ? $this->genPasswordHash($_POST['password']) : '' ,
                'email' => $_POST['email'],
                'age' => !empty($_POST['age']) ? $_POST['age'] : '',
                'description' => !empty($_POST['description']) ? $_POST['description'] : '',
                'photo' => !empty($photo) ? $photo : '',
            ];

            $user = new userModel();
            $user->editUser($id, $data);

            $this->redirect('/');
        }
    }

    public function removeAction()
    {
        $this->noRender();
        $id = $this->params;
        $user = new userModel();
        $user->removeUser($id);

        $this->redirect('/');
    }

    public function fillAction()
    {
        $user = new userModel();
        $user->fakerSave();
        $this->redirect('/');
    }

    public function logoutAction()
    {
        Session::destroy();
        $this->redirect('/');
    }

    private function genPasswordHash($password)
    {
        $hash = md5($password);
        return $hash;
    }
}