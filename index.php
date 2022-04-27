<?php
require './vendor/autoload.php';

use Bardo\Ujvilagbackend\Service\MysqlDatabase;
use Bardo\Ujvilagbackend\Init;
use Bardo\Ujvilagbackend\Model\EmployeeRepository;
use Bardo\Ujvilagbackend\Model\ProductRepository;
use Bardo\Ujvilagbackend\Model\Product;

$db = new MysqlDatabase('localhost', 'root', 'Javateam1', 'ujvilag');

$init = new Init($db);
if (!$init->existsMockData()) {
  $init->createMockTable();
  $init->insertMockData();
}

$productRepository = new ProductRepository($db);
$employeeRepository = new EmployeeRepository($db);

$parsed_url = parse_url($_SERVER['REQUEST_URI']);
$method = $_SERVER['REQUEST_METHOD'];
error_log($method);
error_log($parsed_url['path']);

if (isset($parsed_url['path'])) {
  $path = $parsed_url['path'];
} else {
  $path = '';
}
$path = ltrim($path, "/");

list($path_function, $param1, $param2) = explode('/', $path, 3);
$param1 = urldecode($param1);
$param2 = urldecode($param2);
error_log("Path:" . $path_function);
error_log("Param: " . $param1 . " , " . $param2);

if ($path_function == "getProductsById" && $param1 > 0) {
  $products = $productRepository->getProductsById($param1);
  $productsArray = [];
  foreach ($products as $product) {
    $array = json_decode(json_encode($product), true);
    $productsArray[] = $array;
  }
  $result = json_encode($productsArray);
  MyHeader();
  echo $result;
  return;
}

if ($path_function == "getProductsByIdInStock" && $param1 > 0 && $param2 > 0) {
  $product = $productRepository->getProductsByIdInStock($param1, $param2);
  $result = json_encode($product);
  MyHeader();
  echo $result;
  return;
}

if ($path_function == "getEmployees") {
  $employees = $employeeRepository->getEmployees();
  $result = json_encode($employees);
  MyHeader();
  echo $result;
  return;
}


if ($path_function == "getProducts") {
  $products = $productRepository->getProducts();
  $result = json_encode($products);
  MyHeader();
  echo $result;
  return;
}

if ($path_function == "searchProducts" && strlen($param1) > 0) {
  $products = $productRepository->searchProducts($param1, $param2);
  $productsArray = [];
  foreach ($products as $product) {
    $array = json_decode(json_encode($product), true);
    $productsArray[] = $array;
  }
  $result = json_encode($productsArray);
  MyHeader();
  echo $result;
  return;
}

if ($path_function == "updateProduct" && $method == "POST") {
  $data = json_decode(file_get_contents('php://input'));
  $product = new Product();
  foreach ($data as $key => $value) {
    if ($key == "purchaseDate") {
      $date = objectToObject($data->purchaseDate, DateTime::class);
      $product->{'purchaseDate'} = $date;
    } else {
      $product->{$key} = $value;
    }
  }
  $productRepository->updateProduct($product);
  MyHeader();
  echo "";
  return;
}


MyHeader();

echo "[]";


function MyHeader()
{
  header('Content-Type: application/json; charset=utf-8');
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: GET, POST');
  header("Access-Control-Allow-Headers: *");
}

function objectToObject($instance, $className): DateTime
{
  return unserialize(sprintf(
    'O:%d:"%s"%s',
    strlen($className),
    $className,
    strstr(strstr(serialize($instance), '"'), ':')
  ));
}
