<?php
    trait Blog
    {
        public function getlistablogs(int $id_categoria = 0, string $titulo = '', string $anio_creacion = '')
        {
            $filters  = $id_categoria > 0 ? (" AND id_categoria_blog = $id_categoria")     : ""; 
            $filters .= $titulo           ? (" AND titulo like '$titulo'")                 : ""; 
            $filters .= $anio_creacion    ? (" AND YEAR(fecha_registro) = $anio_creacion") : ""; 

            $sql = "SELECT * FROM tbl_blog WHERE fecha_eliminado IS NULL $filters ORDER BY fecha_registro ASC";
            return $sql;
        }

        public function getlistacategorias()
        {
            $sql = "SELECT * FROM tblc_categoria_blog WHERE fecha_eliminado IS NULL ORDER BY fecha_registro ASC";
            return $sql;            
        }

        public function getblogfiltrosporanio(){
            $sql = "SELECT YEAR(fecha_registro) AS anio, COUNT(*) AS total_registros
            FROM tbl_blog
            GROUP BY YEAR(fecha_registro)
            ORDER BY YEAR(fecha_registro)";

            return $sql;
        }

        public function getblog(string $enlace = '')
        {
            $sql = "SELECT * FROM tbl_blog WHERE enlace like '$enlace' AND fecha_eliminado IS NULL";
            return $sql;
        }
    }
?>