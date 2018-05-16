<?php

class admin_recipe_categories extends AdminTable
{

    public $TABLE = 'recipe_categories';
    public $IMG_SIZE = 370; // макс высота
    public $IMG_VSIZE = 240;
    public $IMG_RESIZE_TYPE = 5; //рeсайз по высоте
    public $IMG_BIG_SIZE = 47 ;
    public $IMG_BIG_VSIZE = 87;
    public $IMG_NUM = 0;
    public $ECHO_NAME = 'title';
    public $SORT = 'sort DESC';
    public $RUBS_NO_UNDER = 1;
    public $FIELD_UNDER = 'category_id';
    public $IMG_TYPE = 'png';
    public $NAME = "Категории рецептов";
    public $NAME2 = "категорию";

    public $MULTI_LANG = 1;

    function __construct()
    {
        $this->fld[] = new Field("title","Заголовок",1, array('multiLang'=>1));
        $this->fld[] = new Field("alias","Alias (генерируеться, если не заполнен)",1);

        $this->fld[] = new Field("active","Активна",6,array('showInList'=>1, 'editInList'=>1));
        $this->fld[] = new Field("category_id","Относится к категории",9, [
            'showInList'=>0, 'editInList'=>0, 'valsFromTable'=>'recipe_categories',
            'valsEchoField'=>'title']);
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

    function afterEdit($row)
    {
        $this->afterAdd($row);
    }
}
class admin_recipe extends AdminTable
{
    public $TABLE           = 'recipe';
    public $SORT            = 'id ASC';
    public $IMG_SIZE        = 252; // макс высота
    public $IMG_VSIZE       = 181;
    public $IMG_RESIZE_TYPE = 1; //рeсайз по высоте
    public $IMG_BIG_SIZE    = 418 ;
    public $IMG_BIG_VSIZE   = 389;
    public $IMG_NUM         = 1;
    public $ECHO_NAME       = 'title';
    public $IMG_TYPE        = 'jpg';
    public $RUBS_NO_UNDER   = 1;

    public $FIELD_UNDER     = 'category_id';
    public $NAME            = "Товар";
    public $NAME2           = "товара";

    public $MULTI_LANG = 1;


    function __construct()
    {
        $this->fld=array(

            new Field("status","Активный рецепт",6),
            new Field("alias","Алиас",1),
            new Field("authoe","Автор",1),
            new Field("rating","Рейтинг",1),
            new Field("category_id","Относится к категории",9, [
                'showInList'=>0, 'editInList'=>0, 'valsFromTable'=>'recipe_categories',
                'valsEchoField'=>'title']),

            new Field("title","Заголовок",1, array('multiLang'=>1)),
            new Field("short_text","Короткое описане",16, array('multiLang'=>1)),
            new Field("text","Текст",2, array('multiLang'=>1)),
            new Field("time_to_good","Время созревания",1),
            new Field("PG","PG",1),
            new Field("VG","VG",1),
            new Field("assoc_10ml","состав для 10 мл ",5),
            new Field("assoc_30ml","состав для 30 мл ",5),
            new Field("assoc_50ml","состав для 50 мл",5),
            /* new Field("assoc_topic","топики",4),*/
            new Field("sort","SORT",4),
            new Field("creation_time","Date of creation",4),
            new Field("update_time","Date of update",4),

        );
    }

    function afterAdd($row)
    {
        if (empty($row['alias'])) {
            $qup = "UPDATE ".$this->TABLE." SET alias = '" . Translit($row['title_1'])."' WHERE id = " . $row['id'];
            pdoExec($qup);
        }

    }

    function afterEdit($row)
    {
        $this->afterAdd($row);
    }



    function show_assoc_10ml($row)
    {
        if (empty($row['id'])) {
            $row['id'] = rand(100000,999999);
        }

        return genAssocBlockGouples(['name' => 'Состав 10мл', 'id' => $row['id'], 'tableRubsAssoc' => 'consist_products_assoc_10ml']);
    }
    function show_assoc_30ml($row)
    {
        if (empty($row['id'])) {
            $row['id'] = rand(100000,999999);
        }
        return genAssocBlockGouples(['name' => 'Состав 30мл', 'id' => $row['id'], 'tableRubsAssoc' => 'consist_products_assoc_30ml']);
    }
    function show_assoc_50ml($row)
    {
        if (empty($row['id'])) {
            $row['id'] = rand(100000,999999);
        }
        return genAssocBlockGouples(['name' => 'Состав 50мл', 'id' => $row['id'], 'tableRubsAssoc' => 'consist_products_assoc_50ml']);
    }
}

class admin_consist_products_assoc_10ml
{
    public $tableRubs   = 'catalog_products';
    public $tableItems  = 'recipe';
    public $colUnder    = 'product_id';
    public $colRecord   = 'recipe_id';
};
class admin_consist_products_assoc_30ml
{
    public $tableRubs   = 'catalog_products';
    public $tableItems  = 'recipe';
    public $colUnder    = 'product_id';
    public $colRecord   = 'recipe_id';
};
class admin_consist_products_assoc_50ml
{
    public $tableRubs   = 'catalog_products';
    public $tableItems  = 'recipe';
    public $colUnder    = 'product_id';
    public $colRecord   = 'recipe_id';
};