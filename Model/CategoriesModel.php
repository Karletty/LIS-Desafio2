<?php

require_once 'Model.php';

class CategoriesModel extends Model
{
      public function get($id = '')
      {
            if ($id == '') {
                  $query = "SELECT * FROM categories";
                  return $this->getQuery($query);
            } else {
                  $query = "SELECT * FROM categories WHERE id_category=:id_category";
                  return $this->getQuery($query, ['id_category' => $id])[0];
            }
      }

      public function insert($category = [])
      {
            $query = "INSERT INTO categories VALUES (:id_category, :category_name)";
            return $this->setQuery($query, $category);
      }

      public function update($category = [])
      {
            $query = "UPDATE categories SET category_name=:category_name WHERE id_category=:id_category";
            return $this->setQuery($query, $category);
      }

      public function remove($id)
      {
            $query = "DELETE FROM categories WHERE id_category=:id_category";
            return $this->setQuery($query, ['id_category' => $id]);
      }
}
