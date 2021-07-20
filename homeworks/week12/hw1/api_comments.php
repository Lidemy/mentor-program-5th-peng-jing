<?php
  require_once('conn.php');
  header('Content-Type: application/json; charset=utf-8');
  header('Access-Control-Allow-Origin: *');
  if (empty($_GET['site_key'])) {
    $json = array(
      "ok" => false,
      "message" => "Please send site_key in url"
    );
    $response = json_encode($json);
    echo $response;
    die();
  }
  $site_key = $_GET['site_key'];
  $sql = "SELECT id, nickname, content, create_at 
  FROM janet_wk12_hw1_board WHERE site_key = ? " .
  (empty($_GET['before']) ? "" : "AND id < ? ") .
  "ORDER BY id DESC LIMIT 6";
  $stmt = $conn->prepare($sql);
  if (empty($_GET['before'])) {
    $stmt->bind_param('s', $site_key);
  } else {
    $stmt->bind_param('si', $site_key, $_GET['before']);
  }
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
  $result = $stmt->get_result();
  $comments = array();
  while ($row = $result->fetch_assoc()) {
    array_push($comments, array(
      "id" => $row['id'],
      "nickname" => $row['nickname'],
      "content" => $row['content'],
      "create_at" => $row['create_at']
    ));    
  }
  $json = array(
    "ok" => true,
    "comments" => $comments
  );
  $response = json_encode($json);
  echo $response;
?>