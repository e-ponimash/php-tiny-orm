<?php
namespace App\Controller;

use \App\Application;
use App\DB\Repository;
use App\ValidateException;
use \App\DB;
use \App\Model\User;
/**
 * Контроллер загрузки файла
 * @package App\Controller
 */

class UserServiceController extends BaseController {

    /**
     * Поиск пользователя по id
     * @param $user_id
     * @return array
     */
    public function findUser($user_id){
        $repository = new Repository(
            '\App\Model\User'
        );
        $user = $repository->findByID(2);

        return array(
            'result' => 'ok',
            'user' => $user
        );
    }

}