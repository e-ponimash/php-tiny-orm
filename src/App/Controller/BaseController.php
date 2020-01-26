<?php
namespace App\Controller;

use App\ValidateException;

class BaseController
{
    /**
     * BaseController constructor.
     */
    public function __construct()
    {
    }

    /**
     *
     */
    public function execute(){
        try {
            $data = call_user_func_array([$this, 'action'], func_get_args());
            if( is_null($data) ){
                $data = [];
            }
            $response = array_merge(array(
                'result' => 'ok'
            ), $data );
        } catch (ValidateException $e){
            $response = array(
                'result' => 'error',
                'message' => $e->getMessage()
            );
        } catch (\Exception $e) {
            $response = array(
                'result' => 'error',
                'message' => 'Внутренняя ошибка'
            );
        }
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}