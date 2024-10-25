<?php
// URL API
$apiUrl = "https://eastclinic.ru/assets/components/eastclinic/remote/connector.php?page=1&perPage=10&url=/vrachi/martynova-natalya-vladimirovna&action=doctors/getDoctorsMultiList&component=health&withSlots=true";

// Выполняем запрос к API
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $apiUrl);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);

// Проверка успешности запроса
if ($response === false) {
    die('Ошибка при выполнении запроса к API');
}

// Преобразуем ответ в JSON-формат (если это необходимо)
$data = json_decode($response, true);

// Проверяем, что данные успешно преобразованы
if (json_last_error() !== JSON_ERROR_NONE) {
    die('Ошибка при обработке данных API: ' . json_last_error_msg());
}

// Сохраняем данные в JSON файл в папке `data` для Hugo
file_put_contents(__DIR__ . '/../data/doctors_data.json', json_encode($data, JSON_PRETTY_PRINT));

echo "Данные успешно получены и сохранены в doctors_data.json!";
