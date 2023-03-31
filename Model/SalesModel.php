<?php

require_once 'Model.php';

class SalesModel extends Model
{
      public function get()
      {
            $query = "SELECT S.id_sale, S.id_client, S.file_path, S.sale_date FROM sales S";
            return $this->getQuery($query);
      }

      public function getProdCart($id)
      {
            $query = "SELECT P.id_product, P.product_name, P.img, C.category_name, P.price FROM products P INNER JOIN categories C ON P.id_category = C.id_category WHERE P.id_product=:id_product";
            return $this->getQuery($query, ['id_product' => $id])[0];
      }

      public function insertSale($sale = [])
      {
            $query = "INSERT INTO sales (id_client, file_path, sale_date) VALUES (:id_client, :file_path, :sale_date)";
            return $this->setQuery($query, $sale)[1];
      }

      public function insertSaleDetail($sale_detail = [])
      {
            $query = "INSERT INTO sales_details (id_sale, quantity, id_product) VALUES (:id_sale, :quantity, :id_product)";
            return $this->setQuery($query, $sale_detail)[0];
      }
}
