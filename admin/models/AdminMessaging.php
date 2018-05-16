<?php

class admin_messaging extends AdminTable
{

    public $TABLE           = 'messaging';
    public $IMG_SIZE        = 223; // макс высота
    public $IMG_VSIZE       = 140;
    public $IMG_RESIZE_TYPE = 1; //рeсайз по высоте
    public $IMG_BIG_SIZE    = 740;
    public $IMG_BIG_VSIZE   = 480;
    public $IMG_NUM         = 0;
    public $ECHO_NAME       = 'email';

    public $NAME            = "Почты";
    public $NAME2           = "почта";

    public $MULTI_LANG      = 0;

    function __construct()
    {

        $this->fld[] = new Field("email","почта",1);

        $this->fld[] = new Field("sort","SORT",4);
        $this->fld[] = new Field("creation_time","Date of creation",4);
        $this->fld[] = new Field("update_time","Date of update",4);
    }


}