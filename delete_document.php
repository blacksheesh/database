<?php
require_once("connect.php");

$response = array();

if (isset($_POST['idd'])) {
    $idd = $_POST['idd'];

    // Удаление документа
    $sql = "DELETE FROM documents WHERE idd = '$idd'";
    if (mysqli_query($conn, $sql)) {
        $response['success'] = true;
        $response['message'] = "Документ успешно удален.";
    } else {
        $response['success'] = false;
        $response['message'] = "Ошибка при удалении документа: " . mysqli_error($conn);
    }
} else {
    $response['success'] = false;
    $response['message'] = "Необходимо предоставить ID документа для его удаления.";
}

mysqli_close($conn);

echo json_encode($response);
?>
