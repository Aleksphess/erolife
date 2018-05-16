<?php
/*
 *  Языки
 * */

class admin_lang extends AdminTable
{
    public $TABLE           = 'lang';
    public $IMG_NUM         = 0;
    public $ECHO_NAME       = 'name';
    public $SORT            = 'id ASC';
    public $NAME            = "Языки";
    public $NAME2           = "язык";
    public $MULTI_LANG      = 0;

    function __construct()
    {
        $this->fld[] = new Field("name","Название", 1,['showInList'=>0, 'editInList'=>0]);
        $this->fld[] = new Field("url","URL", 1,['showInList'=>1, 'editInList'=>1]);
        $this->fld[] = new Field("by_default","По умолчанию",6);
        $this->fld[] = new Field("local","Локаль",1);
    }
    
//    function afterAdd($row) {            
//        
//    }
//    
//    function afterEdit($row){
//        
//    }
}