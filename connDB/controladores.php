<?php
//funcion para que los capitanes incien sesion
function ing_usr($usuario, $contra) {
    include("conexion.php");
    session_start(); // esto para que se guarden los datos del usuario al ingresar a la pagina.

    if (empty($usuario) || empty($contra))  echo "<div class='alert alert-danger'>usuario no encontrado</div>";

    $usr = htmlspecialchars(trim($usuario));
    $contraIngresada = trim($contra);

    $sql = $conn->prepare("SELECT Id_caps, Nom_cap, Contra_cap FROM capitanes WHERE Nom_cap = ?");
    $sql->bind_param("s", $usr);
    $sql->execute();
    $resultado = $sql->get_result();

    if ($resultado->num_rows === 1) {
        $fila = $resultado->fetch_assoc();
        $hash_guardado = $fila['Contra_cap'];

        if (password_verify($contraIngresada, $hash_guardado)) {
            $_SESSION['id_capitan'] = $fila['Id_caps'];
            $_SESSION['nombre_cap'] = $fila['Nom_cap'];
            header("Location: index.php");
            exit;
        } else {
            echo "<div class='alert alert-danger'> Contraseña incorrecta</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Usuario no encontrado</div>";
    }

    $sql->close();
    $conn->close();
}

//funcion para registrar usuarios a su repesctiva tabla
function reg_usr($nombre_cap, $contra_cap, $nombre_equipo, $integrantes, $id_uni, $tipo_torneo, $tabla){
    include('conexion.php');
    if (
        empty($nombre_cap) || empty($nombre_equipo) || empty($integrantes) ||
        empty($id_uni) || empty($tipo_torneo) || empty($contra_cap)
    ) {
        echo "alguno de los campos esta vacio";
    } else {
        //esto primero es para verificar si el usuario existe en primer lugar
        $stmt = $conn->prepare("SELECT Id_caps FROM capitanes WHERE Nom_cap = ?");
        $stmt->bind_param("s", $nombre_cap);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $id_cap = $fila['Id_caps'];
        } else {
            //ahora si aqui registra a el equipo y su capitan
            $stmt = $conn->prepare("INSERT INTO capitanes (Nom_cap, Contra_cap, Uni_cap, Nom_equipo)
                                VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssis", $nombre_cap, $contra_cap, $id_uni, $nombre_equipo);
            $stmt->execute();
            $id_cap = $conn->insert_id;// esta cosa obtiene el id pues
        }

        $stmt = $conn->prepare("INSERT INTO $tabla (Nombre_equipo, Id_capitan, Integrantes, Id_universidad, Tipo_torneo)
                            VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sisis", $nombre_equipo, $id_cap, $integrantes, $id_uni, $tipo_torneo);

        if ($stmt->execute()) {
            echo "<script>alert('El registro al evento ha sido exitoso.');
            window.location.href = '../index.php';</script>";
        } else {
            echo "Hubo un problema en el registro: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }
}