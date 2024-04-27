<?php
    interface ICRUD
    {
        function CreateUpdate(array $data,$table);
        function Read(array $data,$table);
        function Delete($id);
    }
?>