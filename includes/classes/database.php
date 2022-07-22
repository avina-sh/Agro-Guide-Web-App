<?php
    class DB {
        private $con;
        private $errorArray;

        public function __construct($con) {
            $this->con = $con;
            $this->errorArray = array();
        }
        
        public function checkUN($un) {
            $query = mysqli_query($this->con, "SELECT * FROM farmer_details where username='$un'");

            if (mysqli_num_rows($query) == 1) {
                return true;
            }
            else {
                return false;
            }
        }

        public function addData($un, $pn, $mof, $cp, $la) {
            $query = mysqli_query($this->con, "INSERT INTO farmer_details values ('$un', $pn, '$mof', '$cp', $la)");
            $row = mysqli_query($this->con, "SELECT * FROM farmer_details where = $un;");

            if (mysqli_num_rows($row) == 1) {
                return $row;
            }
            else {
                return "Error in pusping info";
            }
        }
    }

?>