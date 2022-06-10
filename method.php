<?php
    require_once "connect.php";
    class PenghuniKos
    {
        public function get_all_penghuni() 
        {
            global $conn;
            $query = "SELECT * FROM finalproject";
            $result=$conn->query($query);
            while($row=mysqli_fetch_object($result))
            {
                $data[]=$row;
            }

            if ($data) {
                $response=array(
                    'status' => 1,
                    'message' =>'Success',
                    'data' => $data
                );
            } else {
                $response=array(
                    'status' => 0,
                    'message' =>'Data not found'
                );
            }
            
            header('Content-Type: application/json');
            echo json_encode($response);
        }

        public function get_penghuni($id) 
        {
            global $conn;

            $query = "SELECT * FROM finalproject WHERE id = $id";
            $result = $conn->query($query);

            while( $row = mysqli_fetch_object($result) ) {
                $data[] = $row;
            }

            if ( isset($data) && $data ) {
                $response = array(
                    'status' => 1,
                    'message' => 'Success',
                    'data' => $data
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Data not found'
                );
            }
            
            header('Content-Type: application/json');
            echo json_encode($response);
        }

        public function insert_penghuni()
        {
            global $conn;

            if ( !empty($_POST['nama']) ) {
                $dataPOST = $_POST;
            } else {
                $dataPOST = json_decode(file_get_contents("php://input"), true);
            }
            
            $variableInvalid = false;
            if (!$dataPOST['nama'] || !$dataPOST['asal'] || !$dataPOST['kampus'] || !$dataPOST['no_hp'] || !$dataPOST['kamar']) {
                $variableInvalid = true;
            }
    
            if (!$variableInvalid) {
                $nama = $dataPOST['nama'];
                $asal = $dataPOST['asal'];
                $kampus = $dataPOST['kampus'];
                $no_hp = $dataPOST['no_hp'];
                $kamar = $dataPOST['kamar'];
    
                $query = "INSERT INTO finalproject (nama, asal, kampus, kamar, no_hp) VALUES ('$nama', '$asal', '$kampus', '$kamar', '$no_hp')";
                $result = mysqli_query($conn,$query);
                
                if ($result) {
                    $response = array(
                        'status' => 1,
                        'message' => 'Insert Success',
                        'data' => $dataPOST
                    );
                } else {
                    $response = array(
                        'status' => 0,
                        'message' => 'Insert Failed'
                    );
                }
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Wrong parameter'
                );
            }
    
            header('Content-Type: application/json');
            echo json_encode($response);
        }

        public function update_penghuni($id)
        {
            global $conn;

            if ( !empty($_POST['nama']) ) {
                $dataPOST = $_POST;
            } else {
                $dataPOST = json_decode(file_get_contents("php://input"), true);
            }

            $variableInvalid = false;
            if (!$dataPOST['nama'] || !$dataPOST['asal'] || !$dataPOST['kampus'] || !$dataPOST['no_hp'] || !$dataPOST['kamar']) {
                $variableInvalid = true;
            }
            $dataPOST['id'] = $id;
            
            if (!$variableInvalid) {
                $nama = $dataPOST['nama'];
                $asal = $dataPOST['asal'];
                $kampus = $dataPOST['kampus'];
                $no_hp = $dataPOST['no_hp'];
                $kamar = $dataPOST['kamar'];
    
                $query = "UPDATE finalproject SET nama='$nama', asal='$asal', kampus='$kampus', no_hp='$no_hp', kamar='$kamar' WHERE id=$id";
                $result = mysqli_query($conn, $query);
                
                if ($result) {
                    $response = array(
                        'status' => 1,
                        'message' => 'Update Success',
                        'data' => $dataPOST
                    );
                } else {
                    $response = array(
                        'status' => 0,
                        'message' => 'Update Failed'
                    );
                }
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Wrong parameter'
                );
            }
    
            header('Content-Type: application/json');
            echo json_encode($response);
        }

        public function delete_penghuni($id) 
        {
            global $conn;

            $result = mysqli_query($conn,"DELETE FROM finalproject WHERE id=$id");
            
            if ($result) {
                $response = array(
                    'status' => 1,
                    'message' => 'Delete Success'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Delete Failed'
                );
            }

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
?>