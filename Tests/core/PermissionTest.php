<?php
define('642979',   TRUE);
/**
 * Created by Tarks.
 * User: JHRunning
 */

//require_once 'api/tarks_account.api.class.php';
//Load Modules.
require_once(__DIR__ . '/../../core/base.php');
require_once(__DIR__ . '/../../core/permission.php');
//require_once(__DIR__ . '/../core/auth.php');

require_once(__DIR__ . '/../../modules/page/page.class.php');
require_once(__DIR__ . '/../../modules/account/account.class.php');
require_once(__DIR__ . '/../../modules/account/member.class.php');
require_once(__DIR__ . '/../../modules/board/documents.class.php');
require_once(__DIR__ . '/../../modules/board/comment.class.php');
require_once(__DIR__ . '/../../modules/board/attach.class.php');

class PermissionTest extends PHPUnit_Framework_TestCase
{

 private  $ACCOUNT_CLASS;
    private  $MEMBER_CLASS;
    protected function setUp(){
     $this ->  ACCOUNT_CLASS = new AccountClass();
        $this ->  MEMBER_CLASS = new MemberClass();
    }

//    public function testAdds(){
////$this -> loginTest();
////echo $this -> hashTest("123456");
//    }

    public function testIPManageCalc(){
        $ip_manage = array();

        $ip_manage['last_address'] = 'asdf';
        $ip_manage['last_access'] = '2222252222';
        $ip_active = "N";
        $ip_point = "81";
      //  echo "asdf";
        $result =   IPManageCalc('3222222222', "asdf", $ip_manage, $ip_active, $ip_point);
       // $this->assertNotNull($email);
        $this->assertEquals(array("ip_active" => 'Y', "ip_point" => 9), $result);
    }

    public function testsqrt(){


       // $this->assertEquals(9, $result);
}





}
