<?php

require_once 'Model.php';

class ClientsModel extends Model
{
      public function get($id = '')
      {
            if ($id == '') {
                  $query = "SELECT * FROM clients";
                  return $this->getQuery($query);
            } else {
                  $query = "SELECT * FROM clients WHERE client_email=:client_email";
                  return $this->getQuery($query, ['client_email' => $id])[0];
            }
      }

      public function register($client = [])
      {
            $query = "INSERT INTO clients VALUES (:client_email, :is_active, SHA2(:pass,256))";
            return $this->setQuery($query, $client)[0];
      }

      public function validate($user, $pass)
      {
            $query = "SELECT client_email, is_active FROM clients
          WHERE client_email=:client_email AND pass=SHA2(:pass,256)";
            return $this->getQuery($query, ['client_email' => $user, 'pass' => $pass]);
      }

      public function enable($client = [])
      {
            $query = "UPDATE clients SET is_active=:is_active WHERE client_email=:client_email";
            return $this->setQuery($query, $client)[0];
      }
}
