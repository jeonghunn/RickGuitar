<?php

/**
 * Created by Tarks.
 * User: JHRunning
 */

//require_once 'api/tarks_account.api.class.php';
//Load Modules.


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

    public function testAdds(){
//$this -> loginTest();
echo $this -> hashTest("123456");
    }

    public function loginTest(){
        $result = $this -> ACCOUNT_CLASS -> AccountLogin( $this -> MEMBER_CLASS, "jeonghunn@naver.com", "123456");
        $this->assertEquals("authcode", $result);
    }

    public function hashTest($password){
        $password = hash('sha256',$password);

        return $password;
    }

}
