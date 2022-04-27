<?php

namespace Bardo\Ujvilagbackend\Model;

use Bardo\Ujvilagbackend\Service\Database;
use Bardo\Ujvilagbackend\Model\Product;
use DateTime;

class ProductRepository
{

    private Database $_db;

    function __construct(Database $db)
    {
        $this->_db = $db;
    }

    public function getProducts(): array
    {
        $return = [];
        $results = $this->_db->query("
            SELECT
                p.id as pid,
                s.id as sid,
                pn.name as name,
                p.product_number as product_number,
                p.sku as sku,
                pn.language as language,
                AVG(s.purchase_price) as purchase_price,
                SUM(s.quantity) as quantity,
                s.purchase_date as purchase_date,
                s.productcondition as productcondition
            FROM
                products p
            JOIN productname pn ON
                pn.productid = p.id 
            JOIN stocks s ON
                s.productid = p.id
            WHERE
                pn.language='hu'
            GROUP BY
                p.id
    ");
        foreach ($results as $p) {
            $product = new Product();
            $product->fill(
                $p['pid'] + 0,
                $p['sid'] + 0,
                $p['name'],
                $p['language'],
                $p['quantity'] + 0,
                $p['sku'],
                $p['product_number'],
                $p['purchase_price'] + 0,
                new DateTime(date("Y-m-d H:i:s", strtotime($p['purchase_date']))),
                $p['productcondition'],
                null,
                0
            );
            $return[] = $product;
        }
        return $return;
    }

    public function getProductsById(int $id): array
    {
        $results = $this->_db->query("
            SELECT
                p.id as pid,
                s.id as sid,
                pn.name as name,
                p.product_number as product_number,
                p.sku as sku,
                pn.language as language,
                s.purchase_price as purchase_price,
                s.quantity as quantity,
                s.purchase_date as purchase_date,
                s.productcondition as productcondition,
                e.name as employee_name,
                e.id as employee_id
            FROM
                products p
            JOIN productname pn ON
                pn.productid = p.id
            JOIN stocks s ON
                s.productid = p.id
            JOIN employees e ON
                s.employeeid = e.id
            WHERE
                p.id =" . $id . "
            AND
                pn.language='hu'
    ");
        foreach ($results as $p) {
            $product = new Product();
            $product->fill(
                $p['pid'] + 0,
                $p['sid'] + 0,
                $p['name'],
                $p['language'],
                $p['quantity'] + 0,
                $p['sku'],
                $p['product_number'],
                $p['purchase_price'] + 0,
                new DateTime(date("Y-m-d H:i:s", strtotime($p['purchase_date']))),
                $p['productcondition'],
                $p['employee_name'],
                $p['employee_id'] + 0
            );
            $return[] = $product;
        }
        return $return;
    }

    public function getProductsByIdInStock(int $pid, int $sid): Product
    {
        $result = $this->_db->query("
            SELECT
                p.id as pid,
                s.id as sid,
                pn.name as name,
                p.product_number as product_number,
                p.sku as sku,
                pn.language as language,
                s.purchase_price as purchase_price,
                s.quantity as quantity,
                s.purchase_date as purchase_date,
                s.productcondition as productcondition,
                e.name as employee_name,
                e.id as employee_id
            FROM
                products p
            JOIN productname pn ON
                pn.productid = p.id
            JOIN stocks s ON
                s.productid = p.id
            JOIN employees e ON
                s.employeeid = e.id
            WHERE
                p.id =" . $pid . "
            AND
                s.id =" . $sid . "
            AND
                pn.language='hu'
    ");
        $p = $result[0];
        $product = new Product();
        $product->fill(
            $p['pid'] + 0,
            $p['sid'] + 0,
            $p['name'],
            $p['language'],
            $p['quantity'] + 0,
            $p['sku'],
            $p['product_number'],
            $p['purchase_price'] + 0,
            new DateTime(date("Y-m-d H:i:s", strtotime($p['purchase_date']))),
            $p['productcondition'],
            $p['employee_name'],
            $p['employee_id']
        );

        return $product;
    }

    public function searchProducts(string $field, string $value): array
    {
        $return = [];
        $results = $this->_db->query("
            SELECT
                p.id as id,
                pn.name as name,
                p.product_number as product_number,
                p.sku as sku,
                pn.language as language,
                AVG(s.purchase_price) as purchase_price,
                SUM(s.quantity) as quantity,
                s.purchase_date as purchase_date,
                s.productcondition as productcondition
            FROM
                products p
            JOIN productname pn ON
                pn.productid = p.id
            JOIN stocks s ON
                s.productid = p.id
            WHERE
                " . $field . " like '%" . $value . "%'
            AND
                pn.language='hu'
            GROUP BY
                p.id
    ");

        foreach ($results as $p) {
            $product = new Product();
            $product->fill(
                $p['id'] + 0,
                0,
                $p['name'],
                $p['language'],
                $p['quantity'] + 0,
                $p['sku'],
                $p['product_number'],
                $p['purchase_price'] + 0,
                new DateTime(date("Y-m-d H:i:s", strtotime($p['purchase_date']))),
                $p['productcondition'],
                null,
                0
            );
            $return[] = $product;
        }
        return $return;
    }
    public function updateProduct(Product $p)
    {
        $sql = "select language from productname where productid=" . $p->productid . " and language='" . $p->language . "'";
        if ($this->_db->existsRow($sql)) {
            error_log("EXISTS ROW");
            $sql = "update productname set name = '" . $p->name .
                "' where productid=" . $p->productid . " and language='" . $p->language . "'";
            $this->_db->execute($sql);
        }
        error_log("updateproduct: " . print_r($p, true));
    }
}
