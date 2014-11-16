<?php


/**
 * Generated by PHPUnit_SkeletonGenerator on 2014-10-07 at 18:11:53.
 */
class KeyValueModelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var KeyValueModel
     */
    protected $object;

    public static function setUpBeforeClass()
    {

    }

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $app = new \Slim\Slim();
        ORM::configure('sqlite::memory:');
        $db = ORM::get_db();
        $this->object = new \Model\KeyValueModel($app, $db);
        $this->object->setup();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        ORM::reset_db();
    }

    /**
     * 
     */
    function testSet()
    {
        $ret = $this->object->get('xyz');
        $this->assertEquals(null, $ret , '追加していないデータについてはnull');

        $this->object->set('xyz',
                           '12345');
        $ret = $this->object->get('xyz');
        $this->assertEquals('12345', $ret , '追加したデータが取得できる');

        $this->object->set('xyz',
                           'xxxxxx');
        $ret = $this->object->get('xyz');
        $this->assertEquals('xxxxxx', $ret , '変更可能');
    }

}
