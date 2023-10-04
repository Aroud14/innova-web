<?php
    trait Blog
    {
        public function getrecentlyblogs()
        {
            echo "hey";
        }

        public function getlistablogs(int $id_categoria = 0, string $titulo = '', string $año_creacion = '')
        {
            $filters = $id_categoria > 0 ? (" AND id_categoria_blog = $id_categoria") : ""; 
            $filters = $titulo           ? (" AND titulo like '$titulo'") : ""; 
            $filters = $año_creacion     ? (" AND id_categoria_blog = $id_categoria") : ""; 

            $sql = "SELECT * FROM tbl_blog WHERE fecha_eliminado IS NULL $filters ORDER BY fecha_registro ASC";
            return $sql;
        }

        public function getlistacategorias()
        {
            $sql = "SELECT * FROM tblc_categoria_blog WHERE fecha_eliminado IS NULL ORDER BY fecha_registro ASC";
            return $sql;            
        }
    }
?>