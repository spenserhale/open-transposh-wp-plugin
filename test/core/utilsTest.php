<?php

ini_set("include_path", "../core" . PATH_SEPARATOR . "../../core" . PATH_SEPARATOR . ini_get("include_path"));
define("DEBUG", 5);
require_once 'PHPUnit/Framework.php';
require_once 'utils.php';

/**
 * Test class for utils.
 * Generated by PHPUnit on 2009-06-15 at 13:21:30.
 */
class utilsTest extends PHPUnit_Framework_TestCase {

    /**
     * @var    utils
     * @access protected
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @access protected
     */
    protected function setUp() {
	$GLOBALS['logger'] = logger::getInstance(true);
	$GLOBALS['logger']->show_caller = true;
	$GLOBALS['logger']->set_debug_level(5);
	$GLOBALS['logger']->eolprint = true;
	$GLOBALS['logger']->printout = true;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @access protected
     */
    protected function tearDown() {

    }

    public function testRewriteURL() {
	$edit = false;
	$params_only = false;
	$homeurl = "http://transposh.org";
	$permalinks = true;
	$this->assertEquals("/he/", rewrite_url_lang_param("", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("/he/", rewrite_url_lang_param("/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("/he/test", rewrite_url_lang_param("/test", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("/he/test/", rewrite_url_lang_param("/test/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("/he/test/", rewrite_url_lang_param("/test/?lang=en", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("/he/test/", rewrite_url_lang_param("/en/test/?lang=en", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://www.islands.co.il/", rewrite_url_lang_param("http://www.islands.co.il/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://www.islands.co.il/he", rewrite_url_lang_param("http://www.islands.co.il/he", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://www.islands.co.il/fr", rewrite_url_lang_param("http://www.islands.co.il/fr", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://www.islands.co.il/he/", rewrite_url_lang_param("http://www.islands.co.il/he/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://www.islands.co.il/fr/", rewrite_url_lang_param("http://www.islands.co.il/fr/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/", rewrite_url_lang_param("http://transposh.org/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/", rewrite_url_lang_param("http://transposh.org/he", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/", rewrite_url_lang_param("http://transposh.org/fr", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/", rewrite_url_lang_param("http://transposh.org/he/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/", rewrite_url_lang_param("http://transposh.org/fr/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/", rewrite_url_lang_param("http://transposh.org/zh-tw/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/37/", rewrite_url_lang_param("http://transposh.org/37/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/", rewrite_url_lang_param("http://transposh.org/fr/?lang=zh", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/", rewrite_url_lang_param("http://transposh.org/fr/?lang=zh&edit=1", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/", rewrite_url_lang_param("http://transposh.org/fr/?lang=zh-tw&edit=1", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/", rewrite_url_lang_param("http://transposh.org/fr/?lang=zh&amp;edit=1", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/", rewrite_url_lang_param("http://transposh.org/fr/?lang=zh&#038;edit=1", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/?cat=y", rewrite_url_lang_param("http://transposh.org/fr/?lang=zh&#038;edit=1&cat=y", $homeurl, $permalinks, "he", $edit, $params_only));
    }

    public function testRewriteURLedit() {
	$edit = true;
	$params_only = false;
	$homeurl = "http://transposh.org";
	$permalinks = true;
	$this->assertEquals("/he/?edit=1", rewrite_url_lang_param("", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("/he/?edit=1", rewrite_url_lang_param("/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("/he/test?edit=1", rewrite_url_lang_param("/test", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("/he/test/?edit=1", rewrite_url_lang_param("/test/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("/he/test/?edit=1", rewrite_url_lang_param("/test/?lang=en", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("/he/test/?edit=1", rewrite_url_lang_param("/en/test/?lang=en", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://www.islands.co.il/", rewrite_url_lang_param("http://www.islands.co.il/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://www.islands.co.il/he", rewrite_url_lang_param("http://www.islands.co.il/he", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://www.islands.co.il/fr", rewrite_url_lang_param("http://www.islands.co.il/fr", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://www.islands.co.il/he/", rewrite_url_lang_param("http://www.islands.co.il/he/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://www.islands.co.il/fr/", rewrite_url_lang_param("http://www.islands.co.il/fr/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/?edit=1", rewrite_url_lang_param("http://transposh.org/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/?edit=1", rewrite_url_lang_param("http://transposh.org/he", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/?edit=1", rewrite_url_lang_param("http://transposh.org/fr", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/?edit=1", rewrite_url_lang_param("http://transposh.org/he/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/?edit=1", rewrite_url_lang_param("http://transposh.org/fr/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/?edit=1", rewrite_url_lang_param("http://transposh.org/zh-tw/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/37/?edit=1", rewrite_url_lang_param("http://transposh.org/37/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/?edit=1", rewrite_url_lang_param("http://transposh.org/fr/?lang=zh", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/?edit=1", rewrite_url_lang_param("http://transposh.org/fr/?lang=zh&edit=1", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/?edit=1", rewrite_url_lang_param("http://transposh.org/fr/?lang=zh-tw&edit=1", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/?edit=1", rewrite_url_lang_param("http://transposh.org/fr/?lang=zh&amp;edit=1", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/?edit=1", rewrite_url_lang_param("http://transposh.org/fr/?lang=zh&#038;edit=1", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/he/?cat=y&edit=1", rewrite_url_lang_param("http://transposh.org/fr/?lang=zh&#038;edit=1&cat=y", $homeurl, $permalinks, "he", $edit, $params_only));
    }

    public function testRewriteURLparams() {
	$edit = false;
	$params_only = true;
	$homeurl = "http://transposh.org";
	$permalinks = true;
	$this->assertEquals("?lang=he", rewrite_url_lang_param("", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("/?lang=he", rewrite_url_lang_param("/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("/test?lang=he", rewrite_url_lang_param("/test", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("/test/?lang=he", rewrite_url_lang_param("/test/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("/test/?lang=he", rewrite_url_lang_param("/test/?lang=en", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("/test/?lang=he", rewrite_url_lang_param("/en/test/?lang=en", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://www.islands.co.il/", rewrite_url_lang_param("http://www.islands.co.il/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://www.islands.co.il/he", rewrite_url_lang_param("http://www.islands.co.il/he", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://www.islands.co.il/fr", rewrite_url_lang_param("http://www.islands.co.il/fr", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://www.islands.co.il/he/", rewrite_url_lang_param("http://www.islands.co.il/he/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://www.islands.co.il/fr/", rewrite_url_lang_param("http://www.islands.co.il/fr/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/?lang=he", rewrite_url_lang_param("http://transposh.org/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/?lang=he", rewrite_url_lang_param("http://transposh.org/he", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/?lang=he", rewrite_url_lang_param("http://transposh.org/fr", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/?lang=he", rewrite_url_lang_param("http://transposh.org/he/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/?lang=he", rewrite_url_lang_param("http://transposh.org/fr/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/?lang=he", rewrite_url_lang_param("http://transposh.org/zh-tw/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/37/?lang=he", rewrite_url_lang_param("http://transposh.org/37/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/?lang=he", rewrite_url_lang_param("http://transposh.org/fr/?lang=zh", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/?lang=he", rewrite_url_lang_param("http://transposh.org/fr/?lang=zh&edit=1", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/?lang=he", rewrite_url_lang_param("http://transposh.org/fr/?lang=zh-tw&edit=1", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/?lang=he", rewrite_url_lang_param("http://transposh.org/fr/?lang=zh&amp;edit=1", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/?lang=he", rewrite_url_lang_param("http://transposh.org/fr/?lang=zh&#038;edit=1", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/?cat=y&lang=he", rewrite_url_lang_param("http://transposh.org/fr/?lang=zh&#038;edit=1&cat=y", $homeurl, $permalinks, "he", $edit, $params_only));
    }

    public function testRewriteURLwithsubdir() {
	//$GLOBALS[home_url] = "http://transposh.org/test/";
	$edit = false;
	$params_only = false;
	$homeurl = "http://transposh.org/test/";
	$permalinks = true;
	$this->assertEquals("/he/", rewrite_url_lang_param("", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("/he/", rewrite_url_lang_param("/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("/test/he/", rewrite_url_lang_param("/test", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("/test/he/", rewrite_url_lang_param("/test/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("/test/he/", rewrite_url_lang_param("/test/?lang=en", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("/test/he/", rewrite_url_lang_param("/test/en/?lang=en", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://www.islands.co.il/", rewrite_url_lang_param("http://www.islands.co.il/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://www.islands.co.il/he", rewrite_url_lang_param("http://www.islands.co.il/he", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://www.islands.co.il/fr", rewrite_url_lang_param("http://www.islands.co.il/fr", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://www.islands.co.il/he/", rewrite_url_lang_param("http://www.islands.co.il/he/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://www.islands.co.il/fr/", rewrite_url_lang_param("http://www.islands.co.il/fr/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/he/", rewrite_url_lang_param("http://transposh.org/test/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/he/", rewrite_url_lang_param("http://transposh.org/test/he", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/he/", rewrite_url_lang_param("http://transposh.org/test/fr", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/he/", rewrite_url_lang_param("http://transposh.org/test/he/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/he/", rewrite_url_lang_param("http://transposh.org/test/fr/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/he/", rewrite_url_lang_param("http://transposh.org/test/zh-tw/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/he/37/", rewrite_url_lang_param("http://transposh.org/test/37/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/he/", rewrite_url_lang_param("http://transposh.org/test/fr/?lang=zh", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/he/", rewrite_url_lang_param("http://transposh.org/test/fr/?lang=zh&edit=1", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/he/", rewrite_url_lang_param("http://transposh.org/test/fr/?lang=zh-tw&edit=1", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/he/", rewrite_url_lang_param("http://transposh.org/test/fr/?lang=zh&amp;edit=1", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/he/", rewrite_url_lang_param("http://transposh.org/test/fr/?lang=zh&#038;edit=1", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/he/?cat=y", rewrite_url_lang_param("http://transposh.org/test/fr/?lang=zh&#038;edit=1&cat=y", $homeurl, $permalinks, "he", $edit, $params_only));

	$this->assertEquals("/", rewrite_url_lang_param("/", $homeurl, $permalinks, "", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/?cat=y", rewrite_url_lang_param("http://transposh.org/test/fr/?lang=zh&#038;edit=1&cat=y", $homeurl, $permalinks, "", $edit, $params_only));
    }

    public function testRewriteURLwithsubdir2() {
	//$GLOBALS[home_url] = "http://transposh.org/test/";
	$edit = false;
	$params_only = true;
	$homeurl = "http://transposh.org/test/";
	$permalinks = true;
	$this->assertEquals("?lang=he", rewrite_url_lang_param("", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("/?lang=he", rewrite_url_lang_param("/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("/test?lang=he", rewrite_url_lang_param("/test", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("/test/?lang=he", rewrite_url_lang_param("/test/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("/test/?lang=he", rewrite_url_lang_param("/test/?lang=en", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("/test/?lang=he", rewrite_url_lang_param("/test/en/?lang=en", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://www.islands.co.il/", rewrite_url_lang_param("http://www.islands.co.il/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://www.islands.co.il/he", rewrite_url_lang_param("http://www.islands.co.il/he", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://www.islands.co.il/fr", rewrite_url_lang_param("http://www.islands.co.il/fr", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://www.islands.co.il/he/", rewrite_url_lang_param("http://www.islands.co.il/he/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://www.islands.co.il/fr/", rewrite_url_lang_param("http://www.islands.co.il/fr/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/?lang=he", rewrite_url_lang_param("http://transposh.org/test/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test?lang=he", rewrite_url_lang_param("http://transposh.org/test/he", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test?lang=he", rewrite_url_lang_param("http://transposh.org/test/fr", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/?lang=he", rewrite_url_lang_param("http://transposh.org/test/he/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/?lang=he", rewrite_url_lang_param("http://transposh.org/test/fr/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/?lang=he", rewrite_url_lang_param("http://transposh.org/test/zh-tw/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/37/?lang=he", rewrite_url_lang_param("http://transposh.org/test/37/", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/?lang=he", rewrite_url_lang_param("http://transposh.org/test/fr/?lang=zh", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/?lang=he", rewrite_url_lang_param("http://transposh.org/test/fr/?lang=zh&edit=1", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/?lang=he", rewrite_url_lang_param("http://transposh.org/test/fr/?lang=zh-tw&edit=1", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/?lang=he", rewrite_url_lang_param("http://transposh.org/test/fr/?lang=zh&amp;edit=1", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/?lang=he", rewrite_url_lang_param("http://transposh.org/test/fr/?lang=zh&#038;edit=1", $homeurl, $permalinks, "he", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/?cat=y&lang=he", rewrite_url_lang_param("http://transposh.org/test/fr/?lang=zh&#038;edit=1&cat=y", $homeurl, $permalinks, "he", $edit, $params_only));

	$this->assertEquals("", rewrite_url_lang_param("", $homeurl, $permalinks, "", $edit, $params_only));
	$this->assertEquals("/", rewrite_url_lang_param("/", $homeurl, $permalinks, "", $edit, $params_only));
	$this->assertEquals("http://transposh.org/test/?cat=y", rewrite_url_lang_param("http://transposh.org/test/fr/?lang=zh&#038;edit=1&cat=y", $homeurl, $permalinks, "", $edit, $params_only));
    }

    public function testCleanupURL() {
	$homeurl = "http://www.algarve-abc.de/ferienhaus-westalgarve/";
	$this->assertEquals("http://www.algarve-abc.de/ferienhaus-westalgarve/test", cleanup_url("http://www.algarve-abc.de/ferienhaus-westalgarve/en/test", $homeurl));
	$this->assertEquals("http://www.algarve-abc.de/ferienhaus-westalgarve", cleanup_url("http://www.algarve-abc.de/ferienhaus-westalgarve", $homeurl));
	$this->assertEquals("http://www.algarve-abc.de/ferienhaus-westalgarve", cleanup_url("http://www.algarve-abc.de/ferienhaus-westalgarve/en", $homeurl));
	$this->assertEquals("http://www.algarve-abc.de/ferienhaus-westalgarve/", cleanup_url("http://www.algarve-abc.de/ferienhaus-westalgarve/en/", $homeurl));
	$this->assertEquals("/ferienhaus-westalgarve/", cleanup_url("http://www.algarve-abc.de/ferienhaus-westalgarve/en/", $homeurl, true));
    }

    public function testCleanupURL2() {
	$homeurl = "http://www.algarve-abc.de/ferienhaus-westalgarve/";
	$params_only = true;
	$this->assertEquals("http://www.algarve-abc.de/ferienhaus-westalgarve/test", cleanup_url("http://www.algarve-abc.de/ferienhaus-westalgarve/en/test", $homeurl));
	$this->assertEquals("http://www.algarve-abc.de/ferienhaus-westalgarve", cleanup_url("http://www.algarve-abc.de/ferienhaus-westalgarve", $homeurl));
	$this->assertEquals("http://www.algarve-abc.de/ferienhaus-westalgarve", cleanup_url("http://www.algarve-abc.de/ferienhaus-westalgarve/en", $homeurl));
	$this->assertEquals("http://www.algarve-abc.de/ferienhaus-westalgarve/", cleanup_url("http://www.algarve-abc.de/ferienhaus-westalgarve/en/", $homeurl));
	$this->assertEquals("/ferienhaus-westalgarve/", cleanup_url("http://www.algarve-abc.de/ferienhaus-westalgarve/en/", $homeurl, true));
    }

    public function testCleanupURL3() {
	$homeurl = "";
	//$params_only = true;
	$this->assertEquals("/test", cleanup_url("/he/test", $homeurl));
	//$this->assertEquals("/test",cleanup_url("he/test",$homeurl));
    }

    public function testCleanupURL4() {
	$homeurl = "http://www.algarve-abc.de";
	$this->assertEquals("/", cleanup_url("/he", $homeurl, true));
    }

    public function testGetOriginalURL() {

	function dummy($str ="", $param = "") {
	    return $str;
	}

;
	$this->assertEquals("/", get_original_url("/", '', 'en', "dummy"));
	$this->assertEquals("/test", get_original_url("/test", '', 'en', "dummy"));
	$this->assertEquals("/test/", get_original_url("/test/", '', 'en', "dummy"));
	$this->assertEquals("www.islands.co.il/he/test/", get_original_url("www.islands.co.il/he/test/", 'www.islands.co.il', 'en', "dummy"));
	$this->assertEquals("http://www.islands.co.il/he/test/", get_original_url("http://www.islands.co.il/he/test/", 'http://www.islands.co.il', 'en', "dummy"));
    }

    public function testTranslateURL() {

	function dummy2($str ="", $param = "") {
	    return array($str, '0');
	}

;
	$this->assertEquals("/", translate_url("/", '', 'en', "dummy2"));
	$this->assertEquals("/test", translate_url("/test", '', 'en', "dummy2"));
	$this->assertEquals("/test/", translate_url("/test/", '', 'en', "dummy2"));
	$this->assertEquals("www.islands.co.il/he/test/", translate_url("www.islands.co.il/he/test/", 'www.islands.co.il', 'en', "dummy2"));
	$this->assertEquals("www.islands.co.il?lang=he", translate_url("www.islands.co.il?lang=he", 'www.islands.co.il', 'en', "dummy2"));
	$this->assertEquals("http://www.islands.co.il/he/test/", translate_url("http://www.islands.co.il/he/test/", 'http://www.islands.co.il', 'en', "dummy2"));
	$this->assertEquals("http://www.islands.co.il/he/test/?edit=1", translate_url("http://www.islands.co.il/he/test/?edit=1", 'http://www.islands.co.il', 'en', "dummy2"));
    }

    public function testGrabLanguage() {
	$homeurl = "http://transposh.org";
	$this->assertEquals("he", get_language_from_url("http://transposh.org/he/test/", $home_url));
	$this->assertEquals("he", get_language_from_url("http://transposh.org/he", $home_url));
	$this->assertEquals("he", get_language_from_url("http://transposh.org/?lang=he", $home_url));
	$this->assertEquals("he", get_language_from_url("http://transposh.org/he/?lang=he", $home_url));
	$this->assertEquals("he", get_language_from_url("http://transposh.org/he/?lang=he&fakeparam=no", $home_url));
	$this->assertEquals("he", get_language_from_url("http://transposh.org/he/?fake=no&lang=he&fakeparam=no", $home_url));
	$this->assertEquals("he", get_language_from_url("http://transposh.org/hello/test/?lang=he", $home_url));
    }

}
?>
