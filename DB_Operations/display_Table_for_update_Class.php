<?php
	include 'dbconnect.php';
class updateTable {
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
            "shopping_cart" => "receiptID",
            "truck" => "truckID",
            "itemsInShoppingCart" => "itemsInShoppingCartID",
            "trip" => "tripID",
            "orders" => "orderID",
        ];
        }
    function display_all_rows(){

        $qry = "SELECT * FROM $this->tableName";
        $result = mysqli_query($this->connection,$qry);
                // making HTML table
                echo "<div class='container' >
        <h3>$this->tableName</h3>
        <div class='table_wrapper col-12'>
            <table class='table table-striped'>
                <thead>
                <tr>";

        if(mysqli_num_rows($result) > 0){
            $keys = array_keys(mysqli_fetch_assoc($result));
				foreach($keys as $key){
                    echo "<th scope='col'>$key</th>";
                }
                echo "<th scope='col'>action</th>";
            }
            echo"</tr>
            </thead>
            <tbody>";
            $tn = $this->tableName;	
            while($row = mysqli_fetch_assoc($result)){
                echo"<tr>";
                foreach($row as $field => $value){
                    if($field == $this->pk[$tn]){
                        $pk = $this->pk[$tn];
                        $tablePKValue = $value;
                    }
                    echo "<td style='overflow-wrap: break-word;'>$value</td>";
                }
                echo"<td>
                <a class='btn btn-danger my-3' onclick='DeleteConfirm()' href='DB_Operations/deleteSingleItem.php?tableName=<?php echo $tn?>&tablePKField=<?php echo $pk?>&tablePKValue=<?php echo $tablePKValue?>'>
                update
            </a>
                </td>";

            }


            echo"</table>
            </div>
            </div>";


               

    }




    }?>