<?php
class sudoku{
	public $sdke=null;//9行9列的二维数组，下标从0开始
	
	public function __construct()
	{
		for($i=0;$i<9;++$i)
		{
			for($j=0;$j<9;++$j)
			{
				$this->sdke[$i][$j]=new sudoku_element();
			}
		}
	}
	
	/**
	* 通过一维数组初始化已知值，一维数组应有81个元素，下标从0开始
	* return;
	*/
	public function initElementVal($arr)
	{
		for($i=0;$i<9;++$i)
		{
			for($j=0;$j<9;++$j)
			{
				if($arr[$i*9+$j!=''] && $arr[$i*9+$j]>0)
					$this->sdke[$i][$j]->setVal($arr[$i*9+$j]);
			}
		}
	}
	
	/**
	* 用九宫格里的值导出为一个一维数组，一维数组应有81个元素，下标从0开始
	*/
	public function getElementVal()
	{
		$arr=null;
		for($i=0;$i<9;++$i)
		{
			for($j=0;$j<9;++$j)
			{
				$val=$this->sdke[$i][$j]->getVal();
				if($val==0)
				{
					$val='';
					$cvals=$this->sdke[$i][$j]->getCVals();
					foreach($cvals as $v)
					{
						$val.=$v;
					}
				}
				$arr[$i*9+$j]=$val;
			}
		}
		return $arr;
	}
	
	public function getElementCVal()
	{
		$arr=null;
		for($i=0;$i<9;++$i)
		{
			for($j=0;$j<9;++$j)
			{
				$arr[$i*9+$j]=$this->sdke[$i][$j]->getCVals();
			}
		}
		return $arr;
	}
	
	public function calculate()
	{
		$i=100;
		while($this->isFinished()==false)
		{
			$this->calCV();
			$changed=false;
			do{
				$changed=$this->cv2val();
				$this->calCV();
			}while($changed);
			do{
				$changed=$this->uniqueCv2val();
				$this->calCV();
			}while($changed);
		}
	}
	
	public function isFinished()
	{
		for($i=0;$i<9;++$i)
		{
			for($j=0;$j<9;++$j)
			{
				if($this->sdke[$i][$j]->getVal()==0)
					return false;
			}
		}
		return true;
	}
	
	private function calCV()
	{
		for($i=0;$i<9;++$i)
		{
			for($j=0;$j<9;++$j)
			{
				if($this->sdke[$i][$j]->getVal()>0)
					continue;
				$this->sdke[$i][$j]->unclearCV();
				{//遍历宫格
					$rowbegin=floor($i/3)*3;
					$rowend=$rowbegin+3;
					$colbegin=floor($j/3)*3;
					$colend=$colbegin+3;
					//echo "rowbegin: $rowbegin <br />colbegin: $colbegin <br />";
					for($ii=$rowbegin;$ii<$rowend;++$ii)
					{
						for($jj=$colbegin;$jj<$colend;++$jj)
						{
							$val=$this->sdke[$ii][$jj]->getVal();
							if($val>0)
								$this->sdke[$i][$j]->delCV($val);
						}
					}
				}
				{//遍历行和列
					for($ii=0;$ii<9;++$ii)//遍历1列
					{
						$val=$this->sdke[$ii][$j]->getVal();
						if($val>0)
							$this->sdke[$i][$j]->delCV($val);
					}
					for($ii=0;$ii<9;++$ii)//遍历1行
					{
						$val=$this->sdke[$i][$ii]->getVal();
						if($val>0)
							$this->sdke[$i][$j]->delCV($val);
					}
				}
			}
		}
	}
	
	/**
	* 将候选值只剩一个的位置置值，并清空该位置的候选值
	*/
	public function cv2val()
	{
		$changed=false;
		for($i=0;$i<9;++$i)
		{
			for($j=0;$j<9;++$j)
			{
				if($this->sdke[$i][$j]->getVal()>0 || $this->sdke[$i][$j]->countCV()!=1)
					continue;
				$val=$this->sdke[$i][$j]->getCVal();
				$this->sdke[$i][$j]->setVal($val);
				$this->sdke[$i][$j]->clearCV();
				$changed=true;
			}
		}
		return $changed;
	}
	
	/**
	* 将候选值中的数字在九宫 行 列 中唯一的值置值，并清空该位置的候选值
	*/
	public function uniqueCv2val()
	{
		$changed=false;
		{//遍历宫格
			for($i=0;$i<3;++$i)
			{
				for($j=0;$j<3;++$j)
				{
					$tmpval=array_fill(1,9,array(0,0,0));
					$colbegin=$j*3;
					$colend=$colbegin+3;
					$rowbegin=$i*3;
					$rowend=$rowbegin+3;
					for($ii=$rowbegin;$ii<$rowend;++$ii)
					{
						for($jj=$colbegin;$jj<$colend;++$jj)
						{
							$val=$this->sdke[$ii][$jj]->getVal();
							if($val>0)
								continue;
							$cvals=$this->sdke[$ii][$jj]->getCVals();
							foreach($cvals as $val)
							{
								++$tmpval[$val][0];
								$tmpval[$val][1]=$ii;
								$tmpval[$val][2]=$jj;
								
							}
						}
					}
					//print_r($tmpval);
					//return;
					foreach($tmpval as $val)
					{
						if($val[0]==1)
						{
							$cval=$this->sdke[$val[1]][$val[2]]->getCVal();
							$this->sdke[$val[1]][$val[2]]->setVal($cval);
							$this->sdke[$val[1]][$val[2]]->clearCV();
							$changed=true;
							break;
						}
					}
				}
			}
		}
		$this->calCV();
		{//遍历所有列
			for($i=0;$i<9;++$i)
			{
				$tmpval=array_fill(1,9,array(0,0,0));
				for($j=0;$j<9;++$j)
				{
					$val=$this->sdke[$j][$i]->getVal();
					if($val>0)
						continue;
					$cvals=$this->sdke[$j][$i]->getCVals();
					foreach($cvals as $val)
					{
						++$tmpval[$val][0];
						$tmpval[$val][1]=$j;
						$tmpval[$val][2]=$i;
						
					}
				}
				foreach($tmpval as $val)
				{
					if($val[0]==1)
					{
						$cval=$this->sdke[$val[1]][$val[2]]->getCVal();
						$this->sdke[$val[1]][$val[2]]->setVal($cval);
						$this->sdke[$val[1]][$val[2]]->clearCV();
						$changed=true;
						break;
					}
				}
			}
		}
		$this->calCV();
		{//遍历所有行
			for($i=0;$i<9;++$i)
			{
				$tmpval=array_fill(1,9,array(0,0,0));
				for($j=0;$j<9;++$j)
				{
					$val=$this->sdke[$i][$j]->getVal();
					if($val>0)
						continue;
					$cvals=$this->sdke[$i][$j]->getCVals();
					foreach($cvals as $val)
					{
						++$tmpval[$val][0];
						$tmpval[$val][1]=$i;
						$tmpval[$val][2]=$j;
						
					}
				}
				foreach($tmpval as $val)
				{
					if($val[0]==1)
					{
						$cval=$this->sdke[$val[1]][$val[2]]->getCVal();
						$this->sdke[$val[1]][$val[2]]->setVal($cval);
						$this->sdke[$val[1]][$val[2]]->clearCV();
						$changed=true;
						break;
					}
				}
			}
		}
		return $changed;
	}
}





class sudoku_element{
	private $val=0;
	private $cvObj=null;
	
	public function __construct()
	{
		$this->cvObj=new sudoku_element_candidateVal();
	}
	
	/**
	* 设置元素的当前值
	* return;
	*/
	public function setVal($val)
	{
		$this->val=$val;
	}
	
	/**
	* 获取元素的当前值
	* return 当前元素的值;
	*/
	public function getVal()
	{
		return $this->val;
	}
	
	/**
	* 尝试向候选值中添加 $cVal
	* return;
	*/
	public function addCV($cVal)
	{
		$this->cvObj->addCV($cVal);
	}
	
	/**
	* 尝试从候选值中删除 $cVal
	* return;
	*/
	public function delCV($cVal)
	{
		$this->cvObj->delCV($cVal);
	}
	
	/**
	* 判断 $cVal 是否在候选值中 
	* return true 是; false 否;
	*/
	public function isCV($cVal)
	{
		return $this->cvObj->isCV($cVal);
	}
	
	/**
	* 将候选值置空
	* return;
	*/
	public function clearCV()
	{
		$this->cvObj->clearCV();
	}
	
	/**
	* 将候选值全置为有效
	* return;
	*/
	public function unclearCV()
	{
		$this->cvObj->unclearCV();
	}
	
	/**
	* 计算候选元素的个数
	* return 候选元素个数;
	*/
	public function countCV()
	{
		return $this->cvObj->countCV();
	}
	
	/**
	* 返回一个候选值
	*/
	public function getCVal()
	{
		return $this->cvObj->getCVal();
	}
	
	/**
	* 返回所有候选值组成的数组
	*/
	public function getCVals()
	{
		return $this->cvObj->getCVals();
	}
}




class sudoku_element_candidateVal{
	private $cv=null;//9个元素的一维boolean数组
	
	public function __construct()
	{
		$this->clearCV();
	}
	
	public function clearCV()
	{
		$this->cv=array_fill(0,9,false);
	}
	
	public function unclearCV()
	{
		$this->cv=array_fill(0,9,true);
	}
	
	public function isCV($cVal)
	{
		if($cVal<1 || $cVal>9)
			throw new Exception("参数不合法");
		else if($cVal>=1)
			return $this->cv[$cVal-1];
		else
			return false;
	}
	
	public function delCV($cVal)
	{
		if($cVal<1 || $cVal>9)
			throw new Exception("参数不合法");
		else
			$this->cv[$cVal-1]=false;
	}
	
	public function addCV($cVal)
	{
		if($cVal<1 || $cVal>9)
			throw new Exception("参数不合法");
		else
			$this->cv[$cVal-1]=true;
	}
	
	public function countCV()
	{
		$count=0;
		for($i=0;$i<9;++$i)
		{
			if($this->cv[$i]===true)
				++$count;
		}
		return $count;
	}
	
	public function getCVal()
	{
		for($i=0;$i<9;++$i)
		{
			if($this->cv[$i]===true)
				return $i+1;
		}
	}
	
	public function getCVals()
	{
		$arr=array();
		$index=0;
		for($i=0;$i<9;++$i)
		{
			if($this->cv[$i]===true)
			{
				$arr[$index++]=$i+1;
			}
		}
		return $arr;
	}
}
?>
