<?php
class Db_message extends Model {

    function showmessage($data)
    {
        $requeteBase = $this->sql->query('
            SELECT u.firstname, m.id_user, m.conversation, m.date, m.message
            FROM message m
 
            LEFT JOIN user u
            ON u.id = m.id_user

            WHERE m.conversation = '.$data['message']['conversation'].'
            ORDER BY m.date
            ');
        return ($requeteBase);
    }

    function showconversation()
    {

        $requeteBase = $this->sql->query('

            SELECT u.firstname, c.conversation, u.id
            FROM conversation c

            LEFT JOIN conversation d
            ON c.conversation = d.conversation

            LEFT JOIN user u
            ON u.id = d.id_user

            WHERE c.id_user = '.$_SESSION['user']['id'].'
            AND c.conversation IN (c.conversation,d.conversation)
            AND d.id_user != '.$_SESSION['user']['id'].'
            ');

        return ($requeteBase);
    }

    function send($data)
    {
        $this->sql->exec("
            INSERT INTO message
            VALUES ('', '".$_SESSION['user']['id']."', '".$data['message']['conversation']."', '".$_POST['message']."', now())
            "); 
    }


    function doesconversationexist($data)
    {
        $requeteBase = $this->sql->query('

            SELECT *
            FROM conversation c

            LEFT JOIN conversation d
            ON c.conversation = d.conversation

            WHERE c.id_user = '.$_SESSION['user']['id'].'
            AND d.id_user = '.$data['message']['wichuser'].'
            
            OR d.id_user = '.$_SESSION['user']['id'].'
            AND c.id_user = '.$data['message']['wichuser'].'
            ');

        return ($requeteBase);
    }
}