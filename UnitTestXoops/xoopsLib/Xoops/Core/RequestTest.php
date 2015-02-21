<?php
namespace Xoops\Core;

require_once(__DIR__ . '/../../../init_mini.php');

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-05-22 at 19:56:36.
 */

/**
* PHPUnit special settings :
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

class RequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Request
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Xoops\Core\Request::getMethod
     */
    public function testGetMethod()
    {
        $method = Request::getMethod();
        $this->assertTrue(in_array($method, array('GET', 'HEAD', 'POST', 'PUT')));
    }

    /**
     * @covers Xoops\Core\Request::getVar
     */
    public function testGetVar()
    {
        $varname = 'RequestTest';
        $value = 'testing';
        $_REQUEST[$varname] = $value;

        $this->assertEquals($value, Request::getVar($varname));
        $this->assertNull(Request::getVar($varname.'no-such-key'));
    }

    /**
     * @covers Xoops\Core\Request::getInt
     */
    public function testGetInt()
    {
        $varname = 'RequestTest';

        $_REQUEST[$varname] = '9';
        $this->assertEquals(9, Request::getInt($varname));

        $_REQUEST[$varname] = '123fred5';
        $this->assertEquals(123, Request::getInt($varname));

        $_REQUEST[$varname] = '-123.45';
        $this->assertEquals(-123, Request::getInt($varname));

        $_REQUEST[$varname] = 'notanumber';
        $this->assertEquals(0, Request::getInt($varname));

        $this->assertEquals(0, Request::getInt($varname.'no-such-key'));


    }

    /**
     * @covers Xoops\Core\Request::getFloat
     */
    public function testGetFloat()
    {
        $varname = 'RequestTest';

        $_REQUEST[$varname] = '1.23';
        $this->assertEquals(1.23, Request::getFloat($varname));

        $_REQUEST[$varname] = '-1.23';
        $this->assertEquals(-1.23, Request::getFloat($varname));

        $_REQUEST[$varname] = '5.68 blah blah';
        $this->assertEquals(5.68, Request::getFloat($varname));

        $_REQUEST[$varname] = '1';
        $this->assertTrue(1.0 === Request::getFloat($varname));
    }

    /**
     * @covers Xoops\Core\Request::getBool
     */
    public function testGetBool()
    {
        $varname = 'RequestTest';

        $_REQUEST[$varname] = '9';
        $this->assertTrue(Request::getBool($varname));

        $_REQUEST[$varname] = 'a string';
        $this->assertTrue(Request::getBool($varname));

        $_REQUEST[$varname] = true;
        $this->assertTrue(Request::getBool($varname));

        $_REQUEST[$varname] = '';
        $this->assertFalse(Request::getBool($varname));

        $_REQUEST[$varname] = false;
        $this->assertFalse(Request::getBool($varname));

        $this->assertFalse(Request::getBool($varname.'no-such-key'));
    }

    /**
     * @covers Xoops\Core\Request::getWord
     */
    public function testGetWord()
    {
        $varname = 'RequestTest';

        $_REQUEST[$varname] = 'Lorem';
        $this->assertEquals('Lorem', Request::getWord($varname));

        $_REQUEST[$varname] = 'Lorem ipsum 88 59';
        $this->assertEquals('Loremipsum', Request::getWord($varname));

        $_REQUEST[$varname] = '.99 Lorem_ipsum @%&';
        $this->assertEquals('Lorem_ipsum', Request::getWord($varname));

        //echo Request::getWord($varname);
    }

    /**
     * @covers Xoops\Core\Request::getCmd
     */
    public function testGetCmd()
    {
        $varname = 'RequestTest';

        $_REQUEST[$varname] = 'Lorem';
        $this->assertEquals('lorem', Request::getCmd($varname));

        $_REQUEST[$varname] = 'Lorem ipsum 88 59';
        $this->assertEquals('loremipsum8859', Request::getCmd($varname));

        $_REQUEST[$varname] = '.99 Lorem_ipsum @%&';
        $this->assertEquals('.99lorem_ipsum', Request::getCmd($varname), Request::getCmd($varname));
    }

    /**
     * @covers Xoops\Core\Request::getString
     */
    public function testGetString()
    {
        $varname = 'RequestTest';

        $_REQUEST[$varname] = 'Lorem ipsum </i><script>alert();</script>';
        $this->assertEquals('Lorem ipsum alert();', Request::getString($varname));
    }

    /**
     * @covers Xoops\Core\Request::getArray
     */
    public function testGetArray()
    {
        $varname = 'RequestTest';

        $testArray = array('one', 'two', 'three');
        $_REQUEST[$varname] = $testArray;

        $get = Request::getArray($varname, null, 'request');
        $this->assertTrue(is_array($get));
        $this->assertEquals($get, $testArray);

        $testArray2 = array('one', 'two', '<script>three</script>');
        $_REQUEST[$varname] = $testArray2;

        $get = Request::getArray($varname, null, 'request');
        $this->assertTrue(is_array($get));
        $this->assertEquals($get, $testArray);
    }

    /**
     * @covers Xoops\Core\Request::getText
     */
    public function testGetText()
    {
        $varname = 'RequestTest';

        $_REQUEST[$varname] = 'Lorem ipsum </i><script>alert();</script>';
        $this->assertEquals($_REQUEST[$varname], Request::getText($varname));
    }

    /**
     * @covers Xoops\Core\Request::getUrl
     */
    public function testGetUrl()
    {
        $varname = 'RequestTest';

        $_REQUEST[$varname] = 'http://example.com/test.php';
        $this->assertEquals($_REQUEST[$varname], Request::getUrl($varname));

        $_REQUEST[$varname] = 'javascript:alert();';
        $this->assertEquals('', Request::getUrl($varname), Request::getUrl($varname));

        $_REQUEST[$varname] = 'modules/test/index.php';
        $this->assertEquals('modules/test/index.php', Request::getUrl($varname));
    }

    /**
     * @covers Xoops\Core\Request::getPath
     */
    public function testGetPath()
    {
        $varname = 'RequestTest';

        $_REQUEST[$varname] = '/var/tmp';
        $this->assertEquals($_REQUEST[$varname], Request::getPath($varname), Request::getPath($varname));

        $_REQUEST[$varname] = ' modules/test/index.php?id=12 ';
        $this->assertEquals('modules/test/index.php?id=12', Request::getPath($varname), Request::getPath($varname));

        $_REQUEST[$varname] = '/var/tmp muck';
        $this->assertEquals('/var/tmp', Request::getPath($varname), Request::getPath($varname));
    }

    /**
     * @covers Xoops\Core\Request::getEmail
     */
    public function testGetEmail()
    {
        $varname = 'RequestTest';

        $_REQUEST[$varname] = 'fred@example.com';
        $this->assertEquals($_REQUEST[$varname], Request::getEmail($varname));

        $_REQUEST[$varname] = 'msdfniondfnlknlsdf';
        $this->assertEquals('', Request::getEmail($varname));

        $_REQUEST[$varname] = 'msdfniondfnlknlsdf';
        $default = 'nobody@localhost';
        $this->assertEquals($default, Request::getEmail($varname, $default));
    }

    /**
     * @covers Xoops\Core\Request::getIp
     */
    public function testGetIPv4()
    {
        $varname = 'RequestTest';

        $_REQUEST[$varname] = '16.32.48.64';
        $this->assertEquals($_REQUEST[$varname], Request::getIP($varname));

        $_REQUEST[$varname] = '316.32.48.64';
        $this->assertEquals('', Request::getIP($varname));

        $_REQUEST[$varname] = '316.32.48.64';
        $default = '0.0.0.0';
        $this->assertEquals($default, Request::getIP($varname, $default));

    }

    /**
     * @covers Xoops\Core\Request::getIp
     */
    public function testGetIPv6()
    {
        $varname = 'RequestTest';

        $_REQUEST[$varname] = 'FE80:0000:0000:0000:0202:B3FF:FE1E:8329';
        $this->assertEquals($_REQUEST[$varname], Request::getIP($varname));

        $_REQUEST[$varname] = 'FE80::0202:B3FF:FE1E:8329';
        $this->assertEquals($_REQUEST[$varname], Request::getIP($varname));

        $_REQUEST[$varname] = 'GE80::0202:B3FF:FE1E:8329';
        $this->assertEquals('', Request::getIP($varname));

        $_REQUEST[$varname] = '::ffff:16.32.48.64';
        $this->assertEquals($_REQUEST[$varname], Request::getIP($varname));
    }

    /**
     * @covers Xoops\Core\Request::setVar
     */
    public function testSetVar()
    {
        $varname = 'RequestTest';
        Request::setVar($varname, 'Porshca', 'get');
        $this->assertEquals($_REQUEST[$varname], 'Porshca');
    }

    /**
     * @covers Xoops\Core\Request::get
     */
    public function testGet()
    {
        $varname = 'RequestTest';

        $_REQUEST[$varname] = 'Lorem';

        $get = Request::get('request');
        $this->assertTrue(is_array($get));
        $this->assertEquals('Lorem', $get[$varname]);

        unset($get);
        $_REQUEST[$varname] = '<i>Lorem ipsum </i><script>alert();</script>';
        $get = Request::get('request');
        $this->assertEquals('Lorem ipsum alert();', $get[$varname]);
    }

    /**
     * @covers Xoops\Core\Request::set
     */
    public function testSet()
    {
        $varname = 'RequestTest';
        Request::set(array($varname => 'Pourquoi'), 'get');
        $this->assertEquals($_REQUEST[$varname], 'Pourquoi');
    }
}