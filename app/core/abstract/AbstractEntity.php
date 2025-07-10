<?php
namespace Ciara2\Sprint2;


abstract class AbstractEntity{
   abstract protected function toObject($data):static;
   abstract protected function toArray():array;
   
   public function toJson() : string {
        return json_encode($this->toArray());
    }
}
