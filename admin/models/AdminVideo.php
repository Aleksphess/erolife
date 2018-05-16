<?php
/*
 *  Video
 * */

class admin_videos extends AdminTable
{
	
    public $TABLE = 'videos';
    public $IMG_SIZE = 537;
    public $IMG_VSIZE = 242;
    public $IMG_RESIZE_TYPE = 5;
    public $IMG_BIG_SIZE = 740;
    public $IMG_BIG_VSIZE = 480;
    public $IMG_NUM = 1;
    public $ECHO_NAME = 'title';
    public $SORT = 'id DESC';

    public $NAME = "Видео";
    public $NAME2 = "видео";

    public $MULTI_LANG = 1;

    function __construct()
    {
		
        $this->fld[] = new Field("title","Заголовок",1, array('multiLang'=>1));
        $this->fld[] = new Field("status","Опубликовать",6,array('showInList'=>1, 'editInList'=>1));
        $this->fld[] = new Field("youtube_url","Ссылка с YouTube",1);
        $this->fld[] = new Field("alias","Alias (геренерируеться, если не заполнен)",1);
//        $this->fld[] = new Field("custom_date","Дата публикации",13,array('showInList'=>1));
        $this->fld[] = new Field("description","Анонс",2, array('multiLang'=>1));
        $this->fld[] = new Field("text","Текст",2, array('multiLang'=>1));
        $this->fld[] = new Field("creation_time","Date of creation",4);
        $this->fld[] = new Field("update_time","Date of update",4);
    }
    
    function afterAdd($row) {            
        if (empty($row['alias'])) {
            $qup = "UPDATE " . $this->TABLE . " SET alias = '" . Translit($row['title_1'])."-". $row['id'] ."' WHERE id = " 
            . $row['id'];
            pdoExec($qup);
        }
        
        if (empty($row['custom_date'])) {

            $qup = "UPDATE projects SET custom_date = '"
                . gmdate('d.m.Y', $row['creation_time'])
                ."' WHERE id = " . $row['id'];
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
        
        if (empty($row['custom_date'])) {

            $qup = "UPDATE projects SET custom_date = '"
                . gmdate('d.m.Y', $row['creation_time'])
                ."' WHERE id = " . $row['id'];
            pdoExec($qup);
        }
        
        YandexTranslate($row, $this->TABLE);
    }
}