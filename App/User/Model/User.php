<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 15.03.2020
 * Time: 19:17
 */

namespace App\User\Model;

use Base\Exception;
use Faker\Factory as Faker;
use Base\Session as Session;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['name', 'password', 'email', 'age', 'description', 'photo'];

    public function authorize($name, $password)
    {
        $user = User::where('name', '=' ,$name)->first();
        if ($user->password == $password) {
            $session = Session::instance();
            $session->save((int)$user->id);
            return true;
        }
        return false;
    }

    public function fakerSave()
    {
        $faker = Faker::create('en_EN');
        for($i = 0; $i<40; $i++) {
            $user = new User();
            $user->name = $faker->name;
            $user->password = $this->genPasswordHash($faker->password);
            $user->email = $this->genEmailFaker($user->name);
            $user->age = mt_rand(10, 60);
            $user->description = $faker->text;
            $user->photo = '';
            $user->save();
        }
    }

    public function saveToDb($data)
    {
        User::firstOrCreate($data);
    }

    public function getById($id)
    {
        return User::find($id);
    }

    public function getAllUsers()
    {
        return User::orderBy('age', 'asc')->get();
    }

    public function createUser($data)
    {
        User::firstOrCreate($data);
    }

    public function editUser($id, $data)
    {
        $user = User::find($id);
        foreach ($data as $key => $item){
            if(!empty($data[$key])) {
                $user->$key = $item;
            }
        }
        $user->save();
    }

    public function removeUser($id)
    {
        return User::destroy($id);
    }

    private function genPasswordHash($password)
    {
        $hash = md5($password);
        return $hash;
    }

    private function genEmailFaker($name)
    {
        $arr = array('Dr. ', 'sr.', 'Prof. ', 'Mr. ', 'Ms.', 'Mrs. ');
        $name = str_replace($arr, '', $name);
        $part = explode(' ', $name);
        $email = strtolower($part[0]) . mt_rand(1234, 8795) . '@gmail.com';
        return $email;
    }
}