<?php
/**
 * Created by PhpStorm.
 * User: kossworth
 * Date: 29.01.17
 * Time: 23:05
 */

/*
 *  Product Labels
 */

class admin_product_labels extends AdminTable
{
    public $TABLE       = 'product_labels';
    public $SORT        = 'id DESC';
    public $ECHO_NAME   = 'name';
    public $IMG_NUM     = 0;
    public $NAME        = 'Лейблы';
    public $NAME2       = 'лейбл';

    public $MULTI_LANG = 1;

    function __construct()
    {
        $this->fld=array(
            new Field("alias","Alias",1),
            new Field("name","Текст лейблы",1, array('multiLang' => 1)),
            new Field("template", "Шаблон", 10,
                array('showInList' => 0,
                    'values' => array(
                        'is--red',
                        'is--navy',
                        'is--yellow',
                        'is--green',
                        'is--blue',
                    )
                )
            ),
            new Field("update_time","Date of update",4),
            new Field("creation_time","Date of creation",4),
        );
    }

    function afterAdd($row) {
        if (empty($row['alias'])) {
            $qup = "UPDATE " . $this->TABLE . " SET alias = '" . Translit($row['name_1'])."-". $row['id'] ."' WHERE id = "
                . $row['id'];
            pdoExec($qup);
        }

        YandexTranslate($row, $this->TABLE);
    }

    function afterEdit($row){

        if (empty($row['alias'])) {
            $qup = "UPDATE " . $this->TABLE . " SET alias = '" . Translit($row['name_1'])."-". $row['id'] ."' WHERE id = "
                . $row['id'];
            pdoExec($qup);
        }

        YandexTranslate($row, $this->TABLE);
    }

}