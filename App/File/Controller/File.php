<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 17.03.2020
 * Time: 0:45
 */

namespace App\File\Controller;

use App\File\Model\File as fileModel;
use Base\ControllerAbstract;
use Intervention\Image\ImageManager as Image;

class File extends ControllerAbstract
{

    public function mainAction()
    {
        $this->tpl = 'file.phtml';
        if ($_FILES) {
            $tmpPhoto = $_FILES['photo']['tmp_name'];
            $namePhoto = $_FILES['photo']['name'];

            $this->imagePath = $_SERVER['DOCUMENT_ROOT'] . '/images/';
            $manager = new Image(array('driver' => 'gd'));
            $image = $manager->make($tmpPhoto)->save($this->imagePath . $namePhoto);
            $photo = '/images/' . $namePhoto;

            $data = ['user_id' => $_SESSION['user_id'], 'file' => $photo];
            $file = new fileModel();
            $file->uploadPhoto($data);
        }
    }
}