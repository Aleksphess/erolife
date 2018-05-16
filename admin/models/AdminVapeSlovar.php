<?php
/*
 *  Video
 * */

class admin_vape_slovar_categories extends AdminTable
{

    public $TABLE = 'vape_slovar_categories';
    public $IMG_SIZE = 537;
    public $IMG_VSIZE = 242;
    public $IMG_RESIZE_TYPE = 5;
    public $IMG_BIG_SIZE = 740;
    public $IMG_BIG_VSIZE = 480;
    public $IMG_NUM = 0;
    public $ECHO_NAME = 'title';
    public $SORT = 'id DESC';
    public $FIELD_UNDER = 'category_id';
    public $NAME = "Буква";
    public $NAME2 = "букву";

    public $MULTI_LANG = 1;

    function __construct()
    {

        $this->fld[] = new Field("title","Заголовок",1, array('multiLang'=>1));

        $this->fld[] = new Field("alias","Alias (геренерируеться, если не заполнен)",1);
        $this->fld[] = new Field("category_id","Находится в разделе",9,array(
            'showInList'=>0, 'editInList'=>0, 'valsFromTable'=>'vape_slovar_categories', 'valsFromCategory'=>-1,
            'valsEchoField'=>'title'));
        $this->fld[] = new Field("creation_time","Date of creation",4);
        $this->fld[] = new Field("update_time","Date of update",4);
    }

    function afterAdd($row) {
        if (empty($row['alias'])) {
            $qup = "UPDATE " . $this->TABLE . " SET alias = '" . Translit($row['title_1']) ."' WHERE id = "
                . $row['id'];
            pdoExec($qup);
        }


    }

    function afterEdit($row){

        if (empty($row['alias'])) {
            $qup = "UPDATE " . $this->TABLE . " SET alias = '" . Translit($row['title_1'])."' WHERE id = "
                . $row['id'];
            pdoExec($qup);
        }


    }
}


class admin_vape_slovar extends AdminTable
{

    public $TABLE = 'vape_slovar';
    public $IMG_SIZE = 537;
    public $IMG_VSIZE = 242;
    public $IMG_RESIZE_TYPE = 5;
    public $IMG_BIG_SIZE = 740;
    public $IMG_BIG_VSIZE = 480;
    public $IMG_NUM = 0;
    public $ECHO_NAME = 'title';
    public $SORT = 'id DESC';
    public $FIELD_UNDER     = "category_id";
    public $NAME = "слово";
    public $NAME2 = "слово";

    public $MULTI_LANG = 1;

    function __construct()
    {

        $this->fld[] = new Field("title","Заголовок",1, array('multiLang'=>1));
        $this->fld[] = new Field('description','Описание',2,['multiLang'=>1]);
        $this->fld[] = new Field("category_id","Находится в разделе",9,array(
            'showInList'=>0, 'editInList'=>0, 'valsFromTable'=>'vape_slovar_categories', 'valsFromCategory'=>-1,
            'valsEchoField'=>'title'));
//        $this->fld[] = new Field("custom_date","Дата публикации",13,array('showInList'=>1));
        $this->fld[] = new Field("creation_time","Date of creation",4);
        $this->fld[] = new Field("update_time","Date of update",4);
    }




}