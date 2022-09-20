<?php /** @noinspection PhpUnused */

namespace aki\telegram\types;

use aki\telegram\base\Type;

/**
 * @author Akbar Joudi <akbar.joody@gmail.com>
 * 
 */
class Result extends Type
{
   public $message_id;

   private $_from;

   private $_chat;

   public $sender_chat;

   public $date;

   public $text;

   private $_audio;

   private $_photo;

   private $_document;

   private $_video;

   public $caption;

   private $_animation;

   private $_voice;

   private $_video_note;

   public $error_code;

   private $_forward_from;

   public $forward_date;

   private $_entities;

   private $_sticker;

   private $_reply_markup;
   
   public $caption_entities;

   private $_user;

   public $author_signature;
   
   public $edit_date;

    public $forward_sender_name;

   /**
    * 
    */
    public function getUser()
    {
       return $this->_user;
    }
 
    /**
     * 
     */
    public function setUser($value)
    {
       $this->_user = new User($value);
    }

   /**
    * 
    */
   public function getFrom()
   {
      return $this->_from;
   }

   /**
    * 
    */
   public function setFrom($value): void
   {
      $this->_from = new From($value);
   }

   /**
    * 
    */
    public function getChat()
    {
       return $this->_chat;
    }
 
    /**
     * 
     */
    public function setChat($value): void
    {
       $this->_chat = new Chat($value);
    }

    /**
     * 
     */
    public function getAudio()
    {
       return $this->_audio;
    }

    /**
     * 
     */
    public function setAudio($value): void
    {
       $this->_audio = new Audio($value);
    }

    /**
     * 
     */
    public function getPhoto()
    {
       return $this->_photo;
    }

    /**
     * 
     */
    public function setPhoto($value): void
    {
       $this->_photo = new Photo($value);
    }

    /**
     * 
     */
    public function getDocument()
    {
       return $this->_document;
    }

    /**
     * 
     */
    public function setDocument($value): void
    {
       $this->_document = new Document($value);
    }

    /**
     * 
     */
    public function getVideo()
    {
       return $this->_video;
    }

    /**
     * 
     */
    public function setVideo($value): void
    {
       $this->_video = new Video($value);
    }

    /**
     * 
     */
    public function getAnimation()
    {
       return $this->_animation;
    }

    /**
     * 
     */
    public function setAnimation($value): void
    {
       $this->_animation = new Animation($value);
    }

    /**
     * 
     */
    public function getVoice()
    {
       return $this->_voice;
    }

    /**
     * 
     */
    public function setVoice($value): void
    {
         $this->_voice = new Voice($value);
    }

    /**
     * 
     */
    public function getVideoNote()
    {
         return $this->_video_note;
    }

    /**
     * 
     */
    public function setVideoNote($value): void
    {
         $this->_video_note = new VideoNote($value);
    }

    /**
     * 
     */
    public function getForward_from()
    {
         return $this->_forward_from;
    }

    /**
     * 
     */
    public function setForward_from($value): void
    {
         $this->_forward_from = new ForwardFrom($value);
    }


    /**
     * 
     */
    public function getEntities()
    {
         return $this->_entities;
    }

    /**
     * 
     */
    public function setEntities($value): void
    {
         $this->_entities = new Entities($value);
    }


    /**
     * 
     */
    public function getSticker()
    {
         return $this->_sticker;
    }

    /**
     * 
     */
    public function setSticker($value): void
    {
         $this->_sticker = new Sticker($value);
    }

    /**
     * 
     */
    public function getReply_markup()
    {
         return $this->_reply_markup;
    }

    /**
     * 
     */
    public function setReply_markup($value): void
    {
         $this->_reply_markup = new InlineKeyboardMarkup($value);
    }
}
