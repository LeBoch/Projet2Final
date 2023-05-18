<?php
class UserManager extends ManagerBase
{
	protected $table = 'users';
	protected $class = User::class;

	public function add(User $user)
	{
		$q = $this->_db->prepare('INSERT INTO users(nom,prenom,type,mail,mdp,credit) VALUES(:nom, :prenom, :type, :mail, :mdp, :credit)');
		$q->bindValue(':nom', $user->getNom());
		$q->bindValue(':prenom', $user->getPrenom());
		$q->bindValue(':type', $user->getType());
		$q->bindValue(':mail', $user->getMail());
		$q->bindValue(':mdp', $user->getMdp());
		$q->bindValue(':credit', $user->getCredit());

		$q->execute();

		$user->hydrate(['Id' => $this->_db->lastInsertId()]);
	}

	public function getUser($sonMail)
	{
		$q= $this->_db->query('SELECT Id, Nom, Prenom, Mail, Mdp, Type FROM users WHERE Mail = "'. $sonMail .'"');
		$userInfo = $q->fetch(PDO::FETCH_ASSOC);
		if ($userInfo)
		{
			return new User($userInfo);
		}	
		else
		{
			return null;
		}
	}

	public function count()
	{
		return $this->_db->query("SELECT COUNT(*) FROM users")->fetchColumn();
	}

	public function exists($mailUser, $mdpUser)
	{
		$q= $this->_db->prepare('SELECT COUNT(*) FROM users WHERE mail = :mail AND mdp = :mdp');
		$q->execute([':mail'=> $mailUser, ':mdp'=> $mdpUser]);
		return (bool) $q->fetchColumn();
	}

	public function updateCredit(User $user, int $newCredit)
	{
		$UdaptCredit=$this->_db->prepare('UPDATE users SET Credit = :Credit where Id=:IdUser');
		$UdaptCredit->execute([
			'IdUser'=>$user->getId(),
			'Credit'=>$newCredit
		]);

		if ($UdaptCredit->rowCount() === 1) {
			$user->setCredit($newCredit);
		}
	}
}
?>