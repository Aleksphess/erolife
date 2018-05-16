<?php
/**
 * Created by PhpStorm.
 * User: kossworth
 * Date: 31.01.17
 * Time: 1:00
 */


class admin_main_slider extends AdminTable
{
    public $TABLE           = 'main_slider';
    public $IMG_NUM         = 1;
    public $IMG_SIZE        = 1470;
    public $IMG_VSIZE       = 530;
    public $IMG_RESIZE_TYPE = 1;
    public $IMG_BIG_SIZE    = 1470;
    public $IMG_BIG_VSIZE   = 530;
    public $ECHO_NAME       = 'href';
    public $SORT            = 'sort DESC';
    public $NAME            = "слайды";
    public $NAME2           = "слайд";
    public $MULTI_LANG      = 1;

    function __construct()
    {
        $this->fld[] = new Field("href","Ссылка",1);
        $this->fld[] = new Field("title","Заголовок",1, array('multiLang'=>1));
  //      $this->fld[] = new Field('mini_img','мини картинка',11);
        $this->fld[] = new Field("sort","SORT",4);
        $this->fld[] = new Field("creation_time","Date of creation",4);
        $this->fld[] = new Field("update_time","Date of update",4);
    }

}
