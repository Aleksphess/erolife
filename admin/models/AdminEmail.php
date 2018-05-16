<?php

    class admin_email extends AdminTable
    {

    public $TABLE           = 'email';
    public $IMG_SIZE        = 223; // макс высота
    public $IMG_VSIZE       = 140;
    public $IMG_RESIZE_TYPE = 1; //рeсайз по высоте
    public $IMG_BIG_SIZE    = 740;
    public $IMG_BIG_VSIZE   = 480;
    public $IMG_NUM         = 0;
    public $ECHO_NAME       = 'email';
    public $SORT            = 'sort';
    public $FIELD_UNDER     = "cat_id";
    public $NAME            = "Почта";
    public $NAME2           = "почту";

    public $MULTI_LANG      = 0;

        function __construct()
        {

            $this->fld[] = new Field("email","Почта",1);
            $this->fld[] = new Field("cat_id","Находится в разделе",9, array(
            'showInList'=>0, 'editInList'=>0, 'valsFromTable'=>'email_categories', 'valsFromCategory'=>-1,
            'valsEchoField'=>'title'));

            $this->fld[] = new Field("sort","SORT",4);
            $this->fld[] = new Field("creation_time","Date of creation",4);
            $this->fld[] = new Field("update_time","Date of update",4);
        }


    }

    class admin_email_categories extends AdminTable
    {

    public $TABLE           = 'email_categories';
    public $IMG_SIZE        = 223; // макс высота
    public $IMG_VSIZE       = 140;
    public $IMG_RESIZE_TYPE = 5; //рeсайз по высоте
    public $IMG_BIG_SIZE    = 740;
    public $IMG_BIG_VSIZE   = 480;
    public $IMG_NUM         = 0;
    public $ECHO_NAME       = 'title';
    public $SORT            = 'sort';
    public $FIELD_UNDER     = "cat_id";

    public $NAME            = "Категории рассылок";
    public $NAME2           = "категория";

    public $MULTI_LANG      = 0;

    function __construct()
    {
        $this->fld[] = new Field("title","Заголовок",1);
        $this->fld[] = new Field("cat_id","Находится в разделе",9, array(
        'showInList'=>0, 'editInList'=>0, 'valsFromTable'=>'email_categories', 'valsFromCategory'=>-1,
        'valsEchoField'=>'title'));
        $this->fld[] = new Field("sort","SORT",4);
        $this->fld[] = new Field("creation_time","Date of creation",4);
        $this->fld[] = new Field("update_time","Date of update",4);
    }


    }