<?php
namespace Xoops\Core\Handler\Scheme;

use Xoops\Core\Handler\Factory;
use Xoops\Core\Handler\Scheme\SchemeInterface;

require_once __DIR__ . '/../../../../../init_new.php';

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-09-22 at 18:11:45.
 */
 
/**
* PHPUnit special settings :
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
class FQNTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Kernel
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new FQN;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    public function testContracts()
    {
        $this->assertInstanceOf('\Xoops\Core\Handler\Scheme\SchemeInterface', $this->object);
    }

    /**
     * @covers Xoops\Core\Handler\Scheme\FQN::build
     */
    public function testBuild()
    {
        $name = '\Xoops\Core\Kernel\Handlers\XoopsUserHandler';
        $spec = Factory::getInstance()->newSpec()->scheme('fqn')->name($name);
        $this->assertInstanceOf($name, $this->object->build($spec));
    }

    /**
     * @expectedException \Xoops\Core\Exception\NoHandlerException
     * @covers Xoops\Core\Handler\Scheme\FQN::build
     */
    public function testBuild_exception()
    {
        $name = '\Xoops\Core\Kernel\Handlers\NoSuchName';
        $spec = Factory::getInstance()->newSpec()->scheme('fqn')->name($name);
        $this->object->build($spec);
    }

    /**
     * @covers Xoops\Core\Handler\Scheme\FQN::build
     */
    public function testBuild_optional()
    {
        $name = '\Xoops\Core\Kernel\Handlers\NoSuchName';
        $spec = Factory::getInstance()->newSpec()->scheme('fqn')->name($name)->optional(true);
        $handler = $this->object->build($spec);
        $this->assertNull($handler);

        $name = '\Xoops\Core\Kernel\Handlers\XoopsUserHandler';
        $spec = Factory::getInstance()->newSpec()->scheme('fqn')->name($name)->optional(true);
        $handler = $this->object->build($spec);
        $this->assertInstanceOf('\Xoops\Core\Kernel\Handlers\XoopsUserHandler', $handler);
    }
}
