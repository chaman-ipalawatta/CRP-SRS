<?php
include_once('database.php');
include_once('ps_pagination.php');

class sql
{

    function sql()
    {

    }

   
    //This function returns all the districts in ASC order.
    public static function getAllCustomerNames()
    {
        //Create DB connection
        $conn = Database::Connect();
        //Query to pass to the DB. values are escaped.
        $query = 'SELECT id, name FROM customer ORDER BY name ASC';
        //Uncomment to check the query
        //print_r($query);
        //Run the query.
        $cursor = Database::Reader($query,$conn);
        while($row = Database::Read($cursor))
        {
                extract($row);
                $customer = array($id=>$name);
                $customerArr[] = $customer;
        }
        return $customerArr;
    }

    //This function returns all the districts in ASC order.
    public static function getAllMakes()
    {
        //Create DB connection
        $conn = Database::Connect();
        //Query to pass to the DB. values are escaped.
        $query = 'SELECT id, name FROM make ORDER BY name ASC';
        //Uncomment to check the query
        //print_r($query);
        //Run the query.
        $makeArr = null;
        $cursor = Database::Reader($query,$conn);
        while($row = Database::Read($cursor))
        {
                extract($row);
                $make = array($id=>$name);
                $makeArr[] = $make;
        }
        return $makeArr;
    }

    public static function getModelOfMake($makeId)
    {
        //Create DB connection
        $conn = Database::Connect();
        //Query to pass to the DB. values are escaped.
        $query = sprintf("SELECT id, name
            FROM model
            WHERE model.make_id='%d'
            AND model.status != 'd'
            ORDER BY name ASC",
              mysql_escape_string($makeId));
        //Uncomment to check the query
        //print_r($query);
        //Run the query.

        $modelArr = null;
        $cursor = Database::Reader($query,$conn);
        while($row = Database::Read($cursor))
        {
                extract($row);
                $model = array($id=>$name);
                $modelArr[] = $model;
        }
        return $modelArr;
    }
    public static function getModelOfMakeWithPagination($makeId)
    {
        //Create DB connection
        $conn = Database::Connect();
        //Query to pass to the DB. values are escaped.
        $query = sprintf("SELECT id, name
            FROM model
            WHERE model.make_id='%d'
            AND model.status != 'd'
            ORDER BY name ASC",
              mysql_escape_string($makeId));
        //Uncomment to check the query
        //print_r($query);
        //Run the query.

        $pager = new PS_Pagination($conn, $query, 20, 5);

        //$cursor = Database::Reader($query, $conn);
        $rs = $pager->paginate();
        $modelArr = null;
        if($rs)
        {
            while($row = Database::Read($rs))
            {
                if(is_array($row))
                {
                    extract($row);
                    $model['id'] = $id;
                    $model['name'] = $name;
                    $model['nav'] = $pager->renderFullNav();

                    $modelArr[] = $model;
                }
            }
        }
        return $modelArr;
    }

    public static function getOilTypes()
    {
        //Create DB connection
        $conn = Database::Connect();
        //Query to pass to the DB. values are escaped.
        $query = "SELECT id, oil_type
            FROM comp_oil_type
            WHERE comp_oil_type.status != 'd'
            ORDER BY oil_type ASC";
        //Uncomment to check the query
        //print_r($query);
        //Run the query.
        $cursor = Database::Reader($query,$conn);
        while($row = Database::Read($cursor))
        {
                extract($row);
                $oil_type = array($id=>$oil_type);
                $oil_type_Arr[] = $oil_type;
        }
        return $oil_type_Arr;
    }
    public static function GetAllCustomers($order_table = "name ASC")
    {
        $conn = Database::Connect();



        $query = "  SELECT customer.*
                    FROM customer
                    WHERE customer.status != 'd'
                    ORDER BY customer.".$order_table;
        //print($query);

        $pager = new PS_Pagination($conn, $query, 20, 5);

        //$cursor = Database::Reader($query, $conn);
        $rs = $pager->paginate();
        $customerArr = null;
        while($row = Database::Read($rs))
        {
            if(is_array($row))
            {
                extract($row);
                $customer['id'] = $id;
                $customer['name'] = $name;
                $customer['address'] = $address;
                $customer['tele1'] = $tele1;
                $customer['tele2'] = $tele2;
                $customer['mobile'] = $mobile;
                $customer['notes'] = $notes;
                $customer['email'] = $email;
                $customer['create_date'] = $create_date;
                $customer['update_date'] = $update_date;
                $customer['nav'] = $pager->renderFullNav();

                $customerArr[] = $customer;
            }
        }
        return $customerArr;
    }
    public static function GetAllVehicleMakes()
    {
        $conn = Database::Connect();



        $query = "  SELECT make.*
                    FROM make
                    WHERE make.status != 'd'
                    ORDER BY make.name ";
        //print($query);

        $pager = new PS_Pagination($conn, $query, 20, 5);

        //$cursor = Database::Reader($query, $conn);
        $rs = $pager->paginate();

        $makeArr = null;
        while($row = Database::Read($rs))
        {
            if(is_array($row))
            {
                extract($row);
                $make['id'] = $id;
                $make['name'] = $name;
                $make['nav'] = $pager->renderFullNav();

                $makeArr[] = $make;
            }
        }
        return $makeArr;
    }
    public static function GetAllServices($id)
    {
        $conn = Database::Connect();

        $query = sprintf("
                    SELECT service.*, vehicle.plate_no
                    FROM service
                    INNER JOIN vehicle ON service.vehicle_id = vehicle.id
                    WHERE service.status != 'd'
                    AND service.vehicle_id = '%d'
                    ORDER BY service.create_date DESC ",
                mysql_escape_string($id));
        //print($query);

        $pager = new PS_Pagination($conn, $query, 20, 5);

        //$cursor = Database::Reader($query, $conn);
        $rs = $pager->paginate();
        $serviceArr = null;
        if($rs)
        {
            while($row = Database::Read($rs))
            {
                if(is_array($row))
                {
                    extract($row);
                    $service['id'] = $id;
                    $service['vehicle_id'] = $vehicle_id;
                    $service['odometer'] = $odometer;
                    $service['service_desc'] = $service_desc;
                    $service['next_service'] = $next_service;
                    $service['notes'] = $notes;
                    $service['create_date'] = $create_date;
                    $service['update_date'] = $update_date;
                    $service['nav'] = $pager->renderFullNav();

                    $serviceArr[] = $service;
                }
            }
        }
        return $serviceArr;
    }
    public static function GetCustomerVehicles($id)
    {
        $conn = Database::Connect();
        
        $query = "CREATE VIEW last_service AS
            SELECT vehicle_id, MAX(create_date) AS last_service FROM service
            WHERE status != 'd'
            GROUP BY vehicle_id";
        Database::NonQuery($query,$conn);

        $query = sprintf("SELECT vehicle.*,model.name as model,make.name as make,
                        comp_oil_type.oil_type, last_service.last_service
                    FROM vehicle INNER JOIN model ON vehicle.model_id = model.id
                    INNER JOIN make ON model.make_id = make.id
                    INNER JOIN comp_oil_type ON vehicle.comp_oil_type_id = comp_oil_type.id
                    INNER JOIN customer ON customer.id = vehicle.customer_id
                    LEFT JOIN last_service ON vehicle.id = last_service.vehicle_id
                    WHERE vehicle.status != 'd'
                    AND vehicle.customer_id = '%d'
                    AND customer.status != 'd'
                    ORDER BY vehicle.update_date DESC ",
                mysql_escape_string($id));
        //print($query);

        $pager = new PS_Pagination($conn, $query, 20, 5);

        //$cursor = Database::Reader($query, $conn);
        $rs = $pager->paginate();

        $vehicleArr = null;
        if($rs)
        {
            while($row = Database::Read($rs))
            {
                if(is_array($row))
                {
                    extract($row);
                    $vehicle['id'] = $id;
                    $vehicle['plate_no'] = $plate_no;
                    $vehicle['make'] = $make;
                    $vehicle['model'] = $model;
                    $vehicle['oil_type'] = $oil_type;
                    $vehicle['notes'] = $notes;
                    $vehicle['last_service'] = $last_service;
                    $vehicle['update_date'] = $update_date;
                    $vehicle['nav'] = $pager->renderFullNav();

                    $vehicleArr[] = $vehicle;
                }
            }
        }

        $query = "DROP VIEW last_service;";
        Database::NonQuery($query,$conn);
        
        return $vehicleArr;
    }

    public static function GetAllCustomerVehicles()
    {
        $conn = Database::Connect();
        $query = "CREATE VIEW last_service AS
            SELECT vehicle_id, MAX(create_date) AS last_service FROM service
            WHERE status != 'd'
            GROUP BY vehicle_id";
        Database::NonQuery($query,$conn);
//print($query);
        $query = "
            SELECT vehicle.*,model.name as model,make.name as make,
            comp_oil_type.oil_type, last_service.last_service
                    FROM vehicle INNER JOIN model ON vehicle.model_id = model.id
                    INNER JOIN make ON model.make_id = make.id
                    INNER JOIN comp_oil_type ON vehicle.comp_oil_type_id = comp_oil_type.id
                    INNER JOIN customer ON customer.id = vehicle.customer_id
                    LEFT JOIN last_service ON vehicle.id = last_service.vehicle_id
                    WHERE vehicle.status != 'd'
                    AND customer.status != 'd'
                    ORDER BY vehicle.update_date DESC";

        

        $pager = new PS_Pagination($conn, $query, 20, 5);

        //$cursor = Database::Reader($query, $conn);
        $rs = $pager->paginate();

        $vehicleArr = null;
        if($rs)
        {
            while($row = Database::Read($rs))
            {
                if(is_array($row))
                {
                    extract($row);
                    $vehicle['id'] = $id;
                    $vehicle['plate_no'] = $plate_no;
                    $vehicle['make'] = $make;
                    $vehicle['model'] = $model;
                    $vehicle['oil_type'] = $oil_type;
                    $vehicle['notes'] = $notes;
                    $vehicle['last_service'] = $last_service;
                    $vehicle['update_date'] = $update_date;
                    $vehicle['nav'] = $pager->renderFullNav();

                    $vehicleArr[] = $vehicle;
                }
            }
        }

        $query = "DROP VIEW last_service;";
        Database::NonQuery($query,$conn);


        return $vehicleArr;
    }
    public static function GetAllCustomerVehiclesSearch()
    {
        $conn = Database::Connect();
        $query = "CREATE VIEW last_service AS
            SELECT vehicle_id, MAX(create_date) AS last_service FROM service
            WHERE status != 'd'
            GROUP BY vehicle_id";
        Database::NonQuery($query,$conn);

        $query = "SELECT vehicle.*,model.name as model,make.name as make,
            comp_oil_type.oil_type, last_service.last_service
                    FROM vehicle INNER JOIN model ON vehicle.model_id = model.id
                    INNER JOIN make ON model.make_id = make.id
                    INNER JOIN comp_oil_type ON vehicle.comp_oil_type_id = comp_oil_type.id
                    INNER JOIN customer ON customer.id = vehicle.customer_id
                    LEFT JOIN last_service ON vehicle.id = last_service.vehicle_id
                    WHERE vehicle.status != 'd'
                    AND customer.status != 'd'
                    AND vehicle.plate_no LIKE '%".$_POST['searchBox']."%'
                    ORDER BY vehicle.update_date DESC ";
        //print($query);

        $pager = new PS_Pagination($conn, $query, 20, 5);

        //$cursor = Database::Reader($query, $conn);
        $rs = $pager->paginate();

        $vehicleArr = null;
        if($rs)
        {
            while($row = Database::Read($rs))
            {
                if(is_array($row))
                {
                    extract($row);
                    $vehicle['id'] = $id;
                    $vehicle['plate_no'] = $plate_no;
                    $vehicle['make'] = $make;
                    $vehicle['model'] = $model;
                    $vehicle['oil_type'] = $oil_type;
                    $vehicle['notes'] = $notes;
                    $vehicle['last_service'] = $last_service;
                    $vehicle['update_date'] = $update_date;
                    $vehicle['nav'] = $pager->renderFullNav();

                    $vehicleArr[] = $vehicle;
                }
            }
        }

        $query = "DROP VIEW last_service;";
        Database::NonQuery($query,$conn);
        
        return $vehicleArr;
    }
    
    /*
     * Register.php
     */
    public static function saveCustomer()
    {
        $today= getdate();
        $conn = Database::Connect();

        $query =  sprintf("INSERT INTO `customer` (
            `name`,
            `address`,
            `tele1`,
            `tele2`,
            `mobile`,
            `email`,
            `notes`,
            `create_date`,
            `update_date`)
			VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s')",
			mysql_real_escape_string($_POST['name']),
			mysql_real_escape_string($_POST['address']),
			mysql_real_escape_string($_POST['tele1']),
			mysql_real_escape_string($_POST['tele2']),
			mysql_real_escape_string($_POST['mobile']),
			mysql_real_escape_string($_POST['email']),
			mysql_real_escape_string(trim($_POST['notes'])),
			mysql_real_escape_string(date("Y-m-d",$today['0'])),
                        mysql_real_escape_string(date("Y-m-d",$today['0']))
                );
		//Uncomment to check the query
		//print_r($query);
                //Run the query.
		return Database::InsertOrUpdate($query,$conn);
    }
    public static function saveVehicle()
    {
        $today= getdate();
        $conn = Database::Connect();

        $query =  sprintf("INSERT INTO `vehicle` (
            `plate_no`,
            `model_id`,
            `comp_oil_type_id`,
            `customer_id`,
            `notes`,
            `create_date`,
            `update_date`)
			VALUES('%s','%s','%s','%s','%s','%s','%s')",
			mysql_real_escape_string($_POST['plateNo']),
			mysql_real_escape_string($_POST['model']),
			mysql_real_escape_string($_POST['oilType']),
			mysql_real_escape_string($_POST['customerNames']),
			mysql_real_escape_string(trim($_POST['notes'])),
			mysql_real_escape_string(date("Y-m-d",$today['0'])),
                        mysql_real_escape_string(date("Y-m-d",$today['0']))
                );
		//Uncomment to check the query
		//print_r($query);
                //Run the query.
		return Database::InsertOrUpdate($query,$conn);
    }

    public static function saveService()
    {
        $today= getdate();
        $conn = Database::Connect();

        $query =  sprintf("INSERT INTO `service` (
            `vehicle_id`,
            `odometer`,
            `service_Desc`,
            `next_Service`,
            `notes`,
            `create_date`,
            `update_date`)
			VALUES('%s','%s','%s','%s','%s','%s','%s')",
			mysql_real_escape_string($_POST['id']),
			mysql_real_escape_string($_POST['odometer']),
			mysql_real_escape_string($_POST['serviceDesc']),
			mysql_real_escape_string($_POST['nextService']),
			mysql_real_escape_string($_POST['notes']),
			mysql_real_escape_string($_POST['serviceDate']),
                        mysql_real_escape_string(date("Y-m-d",$today['0']))
                );
		//Uncomment to check the query
		//print_r($query);
                //Run the query.
		return Database::InsertOrUpdate($query,$conn);
    }
    public static function saveMake()
    {
        $today= getdate();
        $conn = Database::Connect();

        $query =  sprintf("INSERT INTO `make` (
            `name`)
			VALUES('%s')",
			mysql_real_escape_string($_POST['make'])
                );
		//Uncomment to check the query
		//print_r($query);
                //Run the query.
		return Database::InsertOrUpdate($query,$conn);
    }
    public static function saveModel($makeId)
    {
        $today= getdate();
        $conn = Database::Connect();

        $query =  sprintf("INSERT INTO `model` (
            `make_id`,`name`)
			VALUES('%s','%s')",
			mysql_real_escape_string($makeId),
                        mysql_real_escape_string($_POST['model'])
                );
		//Uncomment to check the query
		//print_r($query);
                //Run the query.
		return Database::InsertOrUpdate($query,$conn);
    }
    public static function updateCustomer($id)
    {
        $today= getdate();
        $conn = Database::Connect();

        $query =  sprintf("UPDATE `customer` SET
            `name` = '%s',
            `address` = '%s',
            `tele1` = '%s',
            `tele2` = '%s',
            `mobile` = '%s',
            `email` = '%s',
            `notes` = '%s',
            `update_date` = '%s'
            WHERE `id` = '%s'",
                mysql_real_escape_string($_POST['name']),
                mysql_real_escape_string($_POST['address']),
                mysql_real_escape_string($_POST['tele1']),
                mysql_real_escape_string($_POST['tele2']),
                mysql_real_escape_string($_POST['mobile']),
                mysql_real_escape_string($_POST['email']),
                mysql_real_escape_string(trim($_POST['notes'])),
                mysql_real_escape_string(date("Y-m-d",$today['0'])),
                mysql_real_escape_string($id));
		//Uncomment to check the query
		//print_r($query);
                //Run the query.
		return Database::InsertOrUpdate($query,$conn);
    }
    public static function updateVehicle($id)
    {
        $today= getdate();
        $conn = Database::Connect();

        $query =  sprintf("UPDATE `vehicle` SET
            `model_id` = '%s',
            `comp_oil_type_id` = '%s',
            `customer_id` = '%s',
            `plate_no` = '%s',
            `notes` = '%s',
            `update_date` = '%s'
            WHERE `id` = '%s'",
                mysql_real_escape_string($_POST['model']),
                mysql_real_escape_string($_POST['oilType']),
                mysql_real_escape_string($_POST['customerNames']),
                mysql_real_escape_string($_POST['plateNo']),
                mysql_real_escape_string(trim($_POST['notes'])),
                mysql_real_escape_string(date("Y-m-d",$today['0'])),
                mysql_real_escape_string($id));
		//Uncomment to check the query
		//print_r($query);
                //Run the query.
		return Database::InsertOrUpdate($query,$conn);
    }

    public static function updateService($id)
    {
        $today= getdate();
        $conn = Database::Connect();

        $query =  sprintf("UPDATE `service` SET
            `odometer` = '%s',
            `service_desc` = '%s',
            `next_service` = '%s',
            `notes` = '%s',
            `update_date` = '%s'
            WHERE `id` = '%s'",
                mysql_real_escape_string($_POST['odometer']),
                mysql_real_escape_string($_POST['serviceDesc']),
                mysql_real_escape_string($_POST['nextService']),
                mysql_real_escape_string($_POST['notes']),
                mysql_real_escape_string(date("Y-m-d",$today['0'])),
                mysql_real_escape_string($id));
		//Uncomment to check the query
		//print_r($query);
                //Run the query.
		return Database::InsertOrUpdate($query,$conn);
    }
    public static function updateMake($id)
    {
        $today= getdate();
        $conn = Database::Connect();

        $query =  sprintf("UPDATE `make` SET
            `name` = '%s'
            WHERE `id` = '%s'",
                mysql_real_escape_string($_POST['make']),
                mysql_real_escape_string($id));
		//Uncomment to check the query
		//print_r($query);
                //Run the query.
		return Database::InsertOrUpdate($query,$conn);
    }
    public static function updateModel($id)
    {
        $today= getdate();
        $conn = Database::Connect();

        $query =  sprintf("UPDATE `model` SET
            `name` = '%s'
            WHERE `id` = '%s'",
                mysql_real_escape_string($_POST['model']),
                mysql_real_escape_string($id));
		//Uncomment to check the query
		//print_r($query);
                //Run the query.
		return Database::InsertOrUpdate($query,$conn);
    }

    public static function deleteCustomer($id)
    {
        $conn = Database::Connect();

        $query =  sprintf("UPDATE `customer` SET
            `status` = 'd'
            WHERE `id` = '%s'",
                mysql_real_escape_string($id));
		//Uncomment to check the query
		//print_r($query);
                //Run the query.
		return Database::InsertOrUpdate($query,$conn);
    }
    public static function deleteModel($id)
    {
        $conn = Database::Connect();

        $query =  sprintf("UPDATE `model` SET
            `status` = 'd'
            WHERE `id` = '%s'",
                mysql_real_escape_string($id));
		//Uncomment to check the query
		//print_r($query);
                //Run the query.
		return Database::InsertOrUpdate($query,$conn);
    }
    public static function deleteVehicle($id)
    {
        $conn = Database::Connect();

        $query =  sprintf("UPDATE `vehicle` SET
            `status` = 'd'
            WHERE `id` = '%s'",
                mysql_real_escape_string($id));
		//Uncomment to check the query
		//print_r($query);
                //Run the query.
		return Database::InsertOrUpdate($query,$conn);
    }

    public static function deleteService($id)
    {
        $conn = Database::Connect();

        $query =  sprintf("UPDATE `service` SET
            `status` = 'd'
            WHERE `id` = '%s'",
                mysql_real_escape_string($id));
		//Uncomment to check the query
		//print_r($query);
                //Run the query.
		return Database::InsertOrUpdate($query,$conn);
    }
    public static function deleteMake($id)
    {
        $conn = Database::Connect();

        $query =  sprintf("UPDATE `make` SET
            `status` = 'd'
            WHERE `id` = '%s'",
                mysql_real_escape_string($id));
		//Uncomment to check the query
		//print_r($query);
                //Run the query.
		return Database::InsertOrUpdate($query,$conn);
    }
    
    public static function getVehicle($id)
    {
        //Create DB connection
        $conn = Database::Connect();
        //Query to pass to the DB. values are escaped.
        $query = 'SELECT * FROM vehicle WHERE id = '.$id;
        //Uncomment to check the query
        //print_r($query);
        //Run the query.
        $cursor = Database::Reader($query,$conn);
        $row = Database::Read($cursor);
        extract($row);
        $arr['model_id'] = $model_id;
        $arr['comp_oil_type_id'] = $comp_oil_type_id;
        $arr['customer_id'] = $customer_id;
        $arr['plate_no'] = $plate_no;
        $arr['notes'] = $notes;

        return $arr;
    }

    public static function getCustomer($id)
    {
        //Create DB connection
        $conn = Database::Connect();
        //Query to pass to the DB. values are escaped.
        $query = 'SELECT * FROM customer WHERE id = '.$id;
        //Uncomment to check the query
        //print_r($query);
        //Run the query.
        $cursor = Database::Reader($query,$conn);
        $row = Database::Read($cursor);
        extract($row);
        $arr['name'] = $name;
        $arr['address'] = $address;
        $arr['tele1'] = $tele1;
        $arr['tele2'] = $tele2;
        $arr['mobile'] = $mobile;
        $arr['email'] = $email;
        $arr['notes'] = $notes;


        return $arr;
    }
    

    public static function getServiceDetails($id)
    {
        //Create DB connection
        $conn = Database::Connect();
        //Query to pass to the DB. values are escaped.
        $query = 'SELECT * FROM service WHERE id = '.$id;
        //Uncomment to check the query
        //print_r($query);
        //Run the query.
        $cursor = Database::Reader($query,$conn);
        $row = Database::Read($cursor);
        extract($row);
        $arr['odometer'] = $odometer;
        $arr['serviceDesc'] = $service_desc;
        $arr['nextService'] = $next_service;
        $arr['notes'] = $notes;


        return $arr;
    }
    public static function getMakeDetails($id)
    {
        //Create DB connection
        $conn = Database::Connect();
        //Query to pass to the DB. values are escaped.
        $query = 'SELECT * FROM make WHERE id = '.$id;
        //Uncomment to check the query
        //print_r($query);
        //Run the query.
        $cursor = Database::Reader($query,$conn);
        $row = Database::Read($cursor);
        extract($row);
        $arr['name'] = $name;

        return $arr;
    }
    public static function getModelDetails($id)
    {
        //Create DB connection
        $conn = Database::Connect();
        //Query to pass to the DB. values are escaped.
        $query = 'SELECT * FROM model WHERE id = '.$id;
        //Uncomment to check the query
        //print_r($query);
        //Run the query.
        $cursor = Database::Reader($query,$conn);
        $row = Database::Read($cursor);
        extract($row);
        $arr['name'] = $name;
        $arr['make_id'] = $make_id;

        return $arr;
    }

    public static function getVehicleFullDetail($id)
    {
        //Create DB connection
        $conn = Database::Connect();
        //Query to pass to the DB. values are escaped.
        $query = 'SELECT vehicle.id,make.name AS make,model.name AS model,
            comp_oil_type.oil_type, vehicle.plate_no,vehicle.notes, vehicle.customer_id
            FROM vehicle 
            INNER JOIN model ON vehicle.model_id = model.id
            INNER JOIN make ON model.make_id = make.id
            INNER JOIN comp_oil_type ON vehicle.comp_oil_type_id = comp_oil_type.id
            WHERE vehicle.id = '.$id;
        //Uncomment to check the query
        //print_r($query);
        //Run the query.
        $cursor = Database::Reader($query,$conn);
        $row = Database::Read($cursor);
        extract($row);
        $arr['id'] = $id;
        $arr['customer_id'] = $customer_id;
        $arr['oil_type'] = $oil_type;
        $arr['make'] = $make;
        $arr['plate_no'] = $plate_no;
        $arr['notes'] = $notes;
        $arr['model'] = $model;

        return $arr;
    }

    public static function getMakeFromModel($modelId)
    {
        //Create DB connection
        $conn = Database::Connect();
        //Query to pass to the DB. values are escaped.
        $query = sprintf("
                SELECT make.id
                FROM make INNER JOIN model ON make.id = model.make_id
                WHERE model.id = '%d'",
                mysql_escape_string($modelId));

        //Uncomment to check the query
        //print_r($query);
        //Run the query.
        $cursor = Database::Reader($query,$conn);
        $row = Database::Read($cursor);
        extract($row);
        return $id;
    }





    //
    //========================================================================
    //
    public static function getServiceCountPerMonth()
    {
        //Create DB connection
        $conn = Database::Connect();
        //Query to pass to the DB. values are escaped.
        $query = "SELECT COUNT(service.id) AS services,
                CONCAT_WS('-',YEAR(service.create_date),MONTH(service.create_date)) AS Date
            FROM `service`
            WHERE service.create_date BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 MONTH) AND CURDATE()
            GROUP BY MONTH(service.create_date)";
        //Uncomment to check the query
        //print_r($query);
        //Run the query.
        $arr = null;
        $cursor = Database::Reader($query,$conn);
        while($row = Database::Read($cursor))
        {
            extract($row);
            $arr[] = $services;
        }

        return $arr;
    }
    public static function getServiceCountPerMonthLabels_X()
    {
        //Create DB connection
        $conn = Database::Connect();
        //Query to pass to the DB. values are escaped.
        $query = "SELECT COUNT(service.id) AS services,
                CONCAT_WS('-',YEAR(service.create_date),MONTH(service.create_date)) AS date
            FROM `service`
            WHERE service.create_date BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 MONTH) AND CURDATE()
            GROUP BY MONTH(service.create_date)";
        //Uncomment to check the query
        //print_r($query);
        //Run the query.
        $cursor = Database::Reader($query,$conn);
        while($row = Database::Read($cursor))
        {
            extract($row);
            $arr[] = $date;
        }

        return $arr;
    }

    public static function getMostServicedVehicles()
    {
        //Create DB connection
        $conn = Database::Connect();
        //Query to pass to the DB. values are escaped.
        $query = "  SELECT COUNT(service.id) AS count, vehicle.plate_no
                    FROM service INNER JOIN vehicle ON vehicle.id = service.vehicle_id
                    WHERE service.create_date BETWEEN DATE_SUB(CURDATE(), INTERVAL 12 MONTH) AND CURDATE()
                    GROUP BY vehicle.plate_no
                    LIMIT 0,5";
        //Uncomment to check the query
        //print_r($query);
        //Run the query.
        $arr = null;
        $cursor = Database::Reader($query,$conn);
        while($row = Database::Read($cursor))
        {
            extract($row);
            $arr[] = $count;
        }

        return $arr;
    }
    public static function getMostServicedVehiclesLabels_X()
    {
        //Create DB connection
        $conn = Database::Connect();
        //Query to pass to the DB. values are escaped.
        $query = "SELECT COUNT(service.id) AS count, vehicle.plate_no
                    FROM service INNER JOIN vehicle ON vehicle.id = service.vehicle_id
                    WHERE service.create_date BETWEEN DATE_SUB(CURDATE(), INTERVAL 12 MONTH) AND CURDATE()
                    GROUP BY vehicle.plate_no
                    LIMIT 0,5";
        //Uncomment to check the query
        //print_r($query);
        //Run the query.
        $cursor = Database::Reader($query,$conn);
        while($row = Database::Read($cursor))
        {
            extract($row);
            $arr[] = $plate_no;
        }

        return $arr;
    }

    public static function GetVehicleDueForService()
    {
        $conn = Database::Connect();

        $query = "
            SELECT service.id, vehicle.plate_no, make.name AS make, model.name AS model, customer.name AS customer,
                customer.tele1, customer.mobile, service.create_date AS last_serv,service.next_service,
                service.next_serv_informed
            FROM customer
            INNER JOIN vehicle ON customer.id = vehicle.customer_id
            INNER JOIN service ON vehicle.id = service.vehicle_id
            INNER JOIN model ON vehicle.model_id = model.id
            INNER JOIN make ON model.make_id = make.id
            WHERE service.next_service <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)
            AND service.status != 'd'";
        //print($query);

        $pager = new PS_Pagination($conn, $query, 20, 5);

        //$cursor = Database::Reader($query, $conn);
        $rs = $pager->paginate();

        $vehicleArr = null;
        if($rs)
        {
            while($row = Database::Read($rs))
            {
                if(is_array($row))
                {
                    extract($row);

                    $vehicle['id'] = $id;
                    $vehicle['plate_no'] = $plate_no;
                    $vehicle['make'] = $make;
                    $vehicle['model'] = $model;
                    $vehicle['customer'] = $customer;
                    $vehicle['tele1'] = $tele1;
                    $vehicle['mobile'] = $mobile;
                    $vehicle['last_serv'] = $last_serv;
                    $vehicle['next_service'] = $next_service;
                    $vehicle['next_serv_informed'] = $next_serv_informed;
                    $vehicle['nav'] = $pager->renderFullNav();

                    $vehicleArr[] = $vehicle;
                }
            }
        }
        return $vehicleArr;
    }

    public static function nextServInformed($id)
    {
        $today= getdate();
        $conn = Database::Connect();

        $query =  sprintf("UPDATE `service` SET
            `next_serv_informed` = 1
            WHERE `id` = '%s'",
                mysql_real_escape_string($id));
		//Uncomment to check the query
		//print_r($query);
                //Run the query.
		return Database::InsertOrUpdate($query,$conn);
    }

    public static function backup_tables($tables = '*')
    {
        $conn = Database::Connect();

        $return.= "DROP DATABASE `crp_srs`;
CREATE DATABASE `crp_srs` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `crp_srs`;\n\n
";
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
                $query = 'SHOW TABLES';
                $cursor = Database::Reader($query,$conn);
                
		while($row = Database::Read($cursor))
		{
                    $tables[] = $row['Tables_in_crp_srs'];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}

	//cycle through
	foreach($tables as $table)
	{
		$query = 'SELECT * FROM '.$table;
                
                $cursor1 = Database::Reader($query,$conn);
		$num_fields = Database::NoOfFields($cursor1);
                
		//$return.= 'DROP TABLE '.$table.';';
                
                $query = 'SHOW CREATE TABLE '.$table;
                $cursor = Database::Reader($query,$conn);
                
                $row2 = Database::FetchRow($cursor);
		$return.= "\n\n".$row2[1].";\n\n";

		for ($i = 0; $i < $num_fields; $i++)
		{
                    
			while($row = Database::FetchRow($cursor1))
			{
                            
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j < $num_fields; $j++)
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = str_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j < ($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}

	
	return $return;
    }
}
?>
