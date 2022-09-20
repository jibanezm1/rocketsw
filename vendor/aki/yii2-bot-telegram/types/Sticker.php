<?php

namespace aki\telegram\types;


use aki\telegram\base\Type;

/**
 * @author Akbar Joudi <akbar.joody@gmail.com>
 * This object represents a chat.
 */
class Sticker extends Type
{
    public $width;

    public $height;

    public $is_animated;

    public $file_id;

    public $file_unique_id;
    
    public $file_size;

    private $_thumb;

    /**
     * 
     */
    public function getThumb()
    {
         return $this->_thumb;
    }

    /**
     * 
     */
    public function setThumb($value)
    {
         $this->_thumb = new Sticker($value);
    }
    
}
