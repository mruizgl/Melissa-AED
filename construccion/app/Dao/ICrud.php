<?php
interface ICrud{

    public function findAll();
    public function save($dao);
    public function findById($id);
    public function update($dao);
    public function delete($id);
    }

?>
