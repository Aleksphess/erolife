<?php

/*
 * Redirects
 */

class admin_redirect extends AdminTable
{
    public $TABLE       = 'redirect';
    public $ECHO_NAME   = 'redirect_from';
    public $FIELD_UNDER = 'parent_id';
    public $NAME        = "редиректы";
    public $NAME2       = "редирект";
    public $SORT        = "id ASC";

    function __construct()
    {
        $this->fld[] = new Field("redirect_from","Редирект (откуда)",1);
        $this->fld[] = new Field("redirect_to","Редирект (куда)",1, ['showInList' => 1]);
        $this->fld[] = new Field("comment","Комментарий",2, ['showInList' => 1]);
        $this->fld[] = new Field("creation_time","Date of creation",4);
    }
}