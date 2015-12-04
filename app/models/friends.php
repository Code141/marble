<?php
class Db_friends extends Model {

	function showallmember()
	{
		$requeteBase = $this->sql->query('
			SELECT id, mail, firstname, lastname, birthday, gender FROM user WHERE id != "'.$_SESSION['user']['id'].'"
			');
		return ($requeteBase);
	}

	function showmember($memberid)
	{
		$requeteBase = $this->sql->query('
			SELECT id, mail, firstname, lastname, birthday, gender 
			FROM user
			WHERE id = "'.$memberid[0].'"
			');

		return ($requeteBase);
	}


	function getAllFriends($data)
	{
		$requeteBase = $this->sql->query('
			SELECT u.id, u.mail, u.firstname, u.lastname, u.birthday, u.gender
			FROM user u

			JOIN friends f ON u.id = f.id_friend
			JOIN friends fr ON f.id_friend = fr.id_user
			WHERE f.id_user = "'.$_SESSION['user']['id'].'"
			AND fr.id_user = f.id_friend
			AND f.id_user = fr.id_friend
			');
		return ($requeteBase);
	}


	function activities($memberid)
	{
		$requeteBase = $this->sql->query('
			SELECT o.name AS objet, p.name AS adjectif, m.score, m.date, m.id
			FROM marble m

			LEFT JOIN tree t
			ON m.id_slice = t.id

			LEFT JOIN objet o
			ON t.id_objet = o.id

			LEFT JOIN objet p
			ON m.id_adjectif = p.id

			WHERE t.id_user = "'.$memberid[0].'"
			ORDER BY m.date DESC
			');

		return ($requeteBase);
	}

	function allactivities()
	{
		$requeteBase = $this->sql->query('
			SELECT o.name AS objet, p.name AS adjectif, m.score, m.date, u.firstname, u.id AS id_user, p.id AS adjectif_id, o.id AS objet_id
			FROM marble m

			LEFT JOIN tree t
			ON m.id_slice = t.id

			LEFT JOIN objet o
			ON t.id_objet = o.id

			LEFT JOIN objet p
			ON m.id_adjectif = p.id

			LEFT JOIN user u
			ON t.id_user = u.id

			ORDER BY m.date DESC
			');

		return ($requeteBase);
	}

	function tree($memberid)
	{
		$requeteBase = $this->sql->query('
			SELECT t.id_parent_slice, b.name, t.id
			FROM tree t

			LEFT JOIN objet b
			ON t.id_objet = b.id

			WHERE t.id_user = "'.$memberid[0].'"
			');
		return ($requeteBase);
	}

	function isAFriend($data)
	{
		$requeteBase = $this->sql->query('
			SELECT id_user, id_friend
			FROM friends

			WHERE id_user = "'.$_SESSION['user']['id'].'"
			AND id_friend = "'.$data['whichuserid'].'"

			OR id_user = "'.$data['whichuserid'].'"
			AND id_friend = "'.$_SESSION['user']['id'].'"
			');
		return ($requeteBase);
	}

	function addFriend($data)
	{
		$this->sql->exec('
			INSERT INTO friends
			VALUES ("", "'.$_SESSION['user']['id'].'", "'.$data['whichuserid'].'");
			');
	}



}