<?php

/**
 * Created by Tarks.
 * User: JHRunning
 */

//require_once 'api/tarks_account.api.class.php';
//Load Modules.
require_once(__DIR__ . '/../core/base.php');
//require_once(__DIR__ . '/../core/auth.php');

require_once(__DIR__ . '/../modules/page/page.class.php');
require_once(__DIR__ . '/../modules/member/account.class.php');
require_once(__DIR__ . '/../modules/member/member.class.php');
require_once(__DIR__ . '/../modules/board/documents.class.php');
require_once(__DIR__ . '/../modules/board/comment.class.php');
require_once(__DIR__ . '/../modules/board/attach.class.php');

class MemberTest extends PHPUnit_Framework_TestCase
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

    public function testAccountLogin(){
      //  echo "asdf";
        $result = $this -> ACCOUNT_CLASS -> AccountLogin( $this -> MEMBER_CLASS, "jeonghunn@naver.com", "123456");
        $this->assertNotEquals(false, $result);
    }

    public function hash($password){
        $password = hash('sha256',$password);

        return $password;
    }

    public function CheckAccount(){
        $result = $this -> ACCOUNT_CLASS -> CheckAccount(  "jeonghunn@naver.com", "123456");
        $this->assertEquals("authcode", $result);
    }

}
