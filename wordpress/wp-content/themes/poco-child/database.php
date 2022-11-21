<?php
class Database {

  protected $connection;
  protected $query;
  protected $show_errors = TRUE;
  protected $query_closed = TRUE;
  public $query_count = 0;

  public function __construct($dbhost, $dbuser, $dbpass, $dbname, $charset = 'utf8') {
    $this->connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    if ($this->connection->connect_error) {
      $this->error('Failed to connect to MySQL - ' . $this->connection->connect_error);
    }
    $this->connection->set_charset($charset);
  }

  public function query($query) {
    if (!$this->query_closed) {
      $this->query->close();
    }
    if ($this->query = $this->connection->prepare($query)) {
      if (func_num_args() > 1) {
        $x = func_get_args();
        $args = array_slice($x, 1);
        $types = '';
        $args_ref = array();
        foreach ($args as $k => &$arg) {
          if (is_array($args[$k])) {
            foreach ($args[$k] as $j => &$a) {
              $types .= $this->_gettype($args[$k][$j]);
              $args_ref[] = &$a;
            }
          } else {
            $types .= $this->_gettype($args[$k]);
            $args_ref[] = &$arg;
          }
        }
        array_unshift($args_ref, $types);
        call_user_func_array(array($this->query, 'bind_param'), $args_ref);
      }
      $this->query->execute();
      if ($this->query->errno) {
        $this->error('Unable to process MySQL query (check your params) - ' . $this->query->error);
      }
      $this->query_closed = FALSE;
      $this->query_count++;
    } else {
      $this->error('Unable to prepare MySQL statement (check your syntax) - ' . $this->connection->error);
    }
    return $this;
  }

  public function fetchAll($callback = null) {
    $params = array();
    $row = array();
    $meta = $this->query->result_metadata();
    while ($field = $meta->fetch_field()) {
      $params[] = &$row[$field->name];
    }
    call_user_func_array(array($this->query, 'bind_result'), $params);
    $result = array();
    while ($this->query->fetch()) {
      $r = array();
      foreach ($row as $key => $val) {
        $r[$key] = $val;
      }
      if ($callback != null && is_callable($callback)) {
        $value = call_user_func($callback, $r);
        if ($value == 'break') break;
      } else {
        $result[] = $r;
      }
    }
    $this->query->close();
    $this->query_closed = TRUE;
    return $result;
  }

  public function fetchArray() {
    $params = array();
    $row = array();
    $meta = $this->query->result_metadata();
    while ($field = $meta->fetch_field()) {
      $params[] = &$row[$field->name];
    }
    call_user_func_array(array($this->query, 'bind_result'), $params);
    $result = array();
    while ($this->query->fetch()) {
      foreach ($row as $key => $val) {
        $result[$key] = $val;
      }
    }
    $this->query->close();
    $this->query_closed = TRUE;
    return $result;
  }

  public function close() {
    return $this->connection->close();
  }

  public function numRows() {
    $this->query->store_result();
    return $this->query->num_rows;
  }

  public function affectedRows() {
    return $this->query->affected_rows;
  }

  public function lastInsertID() {
    return $this->connection->insert_id;
  }

  public function error($error) {
    if ($this->show_errors) {
      exit($error);
    }
  }

  private function _gettype($var) {
    if (is_string($var)) return 's';
    if (is_float($var)) return 'd';
    if (is_int($var)) return 'i';
    return 'b';
  }

  public function isApiAdmin($token) {
    $query_token = $this->query("select user from token where token = '$token'");
    if($query_token->numRows() == 1 && $query_token->fetchArray()["user"] == "administrador"){
      return true;
    } else {
      return false;
    }
  }

  public function isApiValidToken($token) {
    $query_token = $this->query("select user from token where token = '$token'");
    if($query_token->numRows() == 1){
      return true;
    } else {
      return false;
    }
  }

  public function insertApiLog($request, $response, $execution_time) {
    $insert = $this->query("INSERT INTO log (request, response, execution_time) VALUES ('" . $request . "', '" . json_encode($response) . "', $execution_time);");
    if($insert->affectedRows() == 1) {
      return true;
    } else {
      return false;
    }
  }

  public function consultTSOId($plate) {
    $query_consult = $this->query("select unit_tso_id from unit_tso where plate = '$plate'");

    if($query_consult->numRows() == 1){
      return $query_consult->fetchArray()["unit_tso_id"];
    } else {
      return '';
    }
  }

  public function insertTSOId($plate, $tso_id) {
    $insert = $this->query("INSERT INTO unit_tso (unit_tso_id, plate) VALUES ('$tso_id', '$plate');");
    if($insert->affectedRows() == 1) {
      return true;
    } else {
      return false;
    }
  }


}
