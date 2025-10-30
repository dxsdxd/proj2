<?php
class Controlador {

    private $conn;
    private $nom_usr;
    private $contra_usr;
    private $nom_tm;
    private $integrantes;
    private $id_uni;
    private $tipo_torneo;
    private $nom_tabla;

    public function __construct($conn) {
        $this->conn = $conn;
        session_start();
    }

    // SETTERS
    public function setUsuario($nombre) {
        $this->nom_usr = htmlspecialchars(trim($nombre));
    }

    public function setContra($contra) {
        $this->contra_usr = trim($contra);
    }

    public function setEquipo($nombre, $integrantes, $id_uni, $tipo_torneo, $tabla) {
        $this->nom_tm = htmlspecialchars(trim($nombre));
        $this->integrantes = (int)$integrantes;
        $this->id_uni = (int)$id_uni;
        $this->tipo_torneo = htmlspecialchars(trim($tipo_torneo));
        $this->nom_tabla = htmlspecialchars(trim($tabla));
    }

    // LOGIN
    public function ing_usr() {
        if (empty($this->nom_usr) || empty($this->contra_usr)) {
            echo "<div class='alert alert-danger'>Usuario o contraseña vacíos</div>";
            return;
        }

        $sql = $this->conn->prepare("SELECT Id_caps, Nom_cap, Contra_cap FROM capitanes WHERE Nom_cap = ?");
        $sql->bind_param("s", $this->nom_usr);
        $sql->execute();
        $resultado = $sql->get_result();

        if ($resultado->num_rows === 1) {
            $fila = $resultado->fetch_assoc();
            if (password_verify($this->contra_usr, $fila['Contra_cap'])) {
                $_SESSION['id_capitan'] = $fila['Id_caps'];
                $_SESSION['nombre_cap'] = $fila['Nom_cap'];
                header("Location: index.php");
                exit;
            } else {
                echo "<div class='alert alert-danger'>Contraseña incorrecta</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Usuario no encontrado</div>";
        }

        $sql->close();
    }

    // REGISTRO
    public function reg_usr() {
        if (
            empty($this->nom_usr) || empty($this->nom_tm) || empty($this->integrantes) ||
            empty($this->id_uni) || empty($this->tipo_torneo) || empty($this->contra_usr)
        ) {
            echo "Alguno de los campos está vacío";
            return;
        }

        // Verificar si el usuario existe
        $stmt = $this->conn->prepare("SELECT Id_caps FROM capitanes WHERE Nom_cap = ?");
        $stmt->bind_param("s", $this->nom_usr);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $id_cap = $fila['Id_caps'];
        } else {
            // Registrar nuevo capitán
            $hash = password_hash($this->contra_usr, PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare("INSERT INTO capitanes (Nom_cap, Contra_cap, Uni_cap, Nom_equipo)
                                          VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssis", $this->nom_usr, $hash, $this->id_uni, $this->nom_tm);
            $stmt->execute();
            $id_cap = $this->conn->insert_id;
        }

        // Registrar equipo
        $sql = "INSERT INTO {$this->nom_tabla} (Nombre_equipo, Id_capitan, Integrantes, Id_universidad, Tipo_torneo)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sisis", $this->nom_tm, $id_cap, $this->integrantes, $this->id_uni, $this->tipo_torneo);

        if ($stmt->execute()) {
            echo "<script>alert('El registro al evento ha sido exitoso.');
                  window.location.href = '../index.php';</script>";
        } else {
            echo "Hubo un problema en el registro: " . $this->conn->error;
        }

        $stmt->close();
    }
}