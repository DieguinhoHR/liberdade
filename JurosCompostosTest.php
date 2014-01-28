<?php
class JurosCompostosTest extends PHPUnit_Framework_TestCase{

    public function setUp()
    {
        require_once 'JurosCompostos.php';
    }
    
    public function testGetCalcSum()
    {
         $juros = new JurosCompostos();
         $juros->setCapital(5000);
         $juros->setRate('0.6%');
         $juros->setTime(12);
         $this->assertEquals($juros->getCalcSum(),5372.1208386096);
         
         
         $juros = new JurosCompostos();
         $juros->setCapital(20000);
         $juros->setRate('1%');
         $juros->setTime(36);
         $this->assertEquals($juros->getCalcSum(),28615.375671832);
         
         
         $juros = new JurosCompostos();
         $juros->setCapital(100000);
         $juros->setRate('0.8%');
         $juros->setTime(24);
         $this->assertEquals($juros->getCalcSum(),121074.5240889);
    }

    public function testGetCapital()
    {
        $juros = new JurosCompostos();
        $juros->setRate('0.6%');
        $juros->setTime(12);
        $juros->setSum(5372.120838609);
        $this->assertEquals($juros->getCalcCapital(),'5000');
    }

    public function testGetRate()
    {
        $juros = new JurosCompostos();
        $juros->setTime(12);
        $juros->setSum(5372.120838609);
        $juros->setCapital(5000);
        $this->assertEquals($juros->getCalcRate(),0.0059999999999902);
        
    }

    public function testGetTime()
    {
        $juros = new JurosCompostos();
        $juros->setRate('0.6%');
        //$juros->setTime(12);
        $juros->setSum(5372.120838609);
        $juros->setCapital(5000);
        $this->assertEquals($juros->getCalcTime(),12);
    }
    
    public function testGetSumChart()
    {
    	$juros = new JurosCompostos();
    	$juros->setSum(5000);
    	$juros->setRate('0.6%');
    	$juros->setTime(12);
    	
    	
    	$this->assertTrue($juros->getSumChart());
    }
}