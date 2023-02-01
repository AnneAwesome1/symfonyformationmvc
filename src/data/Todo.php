<?php

namespace App\data;

// class
class Todo
{
     // Objet
     public int $id;

     public string $task;

     public string $description;

     public bool $completed;

     private static int $count = 1;

     // constructer


     
     public function __construct($task, $description)
     {
          $this->completed = false;
          $this->task = $task;
          $this->description = $description;
          // incremente +1 à chaque nouvel id
          $this->id = self::$count;
          self::$count++; // id autogénérer
     }
}



// new == instance d'objet
// $a = new Todo(task "zro"); = 1
// $b = new Todo(task "zro"); = 2