<?php



class admin_menu extends AdminTable
{
    public $TABLE = 'menu';
    public $IMG_NUM = 0;
    public $IMG_SIZE = 760;
    public $IMG_VSIZE = 425;
    public $IMG_RESIZE_TYPE = 1;
    public $IMG_BIG_SIZE = 1130;
    public $IMG_BIG_VSIZE = 488;
    public $ECHO_NAME = 'title';
    public $SORT = 'sort DESC';
    public $NAME = "меню";
    public $NAME2 = "пункт меню";
    public $MULTI_LANG = 1;



    function __construct()
    {

        $this->fld[] = new Field("title", "название", 1, array('multiLang' => 1));
        $this->fld[] = new Field("alias", "alias", 1);
        $this->fld[] = new Field("sort", "SORT", 4);
        $this->fld[] = new Field("creation_time", "Date of creation", 4);
        $this->fld[] = new Field("update_time", "Date of update", 4);
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