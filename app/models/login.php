<?php
class Db_login extends Model {

    function takeUserByMail($data)
    {   
        $requeteBase = $this->sql->query("SELECT * FROM user WHERE mail='".$data['logmail']."'");
        return ($requeteBase);
    }

    function signUp($data)
    {   

        $this->sql->exec("
            INSERT INTO user
            VALUES ('', '".$data['checksingup']['logmail']."', '".$data['checksingup']['encrypted_logpass']."', '".$data['checksingup']['firstname']."', '".$data['checksingup']['lastname']."', '".$data['checksingup']['birthdate']."', '".$data['checksingup']['gender']."', now())
            "); 
        


    }


    
}