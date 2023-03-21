<script>
	function DeleteConfirm() {
      confirm("Are you sure to delete the record");
    }
</script>
<?php
	include 'dbconnect.php';
	
	

	
	class Table{
		public $tableName;
		public $connection;
		public $pk;

		
		function __construct($tableName, $connection) {
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
			
			?>
			
			<!-- HTML starts below-->
			<div  class="table_wrapper center-block">
			<table class="table table-striped ">
				<thead>
					<tr>
				  
				
			<?php
			$qry = "SELECT * FROM $this->tableName";
			$res = mysqli_query($this->connection, $qry);
			if(mysqli_num_rows($res) > 0){
				$keys = array_keys(mysqli_fetch_assoc($res));
				foreach($keys as $key){
					if ($key != "password"){
						
					echo "<th scope='col'>$key</th>";
					}
				}
				echo "<th scope='col'>action</th>";
			}
			?>
					</tr>
					</thead>
					<tbody>
					<?php
				$tn = $this->tableName;	
				echo $tn;
				
				while($row = mysqli_fetch_assoc($res))  // Iterate for each rows
				{
					echo "<tr>";
					foreach ($row as $field => $value){
						if ($field != "password"){
							if ($field == $this->pk[$tn]){
								
								$tablePKValue = $value;
								echo $tablePKValue;
							}
							
							echo "<td>$value</td>";

						}
						
					}
					
					//$tablePKField = pk[$tn];
					
					
					?>
					<td>
					
					<a class='btn btn-danger my-3' onclick='DeleteConfirm()' href='DB_Operations/deleteSingleItem.php?tableName=<?php echo $tn?>&tablePKField=<?php echo $this->pk[$tn]?>&tablePKValue=<?php echo $tablePKValue?>'>
						Delete
					</a>
					
					
					</td>
					<?php
					echo "</tr>";
				}
				echo "</tbody>";
				echo "</table>
				</div>";
				
			
			
		}
		
		
		
		
	
	}
	
	
?>