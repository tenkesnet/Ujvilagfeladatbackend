<?php

namespace Bardo\Ujvilagbackend\Model;

use DateTime;

class Product
{
  public int $productid;
  public int $stockid;
  public ?string $name;
  public ?string $language;
  public int $quantity;
  public ?string $sku;
  public ?string $productNumber;
  public float $purchasePrice;
  public ?DateTime $purchaseDate;
  public ?int $productCondition;
  public ?string $employeeName;
  public int $employeeId;
  public array $employees;

  function __construct(
    int $productid,
    int $stockid,
    ?string $name,
    ?string $language,
    int $quantity,
    ?string $sku,
    ?string $pruductNumber,
    ?float $purchasePrice,
    ?DateTime $purchaseDate,
    ?int $productCondition,
    ?string $employeeName,
    int $employeeId
  ) {
    $this->productid = $productid;
    $this->stockid = $stockid;
    $this->name = $name;
    $this->language = $language;
    $this->quantity = $quantity;
    $this->sku = $sku;
    $this->pruductNumber = $pruductNumber;
    $this->purchasePrice = $purchasePrice;
    $this->purchaseDate = $purchaseDate;
    $this->productCondition = $productCondition;
    $this->employeeName = $employeeName;
    $this->employeeId = $employeeId;
    $this->employees = [];
  }
}
