<?php
namespace App\Exceptions;

use App\User;
use App\Http\Controllers\baseapi;

class usernamefailed extends \Exception
{
    protected $id;

    function __construct($id = 0)
    {
        $this->id = $id;
        $user = new User();
        $user->passwordfail($id);
        parent::__construct($id . '山大密码有误');
    }

}
