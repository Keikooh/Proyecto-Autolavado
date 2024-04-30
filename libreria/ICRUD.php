<?php
    interface ICRUD
    {
        function CreateUpdate(array $data);
        function Read();
        function Delete($id);
    }
?>