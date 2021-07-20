<?php
  require_once('conn.php');
  header('Content-Type: application/json; charset=utf-8');
  header('Access-Control-Allow-Origin: *');
  if (
    empty($_POST['nickname']) ||
    empty($_POST['content']) ||
    empty($_POST['site_key'])
  ) {
    $json = array(
      "ok" => false,
      "message" => "please input missing data."
    );
    $response = json_encode($json);
    echo $response;
    die();
  }
  $nickname = $_POST['nickname'];
  $site_key = $_POST['site_key'];
  $content = $_POST['content'];
  $sql = "INSERT INTO janet_wk12_hw1_board (site_key, nickname, content) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('sss', $site_key, $nickname, $content);
  $result = $stmt->execute();
  if (!$result) {
    $json = array(
      "ok" => false,
      "message" => $conn->error
    );
    $response = json_encode($json);
    echo $response;
    die();
  }
  $last_id = $conn->insert_id;
  $json = array(
    "ok" => true,
    "id" => $last_id
  );
  $response = json_encode($json);
  echo $response;
?>