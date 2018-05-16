<?php
/**
 * Created by PhpStorm.
 * User: kossworth
 * Date: 29.01.17
 * Time: 22:39
 */


class admin_shares extends AdminTable
{

    public $TABLE = 'shares';
    public $IMG_SIZE = 537; // макс высота
    public $IMG_VSIZE = 242;
    public $IMG_RESIZE_TYPE = 5;
    public $IMG_BIG_SIZE = 700 ;
    public $IMG_BIG_VSIZE = 500;
    public $IMG_NUM = 1;
    public $ECHO_NAME = 'title';
    public $SORT = 'custom_date DESC, sort DESC';

    public $NAME = "Акции";
    public $NAME2 = "акцию";

    public $MULTI_LANG = 1;

    function __construct()
    {
        $this->fld[] = new Field("alias","Alias (геренерируеться, если не заполнен)",1);
        $this->fld[] = new Field("active","Опубликовать",6,array('showInList'=>1, 'editInList'=>1));
        $this->fld[] = new Field("price","Цена",1);
        $this->fld[] = new Field("custom_date","Дата публикации",13,array('showInList'=>1));
        $this->fld[] = new Field("title","Заголовок",1, array('multiLang'=>1));
        $this->fld[] = new Field("description","Анонс",2, array('multiLang'=>1));
        $this->fld[] = new Field("text","Текст",2, array('multiLang'=>1));
        $this->fld[] = new Field("sort","SORT",4);
        $this->fld[] = new Field("creation_time","Date of creation",4);
        $this->fld[] = new Field("update_time","Date of update",4);
    }

    function afterAdd($row) {
        if (empty($row['alias'])) {
            $qup = "UPDATE " . $this->TABLE . " SET alias = '" . Translit($row['title_1'])."-". $row['id'] ."' WHERE id = "
                . $row['id'];
            pdoExec($qup);
        }

        YandexTranslate($row, $this->TABLE);
    }

    function afterEdit($row){

        if (empty($row['alias'])) {
            $qup = "UPDATE " . $this->TABLE . " SET alias = '" . Translit($row['title_1'])."-". $row['id'] ."' WHERE id = "
                . $row['id'];
            pdoExec($qup);
        }

        YandexTranslate($row, $this->TABLE);
    }
}