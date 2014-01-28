<?php
class JurosCompostos {
    
    private $_capital;
    private $_rate;
    private $_time;
    private $_sum;
    
    public function setCapital($capital)
    {
    	$this->_capital = $capital;
    }
    
    public function setRate($rate)
    {
    	$this->_rate = $rate;
    }
    
    /**
     * 
     * @param int $time Quantidade de ciclos mensais
     */
    public function setTime($time)
    {
        $this->_time = $time;
    }
    
    public function setSum($sum)
    {
    	$this->_sum = $sum;
    }

    public function getCapital()
    {
        return $this->_capital;   
    }
    
    public function getRate()
    {
    	return $this->_rate;
    }
    
    public function getTime()
    {
    	return $this->_time;
    }
    
    public function getSum()
    {
    	return $this->_sum;
    }
    
    public function getScript()
    {
    	return '<script>';
    }
    
    public function getScriptClose()
    {
    	return '</script>';
    }
    
    public function toChartCapitalByTime()
    {
    	$c = '';
    	
    	
    	
    }

    public function getProfit()
    {
    	return $this->getSum()-$this->getCapital();
    }
    
    public function getMontyBalance()
    {
        $balance = array();
        $rate = str_replace('%', '', $this->_rate)/100;
        for($i = 0; $i < $this->getTime()+1; $i++)
        {
        	$balance[mktime(0,0,0,date('m')+$i,date('d'),date('Y'))] = $this->getCapital() * pow(1+$rate,$i);
        }
        return $balance;
    }
    
    public function getCalcSum()
    {
        $rate = str_replace('%', '', $this->_rate)/100;
        $this->_sum = ''.$this->getCapital() * pow(1+$rate,$this->getTime());
        return $this->_sum;
    }

    public function getCalcCapital()
    {
        $rate = str_replace('%', '', $this->_rate)/100;
        return ''.$this->getSum() / pow(1+$rate,$this->getTime());
    }

    public function getCalcRate()
    {
        return ''.pow($this->getSum()/$this->getCapital(),1/$this->getTime())-1;
        
         //return pow($this->getCalcCapital(),1/$this->getTime())
    }
    
    /**
     * Função que retorna dados padrões para exibir no chart.js
     * Deve retornar o montante total à cada mes.
     * @return number
     */
    public function getSumChart()
    {
        $balance = array();
        $label = array();
        $rate = str_replace('%', '', $this->_rate)/100;
        for($i = 0; $i < $this->getTime()+1; $i++)
        {
            $label[] = date('M',mktime(0,0,0,date('m')+$i,date('d'),date('Y'))*1000);
            $balance[] = $this->getCapital() * pow(1+$rate,$i);
        }
        return $this->setChartSession(array(
        	'label' => $label,
            'balance'  => array($balance)
        ));
    }
    
    public function setChartSession($chart)
    {
    	if(isset($_SESSION['chart']))
    	{
    		$old_label = $_SESSION['chart']['label'];
    		$old_data = $_SESSION['chart']['balance'];
    		
    		if(count($chart['label'])>count($old_label))
    		{
    		    $_SESSION['chart']['label'] = $chart['label'];
    		}
    		
    		foreach($chart['balance'] as $v)
    		{
    			$_SESSION['chart']['balance'][] = $v;
    		}
    		
    	}
    	else 
    	{
    		$_SESSION['chart'] = $chart;
    	}
    	
    	return $_SESSION['chart'];
    }

    public function getCalcTime()
    {
        $rate = str_replace('%', '', $this->_rate)/100;
        
        return round(log10($this->getSum()/$this->getCapital()) / log10(1+$rate));
        
        //return '';
    }
}