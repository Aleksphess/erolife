<?php
/*
 *  Новости
 * */

class admin_news extends AdminTable
{
	
    public $TABLE           = 'news';
    public $IMG_SIZE        = 223; // макс высота 
    public $IMG_VSIZE       = 140; 
    public $IMG_RESIZE_TYPE = 1; //рeсайз по высоте
    public $IMG_BIG_SIZE    = 740;
    public $IMG_BIG_VSIZE   = 480;
    public $IMG_NUM         = 1;
    public $IMG_TYPE         = 'png';
    public $ECHO_NAME       = 'title';
    public $SORT            = 'sort DESC';

    public $NAME            = "Новости";
    public $NAME2           = "новость";

    public $MULTI_LANG      = 1;

    function __construct()
    {
        $this->fld[] = new Field("alias","Alias (геренерируеться, если не заполнен)",1);
        $this->fld[] = new Field("status","Опубликовать",6,array('showInList'=>1, 'editInList'=>1));

        $this->fld[] = new Field("title","Заголовок",1, array('multiLang'=>1));

        $this->fld[] = new Field("description","Короткое описание",16, array('multiLang'=>1));
        $this->fld[] = new Field("text","Текст",2, array('multiLang'=>1));
        $this->fld[] = new Field("sort","SORT",4);

        $this->fld[] = new Field("creation_time","Date of creation",4);
        $this->fld[] = new Field("update_time","Date of update",4);
    }

    function afterAdd($row) {            
        if (empty($row['alias'])) {
            $qup = "UPDATE " . $this->TABLE . " SET alias = '" . Translit($row['title_1'])."' WHERE id = "
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


class admin_discounts extends AdminTable
{

    public $TABLE           = 'news';
    public $IMG_SIZE        = 223; // макс высота
    public $IMG_VSIZE       = 140;
    public $IMG_RESIZE_TYPE = 1; //рeсайз по высоте
    public $IMG_BIG_SIZE    = 740;
    public $IMG_BIG_VSIZE   = 480;
    public $IMG_NUM         = 1;
    public $IMG_TYPE         = 'png';
    public $ECHO_NAME       = 'title';
    public $SORT            = 'sort DESC';

    public $NAME            = "Новости";
    public $NAME2           = "новость";

    public $MULTI_LANG      = 1;

    function __construct()
    {
        $this->fld[] = new Field("alias","Alias (геренерируеться, если не заполнен)",1);
        $this->fld[] = new Field("status","Опубликовать",6,array('showInList'=>1, 'editInList'=>1));

        $this->fld[] = new Field("title","Заголовок",1, array('multiLang'=>1));

        $this->fld[] = new Field("description","Короткое описание",16, array('multiLang'=>1));
        $this->fld[] = new Field("text","Текст",2, array('multiLang'=>1));
        $this->fld[] = new Field("sort","SORT",4);

        $this->fld[] = new Field("creation_time","Date of creation",4);
        $this->fld[] = new Field("update_time","Date of update",4);
    }

    function afterAdd($row) {
        if (empty($row['alias'])) {
            $qup = "UPDATE " . $this->TABLE . " SET alias = '" . Translit($row['title_1'])."' WHERE id = "
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


class admin_news_feedbacks extends AdminTable
{

    public $TABLE           = 'news_feedbacks';
    public $IMG_SIZE        = 223; // макс высота
    public $IMG_VSIZE       = 140;
    public $IMG_RESIZE_TYPE = 1; //рeсайз по высоте
    public $IMG_BIG_SIZE    = 740;
    public $IMG_BIG_VSIZE   = 480;
    public $IMG_NUM         = 0;
    public $IMG_TYPE         = 'png';
    public $ECHO_NAME       = 'name';
    public $SORT            = 'sort DESC';

    public $NAME            = "Отзывы новостей";
    public $NAME2           = "отзыв новостей";

    public $MULTI_LANG      = 0;

    function __construct()
    {
        $this->fld[] = new Field("name","Имя клиента",1);
        $this->fld[] = new Field("status","Опубликовать",6,array('showInList'=>1, 'editInList'=>1));

        $this->fld[] = new Field("text","Текст отзыва",16);
        $this->fld[] = new Field('parent_id','ОТтносится к новости', 9,array(
            'showInList'=>0, 'editInList'=>0, 'valsFromTable'=>'news',
            'valsEchoField'=>'title'));
        $this->fld[] = new Field("sort","SORT",4);

        $this->fld[] = new Field("creation_time","Date of creation",4);
        $this->fld[] = new Field("update_time","Date of update",4);
    }


}

class admin_product_feedbacks extends AdminTable
{

    public $TABLE           = 'product_feedbacks';
    public $IMG_NUM         = 0;
    public $IMG_TYPE         = 'png';
    public $ECHO_NAME       = 'name';
    public $SORT            = 'sort DESC';

    public $NAME            = "Отзывы продуктов";
    public $NAME2           = "отзыв продуктов";

    public $MULTI_LANG      = 0;

    function __construct()
    {
        $this->fld[] = new Field("name","Имя клиента",1);
        $this->fld[] = new Field("status","Опубликовать",6,array('showInList'=>1, 'editInList'=>1));

        $this->fld[] = new Field("text","Текст отзыва",16);
        $this->fld[] = new Field('parent_id','Относится к продукту', 9,array(
            'showInList'=>0, 'editInList'=>0, 'valsFromTable'=>'catalog_products',
            'valsEchoField'=>'name'));
        $this->fld[] = new Field("sort","SORT",4);

        $this->fld[] = new Field("creation_time","Date of creation",4);
        $this->fld[] = new Field("update_time","Date of update",4);
    }


}



