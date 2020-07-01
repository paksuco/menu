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
    }

    public function test_should_have_a_string_representation()
    {
        $menuItem = MenuItem::create("new Menu Item", "fa fa-icon", "https://example.com", null);
        $menuItemString = $menuItem . "";
        $this->assertInstanceOf(String::class, $menuItemString);
        $this->assertNotSame($menuItemString, "");
    }
}
