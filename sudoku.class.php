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
	public function setElementVals($arr)
	{
		for($i=0;$i<9;++$i)
		{
			for($j=0;$j<9;++$j)
			{
				//echo $arr[$i*9+$j]+"<br />";
				if($arr[$i*9+$j]!='' && intval($arr[$i*9+$j])>0)
					$this->sdke[$i][$j]->setVal($arr[$i*9+$j]);
			}
		}
	}
	
	/**
	* 用九宫格里的值导出为一个一维数组，一维数组应有81个元素，下标从0开始
	*/
	public function getElementVals()
	{
		$arr=null;
		for($i=0;$i<9;++$i)
		{
			for($j=0;$j<9;++$j)
			{
				$val=$this->sdke[$i][$j]->getVal();
				if($val==0)
				{
					$val='[';
					$cvals=$this->sdke[$i][$j]->getCVals();
					foreach($cvals as $v)
					{
						$val.=$v;
					}
					$val.=']';
				}
				
				//echo $val+"<br />";
				$arr[$i*9+$j]=$val;
			}
		}
		return $arr;
	}
	
	public function getElementCVals()
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
	
	/**
	* 利用之前初始化的数据计算最终结果
	* 由于经过基本的算法运算之后，仍然可能存在未确定的box，所以之后会使用递归来进行类似与暴力破解的运算，$depth用于限制递归的深度
	* $depth 为-1 时表示不限制深度，其它不小于或等于0的整数分别对应不同的深度，例如0 表示不进行任何运算, 1 表示只进行基本运算，2 表示进行一次爆破;
	* 外部进行调用时，$depth 应总是为2;
	*/
	public function calculate($depth)
	{
		if($depth!=-1 && $depth<=0)
			return;
		else if($depth!=-1)
		{
			--$depth;
		}
		$changed=false;
		$i=100;
		$this->calCV();
		
		//$this->cv2val();
		//$this->cv2val();
		do{
			$changed=$this->cv2val();
		}while($changed);
		if($this->isFinished()) return;
		
		do{
			$changed=$this->uniqueCV();
		}while($changed);
		if($this->isFinished()) return;
		
		do{
			$this->boxUniqueCV();
			$changed1=$this->cv2val()?true:false;
			$changed2=$this->uniqueCV()?true:false;
			$changed=$changed1 || $changed2;
		}while($changed);
		if($this->isFinished()) return;
		
		//$this->boxUniqueCV();
		if($depth==0) return;
		
		for($i=0;$i<9;++$i)
		{
			for($j=0;$j<9;++$j)
			{
				$sdkebak=$this->sdke;
				$cvals=$this->sdke[$i][$j]->getCVals();
				if(count($cvals)<=0) continue;
				foreach($cvals as $cc)
				{
					$vals=$this->getElementVals();
					$vals[$i*9+$j]=$cc;
					$newsudoku=new sudoku();
					$newsudoku->setElementVals($vals);
					$newsudoku->calculate($depth);
					if($newsudoku->isFinished())
					{
						$vals=$newsudoku->getElementVals();
						$this->setElementVals($vals);
						$this->calCV();
						return;
					}
				}
			}
		}
		
		/*while($i--)
		//while($this->isFinished()==false)
		{
			//$this->calCV();
			$changed=false;
			do{
				$changed=$this->cv2val();
				$this->calCV();
			}while($changed);
			do{
				$changed=$this->uniqueCv2val();
				$this->calCV();
			}while($changed);
		}*/
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
	
	/**
	* 根据已确定的值来得出候选值
	*/
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
				$this->delCV($i+1,$j+1,7,$val);
				$changed=true;
			}
		}
		return $changed;
	}
	
	/**
	* 将候选值中的数字在九宫 行 列 中唯一的值置为候选值
	*/
	public function uniqueCV()
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
					foreach($tmpval as $key=>$val)
					{
						if($val[0]==1)
						{
							//$cval=$this->sdke[$val[1]][$val[2]]->getCVal();
							//$this->sdke[$val[1]][$val[2]]->setVal($key);
							$this->sdke[$val[1]][$val[2]]->clearCV();
							$this->sdke[$val[1]][$val[2]]->addCV($key);
							//$changed=true;
							break;
						}
					}
				}
			}
		}
		if($this->cv2val())
		{
			$changed=true;
		}
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
				foreach($tmpval as $key=>$val)
				{
					if($val[0]==1)
					{
						//$cval=$this->sdke[$val[1]][$val[2]]->getCVal();
						//$this->sdke[$val[1]][$val[2]]->setVal($key);
						$this->sdke[$val[1]][$val[2]]->clearCV();
						$this->sdke[$val[1]][$val[2]]->addCV($key);
						//$changed=true;
						break;
					}
				}
			}
		}
		if($this->cv2val())
		{
			$changed=true;
		}
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
				foreach($tmpval as $key=>$val)
				{
					if($val[0]==1)
					{
						//$cval=$this->sdke[$val[1]][$val[2]]->getCVal();
						//$this->sdke[$val[1]][$val[2]]->setVal($key);
						$this->sdke[$val[1]][$val[2]]->clearCV();
						$this->sdke[$val[1]][$val[2]]->addCV($key);
						//$changed=true;
						break;
					}
				}
			}
		}
		if($this->cv2val())
		{
			$changed=true;
		}
		return $changed;
	}
	
	/**
	* 遍历九个九宫格，对于每个九宫格，遍历每一行每一列，对于每一行每一列，若候选值中的某个值没在其它行或其它列中出现，
	* 则说明该行中属于其它九宫格的boxs中的候选值中不包含该值，所以要去掉其它九宫格该行或该列的boxs中的候选值中的该值
	*/
	private function boxUniqueCV()
	{
		for($i=0;$i<3;++$i)
		{
			for($j=0;$j<3;++$j)
			{
				$rowbegin=$i*3;
				$rowend=$rowbegin+3;
				$colbegin=$j*3;
				$colend=$colbegin+3;
				
				for($k=$rowbegin;$k<$rowend;++$k)//遍历该九宫格中的三行
				{
					$tmpval=new sudoku_element_candidateVal();
					for($ii=$colbegin;$ii<$colend;++$ii)//将九宫格中的某一行的候选值添加进 $tmpval
					{
						$tmpcval=$this->sdke[$k][$ii]->getCVals();
						$tmpval->addCV($tmpcval);
						//echo "宫格: $i,$j 行: $k 列: $ii 添加候选值: ";
						//print_r($tmpcval);
						
					}
					
					for($ii=$rowbegin;$ii<$rowend;++$ii)//从$tmpval 中删除在另外两行中出现的候选值
					{
						//echo "hello";
						if($ii==$k) continue;
						for($jj=$colbegin;$jj<$colend;++$jj)
						{
							$tmpcval=$this->sdke[$ii][$jj]->getCVals();
							$tmpval->delCV($tmpcval);
							//echo "宫格: $i,$j 行: $k 当前行: $ii 当前列: $jj 删除候选值: ";
							//print_r($tmpcval);
						}
					}
					//此时$tmpval中的候选值是只在该行的boxs的候选值中出现
					$tmpval=$tmpval->getCVals();
					//echo "宫格: $i,$j 行: $k ";
					//print_r($tmpval);
					//echo "<br><br>";
					$this->delCV($k+1,$colbegin+1,4,$tmpval);
					//return;
				
				}
				for($k=$colbegin;$k<$colend;++$k)//遍历该九宫格中的三列
				{
					$tmpval=new sudoku_element_candidateVal();
					for($ii=$rowbegin;$ii<$rowend;++$ii)//将九宫格中的某一列的候选值添加进 $tmpval
					{
						$tmpcval=$this->sdke[$ii][$k]->getCVals();
						$tmpval->addCV($tmpcval);
						//echo "宫格: $i,$j 行: $ii 列: $k 添加候选值: ";
						//print_r($tmpcval);
						
					}
					
					for($ii=$colbegin;$ii<$colend;++$ii)//从$tmpval 中删除在另外两列中出现的候选值
					{
						//echo "hello";
						if($ii==$k) continue;
						for($jj=$rowbegin;$jj<$rowend;++$jj)
						{
							$tmpcval=$this->sdke[$jj][$ii]->getCVals();
							$tmpval->delCV($tmpcval);
							//echo "宫格: $i,$j 列: $k 当前行: $jj 当前列: $ii 删除候选值: ";
							//print_r($tmpcval);
						}
					}
					//此时$tmpval中的候选值是只在该行的boxs的候选值中出现
					$tmpval=$tmpval->getCVals();
					//echo "宫格: $i,$j 列: $k ";
					//print_r($tmpval);
					//echo "<br><br>";
					$this->delCV($rowbegin+1,$k+1,2,$tmpval);
					//return;
				
				}
			}
		}
	}
	
	/**
	* 删除特定行特定列, 及该行该列所在九宫格的所有特定候选值$cVal, $row 与 $col 均从1 开始，$cVal可以是数组
	* 由 $del 参数来控制删除行 列 或 九宫格的部分或全部
	* 若 删除 行 则为 $del 贡献 4
	* 若 删除 列 则为 $del 贡献 2
	* 若 删除 九宫格 则为 $del 贡献 1
	* 例如 若 $del==4 则只删除 行(不包括九宫格); 若 $del==5 则删除行 和九宫格
	* 若$del 为 0, throw exception
	*/
	private function delCV($row,$col,$del,$cVal)
	{
		if($row<1 || $row>9 || $col<1 || $col>9)
			throw new Exception('行列参数不合法');
		if($del<1 || $del >7)
			throw new Exception('$del 参数不合法');
		if(($del & 2)==2)//从特定列删除候选值
		{
			$rowbegin=floor(($row-1)/3)*3;
			$rowend=$rowbegin+3;
			//echo "从第 $col 列 删除 $cVal <br />";
			for($i=0;$i<9;++$i)
			{
				if($i<$rowbegin || $i>=$rowend)
					$this->sdke[$i][$col-1]->delCV($cVal);
			}
		}
		if(($del & 4)==4)//从特定行删除候选值
		{
			$colbegin=floor(($col-1)/3)*3;
			$colend=$colbegin+3;
			//echo "从第 $row 行 删除 $cVal <br />";
			for($i=0;$i<9;++$i)
			{
				if($i<$colbegin || $i>=$colend)
					$this->sdke[$row-1][$i]->delCV($cVal);
			}
		}
		if(($del & 1)==1)//从该行列所在宫格删除候选值
		{
			$colbegin=floor(($col-1)/3)*3;
			$colend=$colbegin+3;
			$rowbegin=floor(($row-1)/3)*3;
			$rowend=$rowbegin+3;
			for($i=$rowbegin;$i<$rowend;++$i)
			{
				for($j=$colbegin;$j<$colend;++$j)
				{
					$this->sdke[$i][$j]->delCV($cVal);
				}
			}
		}
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
		//echo $val+"<br />";
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
	* 尝试向候选值中添加 $cVal，若 $cVal 是整数，则只添加该 $cVal，若 $cVal 是数组，则添加 $cVal 中的元素
	* return;
	*/
	public function addCV($cVal)
	{
		$this->cvObj->addCV($cVal);
	}
	
	/**
	* 尝试从候选值中删除 $cVal 确定的值，若 $cVal 是整数，则只删除该 $cVal，若 $cVal 是数组，则删除 $cVal 中的元素
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
		if(!is_array($cVal))
			$cVal=array($cVal);
		foreach($cVal as $tmpcv)
		{
			if($tmpcv<1 || $tmpcv>9)
				throw new Exception("参数不合法");
			else
				$this->cv[$tmpcv-1]=false;
		}
	}
	
	public function addCV($cVal)
	{
		if(!is_array($cVal))
			$cVal=array($cVal);
		foreach($cVal as $tmpcv)
		{
			if($tmpcv<1 || $tmpcv>9)
				throw new Exception("参数不合法");
			else
				$this->cv[$tmpcv-1]=true;
		}
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
		if($this->countCV()!=1)
			throw new Exception('尝试从多个候选值中获取一个候选值');
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
