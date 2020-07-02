<?php

namespace Paksuco\Menu;

use Illuminate\Support\Collection;
use Paksuco\Menu\Exceptions\InvalidTypeException;

class MenuContainer extends Collection
{
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

    public function build()
    {
        $output = "<ul>";

        foreach($this->items as $item)
        {
            $output .= $item->build();
        }

        return $output . "</ul>";
    }
}
