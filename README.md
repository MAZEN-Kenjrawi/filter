# Ajax Filter

`Database class` with the `global` variable `$db` is to connect to the database:

  `__construct()` function is to establish the connection with the database.

  `set_query($query)` function is to execute the `$query` via established connection and retrieve the data from the database as an associative array.

  `get_data()` function is to retrieve all data from the targeting table.


# Filter Class

`get_attribute_values()` function is to get all the rows from the specific table `products` and return it as an associative array.

`get_attribute_unique_values()` function is to remove all repeated values from the result of `get_attribute_values()`.
  
