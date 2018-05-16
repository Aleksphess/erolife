<?php
/*
 *  Публикации
 * */

class admin_publications extends AdminTable
{

    public $SORT = 'sort DESC';
	public $IMG_SIZE = 150;
	public $IMG_RESIZE_TYPE = 2;
	public $IMG_BIG_SIZE = 600;
	public $IMG_BIG_VSIZE = 315;
	public $IMG_NUM = 0;
	public $ECHO_NAME = 'name';
    
	public $NAME="Публикаци";
	public $NAME2="статью";
	
	public $MULTI_LANG = 1;
//	public $USE_TAGS = 1;
	
	function __construct()
	{
		$this->fld=array(
			new Field("alias","Alias (заповнювати не обов`язково)",1),
			new Field("name","Заголовок",1, array('multiLang'=>1)),
			//new Field("pub_date","Дата",13, array('showInList'=>1)),
            new Field("text","Текст",2, array('multiLang'=>1)),
          	new Field("hide","Не відображати",6, array('showInList'=>1)),
			
			new Field("sort","SORT",4),
			new Field("creation_time","Date of creation",4),
			new Field("update_time","Date of update",4),
		);
        

	}
    
    
    function afterAdd($row) {
        
        //saveAllCatRelations();
        
        if (empty($row['alias'])) {
			
				$parentAlias = '';
			
			
			
			$qup = "UPDATE publications SET alias = '" . Translit($parentAlias . $row['name_1'])."' WHERE id = " . $row['id'];
			pdoExec($qup);
		}
    }
    
    function afterEdit($row) {
        
        //saveAllCatRelations();
    }

	

};

?>
