<?php

require_once('Model.php');

class User extends Model
{
    protected $table = 'users';

    // * (ユーザーを新規作成するメソッドの中身を追加する)
    public function create($data)
    {

    }

    // * (emailをもとにユーザーを取得するメソッド中身を追加する)
    public function findByEmail($data)
    {
        
    }
}
