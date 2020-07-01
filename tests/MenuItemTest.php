<?php

use Paksuco\Menu\MenuItem;
use PHPUnit\Framework\TestCase;

class MenuItemTest extends TestCase
{
    public function test_should_prevent_instantiation_of_menu_item()
    {
        $this->expectException(Error::class);
        $menuItem = new MenuItem();
    }

    public function test_should_instantiate_statically()
    {
        $menuItem = MenuItem::create("new Menu Item", "fa fa-icon", "https://example.com", null);
        $this->assertInstanceOf(MenuItem::class, $menuItem);
        $this->assertEquals("new Menu Item", $menuItem->getTitle());
        $this->assertEquals("fa fa-icon", $menuItem->getIconClass());
        $this->assertEquals("https://example.com", $menuItem->getLink());
        $this->assertInstanceOf(MenuContainer::class, $menuItem->getChildren());
    }

    public function test_should_have_a_string_representation()
    {
        $menuItem = MenuItem::create("new Menu Item", "fa fa-icon", "https://example.com", null);
        $this->assertInstanceOf(String::class, $menuItem . "");
        $this->assertNotSame($menuItem . "", "");
    }

    public function test_should_set_title_with_setters()
    {
        $menuItem = MenuItem::create("new Menu Item", "fa fa-icon", "https://example.com", null);
        $this->assertEquals("new Menu Item", $menuItem->getTitle());
        $menuItem->setTitle("newer Menu Item");
        $this->assertEquals("newer Menu Item", $menuItem->getTitle());
    }

    public function test_should_set_icon_class_with_setters()
    {
        $menuItem = MenuItem::create("new Menu Item", "fa fa-icon", "https://example.com", null);
        $this->assertEquals("fa fa-icon", $menuItem->getIconClass());
        $menuItem->setIconClass("fa fa-clock");
        $this->assertEquals("fa fa-clock", $menuItem->getIconClass());
    }

    public function test_should_set_link_with_setters()
    {
        $menuItem = MenuItem::create("new Menu Item", "fa fa-icon", "https://example.com", null);
        $this->assertEquals("https://example.com", $menuItem->getLink());
        $menuItem->setLink("https://google.com");
        $this->assertEquals("https://google.com", $menuItem->getLink());
    }

    public function test_should_add_menu_item_to_children()
    {
        $menuItem = MenuItem::create("new Menu Item", "fa fa-icon", "https://example.com", null);
        $menuChildren = $menuItem->getChildren();
        $this->assertEquals(0, $menuChildren->count());
        $menuChildren->add(MenuItem::create("Child Item 2", "fa fa-users", "/users"));
        $this->assertEquals(1, $menuChildren->count());
        $this->assertEquals($menuItem->getChildren()->count());
        $menuChildItem = $menuItem->getChildren()->first();
        $this->assertEquals($menuChildItem->getTitle(), "Child Item 2");
        $this->assertEquals($menuChildItem->getIconClass(), "fa fa-users");
        $this->assertEquals($menuChildItem->getLink(), "/users");
    }

    public function test_should_remove_menu_item_with_index()
    {
        $menuItem = MenuItem::create("new Menu Item", "fa fa-icon", "https://example.com", null);
        $menuChildren = $menuItem->getChildren();
        $this->assertEquals(0, $menuChildren->count());
        $menuChildren->add(MenuItem::create("Child Item 2", "fa fa-users", "/users"));
        $this->assertEquals(1, $menuChildren->count());
        $this->assertEquals($menuItem->getChildren()->count());
    }

}
