<?php
/*
 *  Баннеры
 *
 */

class admin_brands extends AdminTable
{
    public $SORT            = 'sort DESC';
    public $TABLE           = 'brands';
    public $IMG_BIG_SIZE    = 207;
    public $IMG_BIG_VSIZE   = 207;
    public $IMG_NUM         = 1;
    public $ECHO_NAME       = 'title';
    public $IMG_SIZE        = 458; //- размер маленькой картинки
    public $IMG_VSIZE       = 206; //- размер маленькой картинки
    public $IMG_RESIZE_TYPE = 1;
    public $NAME            = "Бренды";
    public $NAME2           = "бренд";

    public $MULTI_LANG      = 1;
    public $USE_TAGS        = 0;

    function __construct()
    {
        $this->fld=array(
            new Field("title","Название",1,['multiLang'=>1]),
            new Field("alias","alias",1),
            new Field("logo","Лого для главной(png)",11),
            new Field("txt","Текст",2,['multiLang'=>1]),
            new Field("sort","SORT",4),
            new Field("active","Отображать",6, array('showInList'=>1, 'editInList'=>1)),
            new Field("creation_time","Date of creation",4),
            new Field("update_time","Date of update",4),
        );
    }

    function afterAdd($row)
    {

        if (empty($row['alias'])) {

            $qup = "UPDATE brands SET alias = '" . Translit($row['title_1']) . "' WHERE id = " . $row['id'];
            pdoExec($qup);
        }
    }

    function afterEdit($row)
    {

        if (empty($row['alias'])) {
            $qup = "UPDATE brands SET alias = '" . Translit($row['title_1']) . "' WHERE id = " . $row['id'];
            pdoExec($qup);
        }
    }
}