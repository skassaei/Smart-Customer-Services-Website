<script>
	function DeleteConfirm() {
      confirm("Are you sure to delete the record");
    }
</script>


<?php
	require 'dbconnect.php';
class Table {
		private $tableName;
		public $connection;
		public $pk;
    function __construct($tableName,$connection) {
        $this->tableName = $tableName;
        $this->connection = $connection;
        $this -> pk = [
            "user" => "userID",
            "address" => "userID",
            "store" => "depCode",
            "item" => "itemID",
            "truck" => "truckID",
            "truckToGo" => "truckID",
            "discount" => "discountID",
            "review" => "reviewID",
            "orders" => "orderID"
        ];
        }

// ===========================UPDATE===========================
    function display_all_rows_update(){

        $qry = "SELECT * FROM $this->tableName";

        $result = mysqli_query($this->connection,$qry);
           
        $rows = [];
        $firstRow=[];
        if($result == true){
                
            $tn = $this->tableName;	
            $tpk = $this->pk[$tn];
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if(!empty($rows)){
                    // making HTML table
                        echo "<div class='container' >
                            <h5>$this->tableName</h5>
                            <div class='table_wrapper'>
                                <table  class='table table-hover align-middle'>
                                    <thead>
                                    <tr>";

                $firstRow =  $rows[0] ;
                foreach($firstRow as $head => $value){

                        if($head != "password"){
                                echo "<th scope='col'>$head</th>";
                                }
                    }
                    echo "<th scope='col'>action</th></thead><tbody>";


                foreach($rows as $row){
                    echo"<tr>";
                    foreach($row as $head => $value){

                        if ($head != "password"){
                        if ($head == $tpk) $PKValue = $value;
                            
                        echo "<td>$value</td>";
                    }

                }
                ?>
                <td>
                <a class='btn btn-danger my-3'  href='../Forms/updateForm.php?tableName=<?php echo $tn?>&tablePKField=<?php echo $tpk?>&tablePKValue=<?php echo $PKValue?>'>
                Update</a>
                </td>

                <?php
            }


            }
            echo"</tbody></table>
            </div>
            </div>";


        }else{
            echo  "<td>No Record was Found</td>";
            echo"</tbody></table>
            </div>
            </div>";
        }
    }

    // ===========================Delete===========================:
    function display_all_rows_delete(){

        $qry = "SELECT * FROM $this->tableName";

        $result = mysqli_query($this->connection,$qry);
        
               
        $rows = [];
        $firstRow=[];
        if($result){
   
            $tn = $this->tableName;	
            $tpk = $this->pk[$tn];
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if(!empty($rows)){
                    // making HTML table
                     
                    echo "<div class='container' >
                        <h5>$this->tableName</h5>
                        <div class='table_wrapper'>
                            <table  class='table table-hover align-middle'>
                                <thead>
                                <tr>";

                $firstRow =  $rows[0] ;
                foreach($firstRow as $head => $value){

                        if($head != "password"){
                                echo "<th scope='col'>$head</th>";
                                }
                    }
                    echo "<th scope='col'>action</th></thead><tbody>";


                foreach($rows as $row){
                    echo"<tr>";
                    foreach($row as $head => $value){

                        if ($head != "password"){
                        if ($head == $tpk) $PKValue = $value;
                            
                        echo "<td>$value</td>";
                    }

                }
                ?>
                <td>
                <a class='btn btn-danger my-3' onclick='DeleteConfirm()' href='../DB_Operations/deleteSingleItem.php?tableName=<?php echo $tn?>&tablePKField=<?php echo $tpk?>&tablePKValue=<?php echo $PKValue?>'>
                Delete</a>
                </td>

                <?php
            }


            }
            echo"<tbody></table>
            </div>
            </div>

            ";

   


        }else{
            // echo"No Record was Found</th></thead>";

        }
    }
}
?>