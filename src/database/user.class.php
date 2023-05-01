<?php

class User {
    public int $id;
    public string $name;
    public string $username;
    public string $email;

public function __construct(int $id, string $name, string $username, string $email){
      $this->id = $id;
      $this->name = $name;
      $this->username = $username;
      $this->email = $email;
    }


    static function getUser(PDO $db, string $email, string $password) : ?User {
      $stmt = $db.prepare('SELECT userID, name, username, email
        FROM User
        WHERE lower(email) = ? AND password = ?');
      $stmt->execute(array(strtolower($email), sha1($password)));
      if($user = $stmt->fetch()){
        return new User(
          $user['userID'],
          $user['name'],
          $user['username'],
          $user['email']
        );
      } else return null;
    }
  }