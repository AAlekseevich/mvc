<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 17.03.2020
 * Time: 0:48
 */

namespace App\File\Model;


use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';
    protected $fillable = ['user_id', 'file'];

    public function uploadPhoto($data)
    {
        File::firstOrCreate($data);
    }

    public function photoList($userId)
    {
        return File::where('user_id', '=', $userId)->get();
    }
}