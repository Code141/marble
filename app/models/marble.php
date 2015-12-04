<?php
class Db_marble extends Model {

    function allobjets($data)
    {
        $requeteBase = $this->sql->query('
            SELECT * FROM objet ORDER BY id
            ');
        return ($requeteBase);
    }

    function alladjectifs($data)
    {
        $requeteBase = $this->sql->query('
            SELECT * FROM objet ORDER BY id
            ');
        return ($requeteBase);
    }

    function mytree($data)
    {
        $requeteBase = $this->sql->query('
            SELECT t.id_parent_slice, b.name, t.id, t.id_objet
            FROM tree t

            LEFT JOIN objet b
            ON t.id_objet = b.id

            WHERE t.id_user = "'.$_SESSION['user']['id'].'"
            ORDER BY id_parent_slice
            ');
        return ($requeteBase);
    }

    function getTree($data)
    {
        $requeteBase = $this->sql->query('
            SELECT t.id_parent_slice, b.name, t.id, t.id_objet
            FROM tree t

            LEFT JOIN objet b
            ON t.id_objet = b.id

            WHERE t.id_user = "'.$data['idUser'].'"
            ORDER BY id_parent_slice
            ');
        return ($requeteBase);
    }

    function getObjetName($data)
    {
        $requeteBase = $this->sql->query('
            SELECT name FROM objet
            WHERE id = "'.$data['idObjet'].'"
            ');
        return ($requeteBase);
    }

    function searchObjets($data)
    {
        $requeteBase = $this->sql->query('
            SELECT * FROM objet
            WHERE name = "'.$data['research'].'"
            ');
        return ($requeteBase);
    }

    function searchAdjectifsByName($data)
    {
        $requeteBase = $this->sql->query('
            SELECT b.name, b.id, m.score
            FROM marble m

            LEFT JOIN tree t
            ON m.id_slice = t.id

            LEFT JOIN objet o
            ON t.id_objet = o.id

            LEFT JOIN objet b
            ON m.id_adjectif = b.id

            WHERE o.name = "'.$data['research'].'"
            ORDER BY m.score DESC

            ');
        return ($requeteBase);
    }
    
    function getSliceById($data)
    {
        $requeteBase = $this->sql->query('
            SELECT m.id, o.name, m.score, m.id_adjectif
            FROM marble m

            LEFT JOIN objet o
            ON m.id_adjectif = o.id

            WHERE m.id_slice = "'.$data['research'].'"
            ORDER BY m.date

            ');
        return ($requeteBase);
    }


    function searchSliceByObjetId($data)
    {
        $requeteBase = $this->sql->query('
            SELECT o.name, t.id, t.id_user
            FROM tree t

            LEFT JOIN tree r
            ON t.id_parent_slice = r.id

            LEFT JOIN objet o
            ON r.id_objet = o.id

            WHERE t.id_objet = "'.$data['research'].'"
            ');
        return ($requeteBase);
    }

    function updateParentSlice($data)
    {
        $requeteBase = $this->sql->query('
            UPDATE tree
            SET id_parent_slice = "'.$data['moveto'].'"
            WHERE ID = "'.$data['slicetomove'].'"
        ');
    }



    function searchByMetaphone($data)
    {
        $requeteBase = $this->sql->query('
            SELECT name, id
            FROM objet
            WHERE metaphone LIKE "'.metaphone($data['research']).'%"
            LIMIT 10
            ');
        return ($requeteBase);
    }

    function addAdjObjet($data)
    {
        $this->sql->exec('
            INSERT INTO objet
            VALUES ("", "'.$data['research'].'", "'.metaphone($data['research']).'");
            ');
    }

    function addSlice($data)
    {
        $this->sql->exec('
            INSERT INTO tree
            VALUES ("", "'.$_SESSION['user']['id'].'", "0", "'.$data['objetid'].'");
            ');
    }

    function addAdjSlice($data)
    {
        $this->sql->exec('
            INSERT INTO marble
            VALUES ("", "'.$data['slice'].'", "'.$data['id_add_adj'].'", "5", CURRENT_TIMESTAMP);
            ');
    }

    function destroyAdjSlice($data)
    {
        $this->sql->exec('
            DELETE FROM marble
            WHERE id="'.$data['destroyadjslice'].'"
            ');
    }    
}