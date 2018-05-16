<?php
/*
 *  Словарь очепяток
 * */

class admin_search_dictionary extends AdminTable
{
	
    public $TABLE           = 'search_dictionary';
    public $IMG_NUM         = 0;
    public $ECHO_NAME       = 'incorrect';
    public $SORT            = 'creation_time DESC';
    public $NAME            = "Слова";
    public $NAME2           = "слово";
    public $MULTI_LANG      = 0;

    function __construct()
    {
        $this->fld[] = new Field("incorrect","Слово с опечаткой",1);
        $this->fld[] = new Field("correct","Правильная форма слова",1,['showInList'=>1, 'editInList'=>0]);
        $this->fld[] = new Field("lang_id","Язык",9, [
                'showInList'=>0, 'editInList'=>0, 'valsFromTable'=>'lang', 'valsFromCategory'=>null,
                'valsEchoField'=>'name']);
        $this->fld[] = new Field("creation_time","Date of creation",4);
    }
    
//    function afterAdd($row) {            
//        
//    }
//    
//    function afterEdit($row){
//        
//    }
}