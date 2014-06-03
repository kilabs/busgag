<?php
class ApiController extends CController
{
    public function init()
    {
        parent::init();

        Yii::app()->attachEventHandler('onError',array($this,'handleError'));
        Yii::app()->attachEventHandler('onException',array($this,'handleError'));
    }

    public function handleError(CEvent $event)
    {        
        if ($event instanceof CExceptionEvent)
        {
               $this->json(array(
                    'status'=>0,
                    'error'=>$event->getErrors(),
                ));
        }
        elseif($event instanceof CErrorEvent)
        {
            $this->json(array(
                'status'=>0,
                'error'=>$event->message,
            ));
        }
        $event->handled = TRUE;
    }

    public function json($data){
        header('Content-Type: application/json');
        echo CJSON::encode($data);
        Yii::app()->end();
        exit;
    }
}