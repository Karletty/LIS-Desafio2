<?php

require_once 'Model.php';

class ProductsModel extends Model
{
      public function get($id = '')
      {
            if ($id == '') {
                  $query = "SELECT P.id_product, P.product_name, P.product_description, P.img, C.category_name, P.price, P.stock FROM products P INNER JOIN categories C ON P.id_category = C.id_category";
                  return $this->getQuery($query);
            } else {
                  $query = "SELECT P.id_product, P.product_name, P.product_description, P.img, C.category_name, P.price, P.stock FROM products P INNER JOIN categories C ON P.id_category = C.id_category WHERE P.id_product=:id_product";
                  return $this->getQuery($query, ['id_product' => $id])[0];
            }
      }
      
      public function getProdCart($id)
      {
            $query = "SELECT P.id_product, P.product_name, P.img, C.category_name, P.price FROM products P INNER JOIN categories C ON P.id_category = C.id_category WHERE P.id_product=:id_product";
            return $this->getQuery($query, ['id_product' => $id])[0];
      }

      public function insert($products = [])
      {
            $query = "INSERT INTO products VALUES (:id_product, :product_name, :product_description, :img, :id_category, :price, :stock)";
            return $this->setQuery($query, $products)[0];
      }

      public function getLastInsertId()
      {
            if (!is_null($this->conn)) {
                  return mysqli_insert_id($this->conn);
            }
      }

      public function update($products = [])
      {
            $query = "UPDATE products SET product_name=:product_name, product_description=:product_description, img=:img, id_category=:id_category, price=:price, stock=:stock WHERE id_product=:id_product";
            return $this->setQuery($query, $products)[0];
      }

      public function remove($id)
      {
            $query = "DELETE FROM products WHERE id_product=:id_product";
            return $this->setQuery($query, ['id_product' => $id])[0];
      }
}
