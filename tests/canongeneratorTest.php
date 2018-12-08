<?php
/**
 * Created by PhpStorm.
 * User: reinhurd
 * Date: 08.12.2018
 * Time: 15:26
 */

use PHPUnit\Framework\TestCase;
require_once '..\canongenerator.php';

final class canongeneratorTest extends TestCase
{
    public function testClearFilter()
    {
        $_SERVER['SERVER_NAME']='anitashop.ru';
        $canon = new canongenerator('/catalog/filter/clear/apply/');
        $result = $canon->getCanonUrl();
        $this->assertEquals('https://anitashop.ru/catalog/', $result);
    }
    public function testClearGet()
    {
        $_SERVER['SERVER_NAME']='anitashop.ru';
        $_SERVER['REQUEST_URI']='/catalog/?getyourmuscle=true';
        $canon = new canongenerator;
        $result = $canon->getCanonUrl();
        $this->assertEquals('https://anitashop.ru/catalog/', $result);
    }
    public function testTwoParams()
    {
        $_SERVER['SERVER_NAME']='anitashop.ru';
        $_SERVER['REQUEST_URI']='/catalog/filter/agfdsgfdgds/clear/apply/?getyourmuscle=true';
        $canon = new canongenerator;
        $result = $canon->getCanonUrl();
        $this->assertEquals('https://anitashop.ru/catalog/', $result);
    }
    public function testWar()
    {
        $_SERVER['SERVER_NAME']='anitashop.ru';
        $canon = new canongenerator('/catalog/byustgaltery_bez_kostochek/filter/base_color-is-dark_blue/apply/');
        $result = $canon->getCanonUrl();
        $this->assertEquals('https://anitashop.ru/catalog/byustgaltery_bez_kostochek/', $result);
    }
}