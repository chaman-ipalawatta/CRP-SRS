<?php
// File Name: Database.php
// Author: Chaman Ipalawatta [chamani@sabretch.com]
// Creation Date: 26-August-2008
// Description: This class handles the business logic for the Database object.

// Special Note: Following Sabre .NET development standards. Minor changes are made!

//////////////////////
//Revision Version  //
//////////////////////
//	Date of Rel	|	Created by	|	Changes
//------------------------------------------
//	26-08-2008		Chaman			Created


require_once('configuration.php');


class Database
{
	public $connection;
	
	//Function Name: Database -- Default Constructor
	//Authors Name: Chaman
	//Creation Date: 26-08-2008
	//Purpose: Creates a connection string to the database.
	//Parameters: 
	//Return Value: Creates a database connection. 
													
	//Modification History
	//====================
	//Date			|	Developer	|	Change
	//----			|	---------	|	------
	//26-08-2008            |	Chaman		|	Created
	function Database()
	{
		$databaseName = $GLOBALS['configuration']['db'];
		$serverName = $GLOBALS['configuration']['host'];
		$databaseUser = $GLOBALS['configuration']['user'];
		$databasePassword = $GLOBALS['configuration']['pass'];
		$databasePort = $GLOBALS['configuration']['port'];
		$this->connection = mysql_connect ($serverName.":".$databasePort, $databaseUser, $databasePassword);
		if ($this->connection)
		{
			if (!mysql_select_db ($databaseName))
			{
				echo 'Cannot find the specified database "'.$databaseName.'". Please contact the site administrator!';
			}
		}
		else
		{
			echo 'Cannot connect to the database. Please contact the site administrator!';
		}
	}
	
	//Function Name: Connect
	//Authors Name: Chaman
	//Creation Date: 26-08-2008
	//Purpose: Creates a connection to the database if no connection exists.
	//Parameters: 
	//Return Value: Creates a database connection if not available. 
													
	//Modification History
	//====================
	//Date			|	Developer	|	Change
	//----			|	---------	|	------
	//26-08-2008            |	Chaman		|	Created
	public static function Connect()
	{
		static $database = null;
		if (!isset($database))
		{
			$database = new Database();
		}
		return $database->connection;
	}
	
	//Function Name: Reader 
	//Authors Name: Chaman
	//Creation Date: 26-08-2008
	//Purpose: Gets the cursor on the record set.
	//Parameters: 	$query - SQL query
	//				$connection - Database connection
	//Return Value: Record set cursor
													
	//Modification History
	//====================
	//Date			|	Developer	|	Change
	//----			|	---------	|	------
	//26-08-2008            |	Chaman		|	Created
	public static function Reader($query, $connection)
	{
		$cursor = mysql_query($query, $connection);
		return $cursor;
	}

	//Function Name: Read 
	//Authors Name: Chaman
	//Creation Date: 26-08-2008
	//Purpose: Gets the results from the record set into an associate array.
	//Parameters: 	$cursor - Recordset cursor
	//Return Value: Record set row
														
	//Modification History
	//====================
	//Date			|	Developer	|	Change
	//----			|	---------	|	------
	//26-08-2008            |	Chaman		|	Created
	public static function Read($cursor)
	{
		return mysql_fetch_assoc($cursor);
	}


        public static function NoOfFields($cursor)
	{
		return mysql_num_fields($cursor);
	}

        public static function FetchRow($cursor)
	{
		return mysql_fetch_row($cursor);
	}

	//Function Name: ReadIntoArray 
	//Authors Name: Chaman
	//Creation Date: 16-09-2008
	//Purpose: Gets the results from the record set into an array.
	//Parameters: 	$cursor - Recordset cursor
	//Return Value: Record set row
														
	//Modification History
	//====================
	//Date			|	Developer	|	Change
	//----			|	---------	|	------
	//16-09-2008            |	Chaman		|	Created
	public static function ReadIntoArray($cursor)
	{
		return mysql_fetch_array($cursor);
	}

	//Function Name: NonQuery 
	//Authors Name: Chaman
	//Creation Date: 26-08-2008
	//Purpose: Executes DELETE queries
	//Parameters: 	$query - SQL query
	//				$connection - Database connection
	//Return Value: TRUE or FALSE
														
	//Modification History
	//====================
	//Date			|	Developer	|	Change
	//----			|	---------	|	------
	//26-08-2008            |	Chaman		|	Created
	public static function NonQuery($query, $connection)
	{
		mysql_query($query, $connection);
		$result = mysql_affected_rows($connection);
		if ($result == -1)
		{
			return false;
		}
		return $result;

	}

	//Function Name: Query 
	//Authors Name: Chaman
	//Creation Date: 26-08-2008
	//Purpose: Executes SELECT queries
	//Parameters: 	$query - SQL query
	//				$connection - Database connection
	//Return Value: Number of Effected Rows
														
	//Modification History
	//====================
	//Date			|	Developer	|	Change
	//----			|	---------	|	------
	//26-08-2008            |	Chaman		|	Created
	public static function Query($query, $connection)
	{
		$result = mysql_query($query, $connection);
		return mysql_num_rows($result);
	}

	//Function Name: Query 
	//Authors Name: Chaman
	//Creation Date: 26-08-2008
	//Purpose: Executes SELECT queries
	//Parameters: 	$query - SQL query
	//				$connection - Database connection
	//Return Value: ID of the newly Added or Updated row
														
	//Modification History
	//====================
	//Date			|	Developer	|	Change
	//----			|	---------	|	------
	//26-08-2008            |	Chaman		|	Created
	public static function InsertOrUpdate($query, $connection)
	{
		$result = mysql_query($query, $connection);
		return intval(mysql_insert_id($connection));
	}	
}

?>