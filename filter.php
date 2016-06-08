<?php
require_once('database.php');

$db = new database;
class Filter{

	public $attributes;
	public $item_to_search_in;
	public $table_name;

	/*------------------------------------------------------------------------------------------BREAK */
	public function __construct($attr, $search_item, $table){
		//no need for protection as long as we enterd the value, trim()..
		$this->attributes = $attr;
		$this->item_to_search_in = $search_item;
		$this->table_name = $table;
	}

	/*------------------------------------------------------------------------------------------BREAK */
	public function get_attribute_values(){
		// get all values
		global $db;
		foreach ($this->attributes as $key => $value){
			$sql = "SELECT $value FROM $this->table_name";
			$attributes_values[$key] = $db->set_query($sql);
		}
		return $attributes_values;
	}

	/*------------------------------------------------------------------------------------------BREAK */
	public function get_attribute_unique_values(){
		// remove repeated values
		$attributes_values = $this->get_attribute_values();
		foreach($this->attributes as $key => $value){
			foreach($attributes_values[$key] as $attributes_value){
				$temp[$key][] = $attributes_value[$value];
			}
			$temp[$key] = array_unique($temp[$key]);
		}
		return $temp;
	}

	/*------------------------------------------------------------------------------------------BREAK */
	public function new_search_values($results){
		global $db;
		$new_search_values = array();
		$serial_results = $serial_attributes = "";
		$i = $j = 0;
		$attributes_num = count($this->attributes) - 1;
		foreach($this->attributes as $attribute){
			$serial_attributes .= $attribute;
			if($j != $attributes_num){$serial_attributes .= ", ";}
			$j++;
		}
		foreach ($results as $result){
			$serial_results .= key($result)." = '".$result[key($result)]."'";
			if($i != (count($results) - 1)){$serial_results .= " AND ";}
			$i++;
		}
		$sql = "SELECT ".$serial_attributes." FROM $this->table_name WHERE ".$serial_results;

		// for debuggning....
		// var_dump($sql);

		$new_search_values[] = $db->set_query($sql);
		$dump = new RecursiveIteratorIterator(new RecursiveArrayIterator($new_search_values));
		$new_search_values = iterator_to_array($dump,false);
		return array_unique($new_search_values);
	}

	/*------------------------------------------------------------------------------------------BREAK */
	public function right_syntax($temp = array()){
		// generating the right MySQL syntax
		$num = count($temp);
		$i = 0;
		$sql = "SELECT $this->item_to_search_in FROM $this->table_name WHERE ";
		if($num != 1){
			$sql .= "(";
		}
		//var_dump($temp, $num);
		for($i = 0; $i < $num; $i++){
			$key = key($temp[$i]);
			// for the first entry
			if($i === 0){$sql .= $key." = '". $temp[$i][$key]."'";}

			// between first and last enteries
			elseif(($i != ($num-1)) && ($i != 0) && ($i != ($num-1))){
				$tempKey = key($temp[$i-1]);
				//checking if getting from the same column
				// yes
				if($tempKey === $key){
					$sql .= " OR ".$key." = '". $temp[$i][$key]."'";
				}
				// no
				else{
					$sql .= ") AND (".$key." = '". $temp[$i][$key]."'";
				}
			}

			// the last entry
			elseif($i === ($num-1)){
				$tempKey = key($temp[$i-1]);
				//checking if getting from the same column 
				// yes
				if($tempKey === $key){
					$sql .= " OR ".$key." = '". $temp[$i][$key]."')";
				}
				// no
				else{
					$sql .= ") AND (".$key." = '". $temp[$i][$key]."')";
				}
			}
		}
		// just for debugging
		// var_dump($sql);
		global $db;
		return $db->set_query($sql);
	}
};
?>
