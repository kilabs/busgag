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
                'error'=>$event->exception->getMessage(),
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

    public function toArray($models,$attr){
        $datas = array();
        foreach($models as $key=>$model){
            $data = array();
            foreach ($attr as $col => $value) {
                if(isset($model->$value)){
                    $this->_assignValue($data,$value,$col,$model->$value);
                }
                else if (  method_exists($model,$value) ) {
                    $_val = $model->$value();
                    $this->_assignValue($data,$value,$col,$_val);
                }
            }
            $datas[] = $data;
        }
        return $datas;
    }
    private function _assignValue(&$data,$name,$col,$value){
        if(is_string($col)){
            $data[$col] = $value;
        }
        else{
            $data[$name] = $value;
        }
    }
}