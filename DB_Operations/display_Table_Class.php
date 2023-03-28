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
            //"shopping_cart" => "receiptID",
            "truck" => "truckID",
            //"itemsInShoppingCart" => "itemsInShoppingCartID",
           // "trip" => "tripID",
            "orders" => "orderID"];
        }
    function display_all_rows_update(){

        $qry = "SELECT * FROM $this->tableName";

        $result = mysqli_query($this->connection,$qry);
                // making HTML table
                echo "<div class='container' >
        <h3>$this->tableName</h3>
        <div class='table_wrapper'>
            <table class='table table-striped'>
                <thead>
                <tr>";
        $rows = [];
        $firstRow=[];
        if(mysqli_num_rows($result) > 0){
            $tn = $this->tableName;	
            $tpk = $this->pk[$tn];
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if(!empty($rows)){
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


        }
    }

    // ------delete---:
    function display_all_rows_delete(){

        $qry = "SELECT * FROM $this->tableName";

        $result = mysqli_query($this->connection,$qry);
                // making HTML table
                echo "<div class='container' >
        <h4>$this->tableName</h4>
        <div class='table_wrapper'>
            <table class='table table-striped'>
                <thead>
                <tr>";
        $rows = [];
        $firstRow=[];
        if(mysqli_num_rows($result) > 0){
            $tn = $this->tableName;	
            $tpk = $this->pk[$tn];
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if(!empty($rows)){
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
            </div>";

   


        }else{
            echo"No Record was Found</th></thead>";

        }
    }




}
    ?>