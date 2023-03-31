<?php

function renderErrorPrivilegeView()
{
      $errorView = "View/errorPrivilege.php";

      ob_start();
      require($errorView);
      $content = ob_get_contents();
      ob_end_clean();

      echo $content;
}
