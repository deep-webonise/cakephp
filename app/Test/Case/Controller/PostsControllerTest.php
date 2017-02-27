<?php



class PostControllerTest extends ControllerTestCase {
    
    public function setUp() {
        parent::setUp();
        $this->Post = ClassRegistry::init('Post');
    }
    
    public function tearDown() {
        unset($this->Post);
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
        $numRecordsBefore = $this->Post->find('count');
        $data = array(
                'title' => 'test title',
                'body' => 'test body message',
                'author_id' => 0,
        );
        $Postdata = array(
            'Post' => $data
        );
        $this->testAction('/posts/add', array('data' => $Postdata));
        $numRecordsAfter = $this->Post->find('count');
        $testResponse = $this->Post->find('first', array('order' => array('id' => 'DESC') ));
        $this->assertEquals($testResponse['Post']["title"],$Postdata['Post']["title"]);
        $this->assertEquals($testResponse['Post']["body"],$Postdata['Post']["body"]);
        $this->assertEquals($numRecordsBefore+1, $numRecordsAfter);       
    }
    
    public function testEdit() {
        $numRecordsBefore = $this->Post->find('count');
        $data = array(
            'title' => 'test title edited',
            'body' => 'test body message edited',
            'id' => 10,
        );
        $Postdata = array(
            'Post' => $data
        );
        $this->testAction('/posts/edit', array('data' => $Postdata));
        $numRecordsAfter = $this->Post->find('count');
        $testResponse = $this->Post->find('first', array('order' => array('id' => $data['id']) ));
        $this->assertEquals($testResponse['Post']["title"],$Postdata['Post']["title"]);
        $this->assertEquals($testResponse['Post']["body"],$Postdata['Post']["body"]);
        $this->assertEquals($numRecordsBefore, $numRecordsAfter);       
        
        $data = array(
            'title' => 'test title edited',
            'body' => 'test body message edited',
            'id' => -1,
        );
        $Postdata = array(
            'Post' => $data
        );
         $this->expectException($this->testAction('/posts/edit', array('data' => $Postdata)));
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

