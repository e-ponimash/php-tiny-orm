<?php
namespace App\Controller;

use App\Application;
use App\ValidateException;

class UserTarifController extends UserServiceController
{
    public function action($user_id, $service_id)
    {
        $requestData = Application::getInstance()->getRequestBody();
        if( !isset($requestData->tarif_id) ){
            throw new ValidateException('Неправильные входные данные');
        }

        $service = $this->getUserService($user_id, $service_id);
        $tarif = $service->getTarif();

        $newTarif = $this->getEm()->getRepository('\App\Model\Tarif')->findOneById($requestData->tarif_id);

        if (is_null($newTarif)){
            throw new ValidateException('Тариф не найден.');
        }

        if( $tarif->getId() == $newTarif->getId() ){
            throw new ValidateException('Нельзя поменять тариф на тот же самый');
        }
        if ($tarif->getTarifGroupId() == $newTarif->getTarifGroupId()){
            $service->setTarif($newTarif);
            $service->setPayday($newTarif->getNewPayDate());

            $this->getEm()->persist($service);
            $this->getEm()->flush();
        } else {
            throw new ValidateException('Данный тариф недоступен.');
        }
    }
}