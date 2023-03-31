<?php

require_once 'Model.php';

class SalesModel extends Model
{
      public function get($id = '')
      {
            if ($id == '') {
                  $query = "SELECT P.id_product, P.product_name, P.product_description, P.img, C.category_name, P.price, P.stock FROM products P INNER JOIN categories C ON P.id_category = C.id_category";
                  return $this->getQuery($query);
            } else {
                  $query = "SELECT P.id_Product, P.product_name, P.product_description, P.img, C.category_name, P.price, P.stock FROM products P INNER JOIN categories C ON P.id_category = C.id_category WHERE P.id_product=:id_product";
                  return $this->getQuery($query, ['id_product' => $id])[0];
            }
      }

      public function getProdCart($id)
      {
            $query = "SELECT P.id_product, P.product_name, P.img, C.category_name, P.price FROM products P INNER JOIN categories C ON P.id_category = C.id_category WHERE P.id_product=:id_product";
            return $this->getQuery($query, ['id_product' => $id])[0];
      }

      public function insertSale($sale = [])
      {
            $query = "INSERT INTO sales (id_client, file_path) VALUES (:id_client, :file_path)";
            return $this->setQuery($query, $sale)[1];
      }

      public function insertSaleDetail($sale_detail = [])
      {
            $query = "INSERT INTO sales_details (id_sale, quantity, id_product) VALUES (:id_sale, :quantity, :id_product)";
            return $this->setQuery($query, $sale_detail)[0];
      }

      private function getLastInsertId()
      {
            if (!is_null($this->conn)) {
                  return mysqli_insert_id($this->conn);
            }
      }
}
