<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;


class SlugAvailableCheckTest extends TestCase {
	
	private $slug;
 
    protected function setUp()
    {
        $this->slug = new BerrySlug\Slug();
    }
 
    protected function tearDown()
    {
        $this->slug = NULL;
    }
 
	public function verifyAvailable($slug){
		$list = ['my-new-blog-post', 'my-new-blog-post-1'];
		
		if (in_array($slug, $list)){
			return false;
		}
		
		return true;
	}
 
    public function addDataProvider() {
        return [
            ['My new blog post', [$this, 'verifyAvailable'], 'my-new-blog-post-2'],
        ];
    }
 
    /**
     * @dataProvider addDataProvider
     */
     
    public function testAdd($string, $callback, $expected)
    {
        $result = $this->slug->slug($string, $callback);
        
        $this->assertEquals($expected, $result);
    }
}