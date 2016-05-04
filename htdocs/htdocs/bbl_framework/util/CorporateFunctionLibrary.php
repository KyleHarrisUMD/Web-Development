<?php
class CorporateDataFetcher
{
    /// just generic library to get information about specific corporate groups


    function getName($id)
    {
      $path = $_SERVER['DOCUMENT_ROOT'];
      require_once $path.'/bbl_framework/util/QueryRunner.php';
      $q_r = new QueryRunner();
      $sql = "SELECT * FROM inst_users WHERE id = '".$id."'";

        $result = $q_r->runQueryWithRes($sql);

        $name = '';
        while($row = mysqli_fetch_array($result))
        {
            $name = $row['name'];
        }

        return $name;


    }

    function getServices($id)
    {
        $path = $_SERVER['DOCUMENT_ROOT'];
        require_once $path.'/bbl_framework/util/QueryRunner.php';
        $q_r = new QueryRunner();

        $sql = "SELECT * FROM inst_users WHERE id = '".$id."'";

        $result = $q_r->runQueryWithRes($sql);

        $services = '';
        while($row = mysqli_fetch_array($result))
        {
            $services = $row['services'];
        }

        return $services;
    }

    function getLocations($id)
    {
        $path = $_SERVER['DOCUMENT_ROOT'];
        require_once $path.'/bbl_framework/util/QueryRunner.php';
        $q_r = new QueryRunner();


        $sql = "SELECT * FROM inst_users WHERE id = '".$id."'";

        $result = $q_r->runQueryWithRes($sql);

        $name = '';
        while($row = mysqli_fetch_array($result))
        {
            $name = $row['address'];
        }

        return $name;
    }

    function getCustomText($id)
    {
        $path = $_SERVER['DOCUMENT_ROOT'];
        require_once $path.'/bbl_framework/util/QueryRunner.php';
        $q_r = new QueryRunner();

        $sql = "SELECT * FROM inst_users WHERE id = '".$id."'";

        $result = $q_r->runQueryWithRes($sql);

        $name = '';
        while($row = mysqli_fetch_array($result))
        {
            $name = $row['about'];
        }

        return $name;
    }
}

?>