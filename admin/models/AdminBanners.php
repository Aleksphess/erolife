<?php
/*
 *  Баннеры
 * 
 */

class admin_banners extends AdminTable
{
    public $SORT            = 'sort DESC';
    public $TABLE           = 'banners';
    public $IMG_BIG_SIZE    = 225;
    public $IMG_BIG_VSIZE   = 426;
    public $IMG_NUM         = 1;
    public $ECHO_NAME       = 'name';
    public $IMG_SIZE        = 225; //- размер маленькой картинки
    public $IMG_VSIZE       = 426; //- размер маленькой картинки
    public $IMG_RESIZE_TYPE = 1;
    public $NAME            = "Баннеры";
    public $NAME2           = "баннер";

    public $MULTI_LANG      = 0;
    public $USE_TAGS        = 0;
    
    function __construct()
    {
        $this->fld=array(
            new Field("name","Название",1),
            new Field("href_url","Ссылка",1),
//            new Field("title_top","Заголовок",1, array('multiLang'=>1)),

            //new Field("title_mid","Заголовок (середина)",1, array('multiLang'=>1)),
            //new Field("button_color","Цвет кнопки (Формат: #ХХХХХХ)",1),
            new Field("sort","SORT",4),
            new Field("status","Отображать",6, array('showInList'=>1, 'editInList'=>1)),
            new Field("creation_time","Date of creation",4),
            new Field("update_time","Date of update",4),
        );       
    }
    
   
}