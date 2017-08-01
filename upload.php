<?php

$uploadDir = 'uploads/';

$uploadFile = $uploadDir . time() . '-' . basename($_FILES['file']['name']);

if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
    echo json_encode(['uploaded' => true]);
} else {
    echo json_encode(['uploaded' => false]);
}
