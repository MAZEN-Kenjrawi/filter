<?php
	require_once('filter.php');
	require_once('database.php');

	global $db;

	// Initilizing and CONFIGURATIONS ...
	// COLUMNS in the table which we need to checked for getting the desiered result
	$filters = array('brand'=>'ProductBrandID', 'family'=>'ProductFamily', 'material'=>'ProductMaterialID', 'color'=>'ProductColorID', 'size' => 'ProductSize');
	// COLUMN that we need to search in
	$to_search_for = "ProductBarcode";
	// THE DATABASE TABLE NAME
	$table = "products";

	$filter = new Filter($filters, $to_search_for, $table);

	// Default attributes and results;;;;;
	$attributes = $filter->get_attribute_unique_values();
	$results = $db->get_data($to_search_for, $table);
	$spec_results = NULL;

	// Searching...
	if(!empty($_POST)){
		foreach($_POST as $key=>$value){
			$column_name = explode('_', $key)[0];
			$checked[] = array($filters[$column_name] => $value);
		}

		if(isset($checked)){
			$new_search_values = $filter->new_search_values($checked);
			$spec_results = $filter->right_syntax($checked);
		}
	}
	// for debugging only....
	// var_dump($new_search_values);
	// var_dump($checked);
?>
<!DOCTYPE html>
<html>
	<head>
	    <meta name="author" content="MAZEN KENJRAWI">
	    <link type="text/css" rel="stylesheet" href="css/home.css" />
	    <title>Filtering</title>
	</head>
	<body class="filtering">
		<div>
			<form id="searchingForm" action="index.php" method="post">
				<?php		
				$id = 0;		
				foreach($attributes as $key => $values){?>
					<h3>Shop BY <?=$key;?></h3>
					<hr />
					<?php
					$i = 0;
					foreach($values as $value){
						if(empty($_POST)){?>
							<input id="checking<?=$id;?>" type="checkbox" name="<?=$key.'_'.$i;?>" value="<?=$value?>" /><?=$value?><br />
							<?php
						} elseif(!empty($checked)) {
							foreach($new_search_values as $new_search_value){
								if($value === $new_search_value){
									?>
									<input id="checking<?=$id;?>" type="checkbox" name="<?=$key.'_'.$i;?>" value="<?=$value?>" /><?=$value?><br />
									<?php
								}
							}
						}
					$i++;
					$id++;
					}
				}
				?>
			</form>
		</div>
	<div class="results">
		<ul>
		<?php
		if($spec_results === NULL){
			$i = 0;
			foreach($results as $result){
				echo "<li>".$result[$to_search_for]."</li>";
				$i++;
			}
		} else {
			$i = 0;
			foreach($spec_results as $result){
				echo "<li>".$result[$to_search_for]."</li>";
				$i++;
			}
		}
		?>
		</ul>
	</div>

	<!-- jQuery and my script -->
	<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
	<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('input[type=checkbox]').on('click', function(){
				var that = $(this);
				//var check = that.prop('checked');
				//var name = that.attr('name');
				//console.log(name, check);

				var form  = that.closest('form');
				var url   = form.attr('action');
				var type  = form.attr('method');
				var data  = form.serialize();

				$.ajax({url: url, type: type, data: data,
					success: function(root){
						var checkboxValues = {};
						$(":checkbox").each(function(){
						    checkboxValues[$(this).attr('id')] = this.checked;
						});
						$('html').html(root);

						if(checkboxValues){
							Object.keys(checkboxValues).forEach(function(element){
								var checked = checkboxValues[element];
								$('#' + element).prop('checked', checked);
							});
						}
					}
				});
			});
		});
	</script>
	<!-- END scripts -->
	</body>
</html>
