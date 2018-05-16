<?php
class admin_user_settings extends AdminTable
{
    public $TABLE               = 'user_settings';
    public $IMG_SIZE            = 300; // макс высота
    public $IMG_VSIZE           = 100;
    public $IMG_RESIZE_TYPE     = 5;
    public $IMG_BIG_SIZE        = 1000 ;
    public $IMG_BIG_VSIZE       = 333;
    public $IMG_NUM             = 0;
    public $ECHO_NAME           = 'id';
    public $SORT                = 'id DESC';

//    public $FIELD_UNDER         = 'parent_id';
    public $NAME                = "Настройка";
    public $NAME2               = "Настройку";

    function __construct()
    {
        $this->fld[] = new Field("menu","Меню для шаблона",16);

        




    }

}