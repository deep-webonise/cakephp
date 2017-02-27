<?php



class PostsControllerTest extends ControllerTestCase {
    
    public function setUp() {
        parent::setUp();
        $this->Posts = ClassRegistry::init('Posts');
    }
    
    public function tearDown() {
        unset($this->Posts);
        parent::tearDown();
    }
    
    public function testIndex() {
        $result = $this->testAction(
                '/posts/index',
                array('return' => 'vars', 'method' => 'post')
        );
        $this->assertArrayHasKey('posts', $result);
        //$this->assertGreaterThan(0, count($result['posts']));
    }
    
    public function testView($id = null) {
        if($id) {
            $result = $this->testAction(
                '/posts/view',
                array('return' => 'vars', 'method' => 'post')
            );
            $this->assertArrayHasKey('post', $result);
            $this->assertEquals(0, $result['post']);
            //$this->assertGreaterThan(0, count($result['posts']));
        }
    }
    
    public function testAdd() {
        
        $numRecordsBefore = $this->Posts->find('count');
        $data = array(
                'title' => 'test title',
                'body' => 'test body message',
                'test' => true,
                'author_id' => 0,
            );
        $Postdata = array(
            'Post' => $data
        );
        $this->testAction('/posts/add', array('data' => $Postdata));
        $numRecordsAfter = $this->Posts->find('count');
        $testResponse = $this->Posts->find('first', array('order' => array('id' => 'DESC') ));
        //$testResponse =  $numRecordsAfter = $this->Post->find('count');
        //$this->assertTrue($testResponse == $data);
        $this->assertEquals($numRecordsBefore+1, $numRecordsAfter);
        //$this->testAction('/posts/add', array('data' => $data));
        //print_r($a);
    }    
    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

