<?php

/**
 * Created by PhpStorm.
 * User: kossworth
 * Date: 29.01.17
 * Time: 22:28
 *
 *  Обратный звонок
 * 
 */

class admin_callbacks extends AdminTable
{

    public $TABLE       = 'callbacks';
    public $IMG_NUM     = 0;
    public $ECHO_NAME   = 'name';
    public $SORT        = 'creation_time DESC';
    public $NAME        = "заявки";
    public $NAME2       = "заявку";

    function __construct()
    {
        $this->fld[] = new Field("name","Имя пользователя",1);
        $this->fld[] = new Field("status","Обработано",6,array('showInList'=>1, 'editInList'=>1));
        $this->fld[] = new Field("phone","Телефон пользователя",1, array('showInList'=>1, 'editInList'=>0));
        $this->fld[] = new Field("creation_time","Дата создания",4, array('showInList'=>1, 'editInList'=>0));
        $this->fld[] = new Field("update_time","Date of update",4);
    }
    
    function show_creation_time($row) 
    {
        return date("d.m.Y H:i" , $row['creation_time']);
    }

}


class admin_feedbacks extends AdminTable
{

    public $TABLE       = 'feedbacks';
    public $IMG_NUM     = 0;
    public $ECHO_NAME   = 'name';
    public $SORT        = 'creation_time DESC';
    public $NAME        = "заявки";
    public $NAME2       = "заявку";

    function __construct()
    {
        $this->fld[] = new Field("name","Имя пользователя",1);
        $this->fld[] = new Field("status","Обработано",6,array('showInList'=>1, 'editInList'=>1));
        $this->fld[] = new Field("email","email пользователя",1, array('showInList'=>1, 'editInList'=>0));
        $this->fld[] = new Field("text","Комментарий",1);
        $this->fld[] = new Field("creation_time","Дата создания",4, array('showInList'=>1, 'editInList'=>0));
        $this->fld[] = new Field("update_time","Date of update",4);
    }

    function show_creation_time($row)
    {
        return date("d.m.Y H:i" , $row['creation_time']);
    }

}
class admin_subscriptions extends AdminTable
{

    public $TABLE       = 'subscriptions';
    public $IMG_NUM     = 0;
    public $ECHO_NAME   = 'email';
    public $SORT        = 'creation_time DESC';
    public $NAME        = "заявки";
    public $NAME2       = "заявку";

    function __construct()
    {

        $this->fld[] = new Field("email","email пользователя",1, array('showInList'=>1, 'editInList'=>0));
        $this->fld[] = new Field("creation_time","Дата создания",4, array('showInList'=>1, 'editInList'=>0));
        $this->fld[] = new Field("update_time","Date of update",4);
    }

    function show_creation_time($row)
    {
        return date("d.m.Y H:i" , $row['creation_time']);
    }

}