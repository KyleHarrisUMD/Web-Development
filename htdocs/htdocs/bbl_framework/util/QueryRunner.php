<?php
class QueryRunner
{
    const host = 'localhost';
    const user = 'root';
    const pass = 'root';
    const db = 'social';

    function runQueryWithRes($sql)
    {
        /// get all database cxn info to get ready to connect..//
        $host = QueryRunner::host;
        $user = QueryRunner::user;
        $db_pass = QueryRunner::pass;
        $dbName = QueryRunner::db;

        $con = mysqli_connect($host, $user, $db_pass, $dbName); // basic mysql/php cxn//

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        } else {
            $res = mysqli_query($con, $sql);
            if (!$res) // if there is a problem, it lies here
            {
              //  echo mysqli_error_list($res);

                echo "error with mysql query";
              echo mysql_errno($res);
            }
            return $res;
            mysqli_close($con);
        }
        ///// yes, success
    }

}

?>
