<?php
namespace Xoops\Core\Text\Sanitizer\Extensions;

use Xoops\Core\Text\Sanitizer;

require_once __DIR__.'/../../../../../../init_new.php';

/**
 * PHPUnit special settings :
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 */
class RtspTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Rtsp
     */
    protected $object;

    /**
     * @var Sanitizer
     */
    protected $sanitizer;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->sanitizer = Sanitizer::getInstance();
        $this->object = new Rtsp($this->sanitizer);
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
        $this->assertInstanceOf('\Xoops\Core\Text\Sanitizer\ExtensionAbstract', $this->object);
        $this->assertInstanceOf('\Xoops\Core\Text\Sanitizer\SanitizerComponent', $this->object);
        $this->assertInstanceOf('\Xoops\Core\Text\Sanitizer\SanitizerConfigurable', $this->object);
    }

    /**
     * @covers Xoops\Core\Text\Sanitizer\Extensions\Rtsp::getDhtmlEditorSupport
     */
    public function testGetDhtmlEditorSupport()
    {
        $support = $this->object->getDhtmlEditorSupport('testeditorarea');
        $this->assertTrue(2 == count($support));
        $this->assertTrue(is_string($support[0]));
        $this->assertTrue(is_string($support[1]));
    }

    /**
     * @covers Xoops\Core\Text\Sanitizer\Extensions\Rtsp::registerExtensionProcessing
     */
    public function testRegisterExtensionProcessing()
    {
        $this->sanitizer->enableComponentForTesting('rtsp');
        $this->assertTrue($this->sanitizer->getShortCodes()->hasShortcode('rtsp'));
        $expected = '<object ';

        $in = '[rtsp=300,200]rtsp://url[/rtsp]';
        $actual = trim($this->sanitizer->filterForDisplay($in));
        $this->assertTrue(is_string($actual));
        $this->assertEquals($expected, substr($actual, 0, strlen($expected)));
    }
}
