<?php
class Db_tree extends Model {

    function createSlice($data)
    {
        //".$data['message']['conversation']."
        $this->sql->exec("
            INSERT INTO tree
            VALUES ('', '".$_SESSION['user']['id']."', 'slice', 'objetid')
            "); 
    }


/*
    function mytree($data)
    {
        $requeteBase = $this->sql->query('
            SELECT t.id_parent_slice, b.name, t.id
            FROM tree t

            LEFT JOIN objet b
            ON t.id_objet = b.id

            WHERE t.id_user = "'.$_SESSION['user']['id'].'"
            ');
        return ($requeteBase);
    }    
*/

}