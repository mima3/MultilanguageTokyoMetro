<?php
date_default_timezone_set('Asia/Tokyo');
require 'vendor/autoload.php';
require './config.php';

/**
 * Generated by PHPUnit_SkeletonGenerator on 2014-10-07 at 18:11:53.
 */
class TokyoMetroApiTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TokyoMetroApi
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $jsonCtrl = new \MyLib\JsonCtrl(TOKYO_METRO_DATA_DIR);
        //$this->object = new \MyLib\TokyoMetroApi("TEST", $jsonCtrl);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    function testAdd()
    {
ini_set('xdebug.var_display_max_children', -1);
ini_set('xdebug.var_display_max_data', -1);
ini_set('xdebug.var_display_max_depth', -1);    
      $this->assertEquals(2, 1 + 1);
      $jsonCtrl = new \MyLib\JsonCtrl(TOKYO_METRO_DATA_DIR);
      $app = new \Slim\Slim(array(
        'debug' => true,
        'log.writer' => new \Slim\Logger\DateTimeFileWriter(array(
                            'path' => './logs',
                            'name_format' => 'Y-m-d',
                            'message_format' => '%label% - %date% - %message%'
                        )),
        'log.enabled' => true,
        'log.level' => \Slim\Log::DEBUG,
        'view' => new \Slim\Views\Smarty()
      ));
      ORM::configure('sqlite:' . DB_PATH);
      $db = ORM::get_db();
      $tokyoMetroCacheModel = new \Model\TokyoMetroCacheModel($app, $db);
      $tmCtrl = new \MyLib\TokyoMetroCtrl(END_POINT, TOKYO_METRO_CONSUMER_KEY,  $jsonCtrl,$tokyoMetroCacheModel);
      print "==============\n";
      $ret = $tmCtrl->findStationTimetable(
        array(
          'odpt:station'=>'odpt.Station:TokyoMetro.Fukutoshin.ChikatetsuAkatsuka',
          'odpt:railDirection'=>'odpt.RailDirection:TokyoMetro.Wakoshi'
        )
      , false);
      var_dump($ret['contents']);
      /*
      var_dump( $tmCtrl->compTime("05:01", "05:01"));
      var_dump( $tmCtrl->compTime("05:01", "05:02"));
      var_dump( $tmCtrl->compTime("05:02", "05:01"));

      var_dump( $tmCtrl->compTime("05:01", "00:01"));
      */
    }
}
