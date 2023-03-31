<?php
function dateSort($saleA, $saleB)
{
      $dateA = explode('/', $saleA['sale_date']);
      $dateB = explode('/', $saleB['sale_date']);
      if ($dateA[2] < $dateB[2]) {
            return -1;
      }
      if ($dateA[2] > $dateB[2]) {
            return 1;
      }
      if ($dateA[1] < $dateB[1]) {
            return -1;
      }
      if ($dateA[1] > $dateB[1]) {
            return 1;
      }
      if ($dateA[0] < $dateB[0]) {
            return -1;
      }
      if ($dateA[0] > $dateB[0]) {
            return 1;
      }
      return -1;
}
