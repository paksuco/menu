<?php

namespace Paksuco\Menu;

use Illuminate\Support\Collection;
use Paksuco\Menu\Exceptions\InvalidTypeException;

class MenuContainer extends Collection
{

    public function addItem(string $title, string $link, string $icon = "", callable $callback = null)
    {
        $menuItem = MenuItem::create($title, $link, $icon);
        $this->push($menuItem);
        if($callback){
            $callback($menuItem->getChildren());
        }
        return $this;
    }

     /**
     * Create a new collection.
     *
     * @param  mixed  $items
     * @return void
     */
    public function __construct($items = [])
    {
        $this->items = [];
        $items = $this->getArrayableItems($items);
        foreach($items as $value){
            if ($value instanceof MenuItem) {
                $this->items[] = $value;
            } else {
                throw new InvalidTypeException();
            }
        }
    }

    /**
     * Push one or more items onto the end of the collection.
     *
     * @param  mixed  $values [optional]
     * @return $this
     */
    public function push(...$values)
    {
        foreach ($values as $value) {
            if ($value instanceof MenuItem) {
                $this->items[] = $value;
            } else {
                throw new InvalidTypeException();
            }
        }

        return $this;
    }
}
