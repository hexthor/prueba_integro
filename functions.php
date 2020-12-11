<?php
session_start();

if (isset($_REQUEST["function"]) && function_exists($_REQUEST["function"])){
    echo $_REQUEST["function"]("");
}

function conexion(){
	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "123456";
	$db_name = "prueba_integro";
	$conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	return $conexion;
}

function validarUsuario(){
    $info = Array();
    $info["resultado"] = false;
    $sql = "SELECT * FROM users WHERE username = '{$_REQUEST["user"]}' AND password = MD5('{$_REQUEST["pass"]}') AND deleted = 0";
    $result = mysqli_query(conexion(), $sql);
    if($row = mysqli_fetch_array($result)){
        $info["resultado"] = true;
        $_SESSION["username"] = $row["username"];
        $_SESSION["name"] = $row["name"];
    }else{
        $info["mensaje"] = "Usuario y contraseña no válidos";
    }

    echo json_encode($info);
}

function loadTable(){
    $html .= "<form method='POST' name='EditView2' id='EditView2'>";
    switch($_REQUEST["type"]){
        case "movies":
            $sql = "SELECT * FROM movies WHERE deleted = 0 ORDER BY year";
            $result = mysqli_query(conexion(), $sql);
            $html .= "<table class='table table-hover table-striped table-sm'>";
            $html .= " <thead>
                        <tr>
                            <th scope='col' style='width: 20%;'>T&iacute;tulo</th>
                            <th scope='col' style='width: 65%;'>Sinopsis</th>
                            <th scope='col' style='width: 10%;'>A&ntilde;o</th>
                            <th scope='col' style='width: 5%;'>Opciones</th>
                        </tr>
                        </thead><tbody>";
                while($row = mysqli_fetch_array($result)){
                    $html .= "<tr id='movies_{$row["id"]}' name='movies_{$row["id"]}'>
                                <td>
                                    <span id='title_{$row["id"]}' name='title_{$row["id"]}' >{$row["title"]}</span>
                                    <input style='display:none;' id='title_input_{$row["id"]}' name='title_input_{$row["id"]}' type='text' class='form-control' placeholder='T&iacute;tulo' onfocus='hideTooltip(this.id)' value='{$row["title"]}'>
                                </td>
                                <td>
                                    <span id='synopsis_{$row["id"]}' name='synopsis_{$row["id"]}' >{$row["synopsis"]}</span>
                                    <textarea style='display:none;' class='form-control' id='synopsis_input_{$row["id"]}' name='synopsis_input_{$row["id"]}' rows='3' placeholder='Sinopsis'>{$row["synopsis"]}</textarea>
                                </td>
                                <td>
                                    <span id='year_{$row["id"]}' name='year_{$row["id"]}' >{$row["year"]}</span>
                                    <input style='display:none;' id='year_input_{$row["id"]}' name='year_input_{$row["id"]}' type='text' class='form-control' placeholder='A&ntilde;o' onfocus='hideTooltip(this.id)' value='{$row["year"]}'>
                                </td>
                                <td>
                                    <div id='edit_{$row["id"]}' name='edit_{$row["id"]}'>
                                        <img class='img_button' src='images/pencil-square.svg' alt='' width='32' height='32' title='Editar' onclick='editBean(\"movies\", \"{$row["id"]}\")'>
                                        <img class='img_button' src='images/dash-square-fill.svg' alt='' width='28' height='28' title='Eliminar' onclick='deleteBean(\"movies\", \"{$row["id"]}\", \"{$row["title"]}\")'>
                                    </div>
                                    <div id='save_{$row["id"]}' name='save_{$row["id"]}' style='display: none;'>
                                        <img class='img_button' src='images/check-square-fill.svg' alt='' width='28' height='28' title='Guardar' onclick='saveBean(\"movies\", \"{$row["id"]}\")'>
                                        <img class='img_button' src='images/x-square-fill.svg' alt='' width='28' height='28' title='Cerrar' onclick='showBean(\"movies\", \"{$row["id"]}\")'>
                                    </div>
                                </td>
                            </tr>";
                }
                $html .= "</tbody></table>";
            break;

        case "users":
            $sql = "SELECT * FROM users WHERE deleted = 0 ORDER BY name";
            $result = mysqli_query(conexion(), $sql);
            $html .= "<table class='table table-hover table-striped table-sm'>";
            $html .= " <thead>
                        <tr>
                          <th scope='col' style='width: 25%;'>Nombre</th>
                          <th scope='col' style='width: 25%;'>Nickname</th>
                          <th scope='col' style='width: 25%;'><span style='display: none' id='pass_thead' name='pass_thead'>Contraseña</span></th>
                          <th scope='col' style='width: 25%;'>Opciones</th>
                        </tr>
                      </thead><tbody>";
            while($row = mysqli_fetch_array($result)){
                $html .= "<tr id='users_{$row["id"]}' name='users_{$row["id"]}'>
                            <td>
                                <span id='fullname_{$row["id"]}' name='fullname_{$row["id"]}'>{$row["name"]}</span>
                                <input style='display:none;' id='fullname_input_{$row["id"]}' name='fullname_input_{$row["id"]}' type='text' class='form-control' placeholder='Nombre' onfocus='hideTooltip(this.id)' value='{$row["name"]}'>
                            </td>
                            <td>
                                <span id='nickname_{$row["id"]}' name='nickname_{$row["id"]}'>{$row["username"]}</span>
                                <input style='display:none;' id='nickname_input_{$row["id"]}' name='nickname_input_{$row["id"]}' type='text' class='form-control' placeholder='Nickname' onfocus='hideTooltip(this.id)' value='{$row["username"]}'>
                            </td>
                            <td>
                                <input style='display:none;' id='pass_input_{$row["id"]}' name='pass_input_{$row["id"]}' type='password' class='form-control' placeholder='Contraseña' onfocus='hideTooltip(this.id)'>
                                <input style='display:none;' id='pass2_input_{$row["id"]}' name='pass2_input_{$row["id"]}' type='password' class='form-control' placeholder='Repita la Contraseña' onfocus='hideTooltip(this.id)'>
                            </td>
                            <td>
                                <div id='edit_{$row["id"]}' name='edit_{$row["id"]}'>
                                    <img class='img_button' src='images/pencil-square.svg' alt='' width='32' height='32' title='Editar' onclick='editBean(\"users\", \"{$row["id"]}\")'>
                                    <img class='img_button' src='images/dash-square-fill.svg' alt='' width='28' height='28' title='Eliminar' onclick='deleteBean(\"users\", \"{$row["id"]}\", \"{$row["name"]}\")'>
                                </div>
                                <div id='save_{$row["id"]}' name='save_{$row["id"]}' style='display: none;'>
                                    <img class='img_button' src='images/check-square-fill.svg' alt='' width='28' height='28' title='Guardar' onclick='saveBean(\"users\", \"{$row["id"]}\")'>
                                    <img class='img_button' src='images/x-square-fill.svg' alt='' width='28' height='28' title='Cerrar' onclick='showBean(\"users\", \"{$row["id"]}\")'>
                                </div>
                            </td>
                            </tr>";
            }
            $html .= "</tbody></table>";
        break;
    }

    echo $html."</form>";
}

function addBean(){
    $type = $_REQUEST["type"];
    $html .= "<form method='POST' name='EditView' id='EditView'>";
    switch($_REQUEST["type"]){
        case "movies":
            $html .= "<table class='table table-hover table-striped table-sm'>";
            $html .= " <thead>
                        <tr>
                            <th scope='col' style='width: 20%;'>T&iacute;tulo</th>
                            <th scope='col' style='width: 65%;'>Sinopsis</th>
                            <th scope='col' style='width: 10%;'>A&ntilde;o</th>
                            <th scope='col' style='width: 5%;'></th>
                        </tr>
                      </thead><tbody>";
            $html .= "<tr>
                        <td><input id='movie_title' name='movie_title' type='text' class='form-control' placeholder='T&iacute;tulo' onfocus='hideTooltip(this.id)'></td>
                        <td><textarea class='form-control' id='movie_synopsis' name='movie_synopsis' rows='3' placeholder='Sinopsis'></textarea></td>
                        <td><input id='movie_year' name='movie_year' type='text' class='form-control' placeholder='A&ntilde;o' onfocus='hideTooltip(this.id)'></td>
                        <td><button type='button' onclick='saveBean(\"$type\")' class='btn btn-outline-secondary'>Guardar</button></td>
                     </tr>";
            $html .= "</tbody></table>";
        break;
        case "users":
            $html = "<table class='table table-hover table-striped table-sm'>";
            $html .= " <thead>
                        <tr>
                          <th scope='col' style='width: 30%;'>Nombre</th>
                          <th scope='col' style='width: 30%;'>Nickname</th>
                          <th scope='col' style='width: 30%;'>Contraseña</th>
                          <th scope='col' style='width: 10%;'></th>
                        </tr>
                      </thead><tbody>";
            $html .= "<tr>
                        <td><input id='user_fullname' name='user_fullname' type='text' class='form-control' placeholder='Nombre' onfocus='hideTooltip(this.id)'></td>
                        <td><input id='user_nickname' name='user_nickname' type='text' class='form-control' placeholder='Nickname' onfocus='hideTooltip(this.id)'></td>
                        <td>
                            <input id='user_password' name='user_password' type='password' class='form-control' placeholder='Contraseña' onfocus='hideTooltip(this.id)'>
                            <input id='user_password2' name='user_password2' type='password' class='form-control' placeholder='Repita la Contraseña' onfocus='hideTooltip(this.id)'>
                        </td>
                        <td><button type='button' onclick='saveBean(\"$type\")' class='btn btn-outline-secondary'>Guardar</button></td>
                     </tr>";
            $html .= "</tbody></table>";
        break;
    }

    echo $html."</form><br>";
}

function saveBean(){
    $type = $_REQUEST["type"];
    $id = $_REQUEST["id"];
    switch($type){
        case "movies":
            if(empty($id)){
                //INSERT
                $sql = "INSERT INTO {$type} VALUES (UUID(), '{$_REQUEST["title"]}', '{$_REQUEST["synopsis"]}', '{$_REQUEST["year"]}', '0')";
            }else{
                //UPDATE
                $sql = "UPDATE {$type}
                        SET title = '{$_REQUEST["title"]}', synopsis = '{$_REQUEST["synopsis"]}', year = '{$_REQUEST["year"]}'
                        WHERE id = '{$id}' AND deleted = 0";
            }
        break;
        case "users":
            if(empty($id)){
                //INSERT
                $sql = "INSERT INTO {$type} VALUES (UUID(), '{$_REQUEST["name"]}', '{$_REQUEST["username"]}', MD5('{$_REQUEST["password"]}'), '0')";
            }else{
                //UPDATE
                $sql = "UPDATE {$type}
                        SET name = '{$_REQUEST["name"]}', username = '{$_REQUEST["username"]}', password = MD5('{$_REQUEST["password"]}')
                        WHERE id = '{$id}'  AND deleted = 0";
            }
        break;
    }

    //echo $sql; 
    $result = mysqli_query(conexion(), $sql);
}

function validateUsername(){
    $resp = Array();
    $resp["resultado"] = false;
    $filtro = (empty($_REQUEST["id"]) ? "" : " AND id <> '{$_REQUEST["id"]}'");
    $sql = "SELECT * FROM users WHERE deleted = 0 AND username = '{$_REQUEST["username"]}' $filtro";
    $result = mysqli_query(conexion(), $sql);
    if($row = mysqli_fetch_array($result)){
        $resp["resultado"] = true;
    }
    echo json_encode($resp);
}

function deleteBean(){
    $sql = "UPDATE {$_REQUEST["type"]} SET deleted = 1 WHERE id = '{$_REQUEST["id"]}'";
    $result = mysqli_query(conexion(), $sql);
}

function logout(){
    session_destroy();
    header('Location: index.php');
}
?>