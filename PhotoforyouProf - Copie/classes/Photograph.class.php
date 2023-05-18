<?php 

class photograph extends User
{
	private $_credit;

	public function getCredit()
	{
		return $this->_credit;
	}

	public function setCredit($credit)
	{
		$credit = (int) $credit;
		$this->_credit = $credit;
	}
}

?>
