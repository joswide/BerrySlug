<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;


class SlugTest extends TestCase {
	
	private $slug;
 
    protected function setUp()
    {
        $this->slug = new BerrySlug\Slug();
    }
 
    protected function tearDown()
    {
        $this->slug = NULL;
    }
 
    public function addDataProvider() {
        return [
            ['España', 'espana'],
            ['España ', 'espana'],
            ['a🎉', 'a'],
            ['Hello world', 'hello-world'],
            ['Blog post title', 'blog-post-title']
        ];
    }
 
    /**
     * @dataProvider addDataProvider
     */
     
    public function testAdd($string, $expected)
    {
        $result = $this->slug->stringToSlug($string);
        
        $this->assertEquals($expected, $result);
    }
}