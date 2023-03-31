<?php

require_once 'Model.php';

class UsersModel extends Model
{
      public function get($id = '')
      {
            if ($id == '') {
                  $query = "SELECT U.user_name, T.user_type FROM users U INNER JOIN user_types T ON U.id_user_type=T.id_user_type";
                  return $this->getQuery($query);
            } else {
                  $query = "SELECT U.user_name, T.user_type FROM users U INNER JOIN user_types T ON U.id_user_type=T.id_user_type WHERE U.user_name=:user_name";
                  return $this->getQuery($query, ['user_name' => $id])[0];
            }
      }

      public function register($user = [])
      {
            $query = "INSERT INTO users VALUES (:user_name, SHA2(:pass,256), 1)";
            return $this->setQuery($query, $user);
      }

      public function update($user = [])
      {
            $query = "UPDATE users SET pass=SHA2(:pass,256), id_user_type=:id_user_type WHERE user_name=:user_name";
            return $this->setQuery($query, $user);
      }

      public function validate($user, $pass)
      {
            $query = "SELECT user_name FROM users
          WHERE user_name=:user_name AND pass=SHA2(:pass,256)";
            return $this->getQuery($query, ['user_name' => $user, 'pass' => $pass]);
      }

      public function remove($id)
      {
            $query = "DELETE FROM users WHERE user_name=:user_name";
            return $this->setQuery($query, ['user_name' => $id]);
      }
}
