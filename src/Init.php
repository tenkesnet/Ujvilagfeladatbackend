<?php

namespace Bardo\Ujvilagbackend;

use \Bardo\Ujvilagbackend\Service\Database;

class Init
{

  private Database $_db;

  function __construct(Database $db)
  {
    $this->_db = $db;
  }

  public function existsMockData(): bool
  {
    return $this->_db->existsTable('products');
  }

  public function createMockTable()
  {

    $sql = "CREATE TABLE employees (
          id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          name varchar(255) NOT NULL
        )";
    $this->_db->execute($sql);
    $sql = "CREATE TABLE productname(
          productid INT UNSIGNED not null,
          language varchar(3) not null,
          name varchar(255) NOT NULL,
          primary key(productid,language)
      )";
    $this->_db->execute($sql);

    $sql = "CREATE TABLE products (
          id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          sku varchar(20) NOT NULL,
          product_number varchar(20) NOT NULL

    )";

    $this->_db->execute($sql);

    $sql = "CREATE TABLE stocks(
          id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          productid int unsigned NOT NULL,
          purchase_price double,
          employeeid int unsigned default 1,
          purchase_date date not null,
          productcondition int,
          quantity int,
          CONSTRAINT FK_StocksEmployees FOREIGN KEY (employeeid) REFERENCES employees(id),
          CONSTRAINT FK_StocksProducts FOREIGN KEY (productid) REFERENCES products(id)
      )";
    $this->_db->execute($sql);
  }

  public function insertMockData()
  {
    $sql = "INSERT INTO employees (id,name) VALUES
            (1,'NoUser'),
            (2,'Mihály Antal'),
            (3,'Jani László'),
            (4,'Kövér Zsigmond'),
            (5,'Tordai Ildikó'),
            (6,'Cinege Ottó'),
            (7,'Fülöp Miléna'),
            (8,'Simon Paula'),
            (9,'Sárközi Olivér'),
            (10,'Borzas Sára'),
            (11,'Csizmadi Éva'),
            (12,'Sörös Jázmin'),
            (13,'Zsoldos Gyöngyvér'),
            (14,'Tóth Vince'),
            (15,'Kertész Franciska'),
            (16,'Kurucz György'),
            (17,'Balogh Zoltán'),
            (18,'Zentai Miksa'),
            (19,'Gárdonyi Hajnal'),
            (20,'Zoltánfi Jenő'),
            (21,'Szántó Gábor'),
            (22,'Kis Diána'),
            (23,'Bátori Anita'),
            (24,'Kelemen Boglárka')
    ";
    $this->_db->execute($sql);

    $sql = "INSERT INTO productname (productid,name,language) VALUES
            (1,'HP 1020 nyomtató', 'hu'),
            (2,'Irodaszék', 'hu'),
            (3,'asztal', 'hu'),
            (4,'Monitor', 'hu'),
            (5,'A4-es 80g/m2 papír','hu'),
            (6,'A4-es 110g/m2 papír','hu'),
            (7,'A3-as 80g/m2 papír','hu'),
            (8,'A3-es 110g/m2 papír','hu'),
            (9,'Légpárnás tasak, 290x370 mm külméret, 270x360 mm belméret, VICTORIA, \"W8\", fehér','hu'),
            (10,'Boríték, TC4, szilikonos, VICTORIA','hu'),
            (11,'Pólyás dosszié, prespán, A4, ESSELTE, világoskék', 'hu'),
            (12,'Gumis mappa, karton, A4, DONAU \"Standard\", kék', 'hu'),
            (13,'Harmonikamappa, A4, PP, 6 rekeszes, LEITZ \"Wow\", jégkék', 'hu'),
            (14,'Etikett, univerzális, 105x37 mm, APLI, 160 etikett/csomag', 'hu'),
            (15,'Iratpapucs, PP, A4, LEITZ \"Recycle\", fekete', 'hu'),
            (16,'Iratpapucs, műanyag, 70 mm, LEITZ \"Plus\", fekete', 'hu'),
            (17,'Szövegkiemelő, 1-5 mm, MAPED \"Fluo Peps Classic\", sárga', 'hu'),
            (18,'Ragasztószalag-adagoló, asztali, feltöltött, LEITZ \"Wow\", fehér-szürke', 'hu'),
            (19,'Laminálógép, A4, 125 mikron, REXEL, \"Style\", fekete-fehér', 'hu'),
            (20,'Telefon, vezeték nélküli, üzenetrögzítő, PANASONIC \"KX-TG6821PDB\", fekete', 'hu'),
            (21,'Naptár, A6, heti, 2022, kemény borító, SIGEL \"Conceptum\", éjkék', 'hu'),
            (22,'Rollertoll, 0,3 mm, UNI \"UB-150 Eye Micro\", kék', 'hu'),
            (23,'Golyóstoll, 0,21 mm, kupakos, ZEBRA \"H-8000\" kék', 'hu'),
            (24,'Projektor, LCD, WUXGA, 4200 lumen, EPSON \"EB-2247U\"', 'hu'),
            (25,'Vetítőállvány projektorhoz, multimédia NOBO', 'hu'),
            (26,'Vetítővászon, hordozható, 1:1, 240x240 cm, VICTORIA', 'hu'),
            (27,'Prezentációs lézermutató, vezeték nélküli, NOBO \"P2\"', 'hu'),
            (28,'Posztertábla, fali, 70x100 cm, alumínium keret, NOBO', 'hu'),
            (29,'Posztertábla, fali, A1 méret (594x841 mm), alumínium keret, VICTORIA \"Snap\"', 'hu')
    ";
    $this->_db->execute($sql);



    $sql = "INSERT INTO products ( id, sku, product_number) VALUES
            (1,'3478J','AR456SJJ'),
            (2,'5721J','vLRrxqUW'),
            (3,'2393J','teNYpjM9'),
            (4,'3196J','GnVUCKys'),
            (5,'7136J','j6EvCtWu'),
            (6,'4688J','rk5vDckm'),
            (7,'6401J','T87TTaew'),
            (8,'3795J','RrtLvTjq'),
            (9,'4963J','czxaATmj'),
            (10,'9461J','ciaCbj3G'),
            (11,'6822J','TnNJVYcr'),
            (12,'8722J','sacNBtvw'),
            (13,'9829J','DcQDLK6Y'),
            (14,'5339J','9gZHdhdn'),
            (15,'3319J','CHVtZ64X'),
            (16,'5237J','5jCQMgyB'),
            (17,'5135J','Xtd3h6r4'),
            (18,'2888J','oaarFeen'),
            (19,'4863J','5m5HjigG'),
            (20,'2725J','cHyiySqn'),
            (21,'2410J','3qNLnWiX'),
            (22,'4652J','VzdmujuZ'),
            (23,'5293J','3ZqH7DNX'),
            (24,'6698J','EB-2247U'),
            (25,'6911J','ZGtc4ouy'),
            (26,'4396J','ZGtc4ouy'),
            (27,'2745J','YFwXnJyj'),
            (28,'9817J','uqfYPc4V'),
            (29,'9382J','qH9HumL9')
            ";
    $this->_db->execute($sql);

    $sql = "INSERT INTO stocks (purchase_date,productcondition,employeeid,productid,purchase_price,quantity) values
            ('2020-03-05',100,2,1,18000, 1),
            ('2020-03-05',100,3,1,18000, 1),
            ('2020-03-05',100,4,1,18000, 1),
            ('2020-03-05',100,5,1,18000, 1),
            ('2020-03-05',100,14,1,18000, 1),
            ('2020-03-05',100,1,1,18000, 5),
            ('2020-03-24',100,2,2,35000, 1),
            ('2020-03-24',100,3,2,35000, 1),
            ('2020-03-24',100,4,2,35000, 1),
            ('2020-03-24',100,5,2,35000, 1),
            ('2020-03-24',100,14,2,35000, 1),
            ('2020-03-24',100,1,2,35000, 5),
            ('2021-05-08',100,2,3,58000, 1),
            ('2021-05-08',100,3,3,58000, 1),
            ('2021-05-08',100,4,3,58000, 1),
            ('2021-05-08',100,5,3,58000, 1),
            ('2021-05-08',100,14,3,58000, 1),
            ('2021-05-08',100,1,3,58000, 5),
            ('2021-06-10',100,2,4,40000, 1),
            ('2021-06-10',100,3,4,40000, 1),
            ('2021-06-10',100,4,4,40000, 1),
            ('2021-06-10',100,5,4,40000, 1),
            ('2021-06-10',100,14,4,40000, 1),
            ('2021-06-10',100,1,4,40000, 5),
            ('2019-05-09',100,1,5,1.5,5500),
            ('2019-12-25',100,1,6,2,2000),
            ('2019-11-16',100,1,7,5,500),
            ('2019-06-05',100,1,8,6,200),
            ('2021-07-06',100,1,9,200,40),
            ('2019-02-17',100,1,10,40,534),
            ('2019-04-17',100,1,11,287, 230),
            ('2021-04-09',100,1,12,300, 120),
            ('2021-07-07',100,1,13,1800, 20),
            ('2018-11-06',100,1,14,2047, 20),
            ('2020-01-11',100,1,15,2100, 20),
            ('2021-01-12',100,1,16,2400, 20),
            ('2018-05-10',100,1,17,258, 14),
            ('2019-07-06',100,1,18,4700, 5),
            ('2021-03-29',100,1,19,18000, 2),
            ('2021-10-05',100,2,20,28000, 1),
            ('2021-10-05',100,3,20,28000, 1),
            ('2021-10-05',100,4,20,28000, 1),
            ('2021-10-05',100,5,20,28000, 1),
            ('2021-10-05',100,10,20,28000, 1),
            ('2021-10-05',100,11,20,28000, 1),
            ('2021-10-05',100,12,20,28000, 1),
            ('2021-10-05',100,13,20,28000, 1),
            ('2021-10-05',100,14,20,28000, 1),
            ('2021-10-05',100,15,20,28000, 1),
            ('2021-10-05',100,16,20,28000, 1),
            ('2021-10-05',100,20,20,28000, 1),
            ('2020-09-14',100,1,21,5973, 24),
            ('2021-12-27',100,1,22,673, 58),
            ('2019-05-27',100,1,23,268, 87),
            ('2020-02-17',100,23,24,499000, 1),
            ('2020-02-17',100,24,24,499000, 1),
            ('2019-09-30',100,1,25,121000, 2),
            ('2018-06-24',100,1,26,74000, 2),
            ('2018-05-02',100,1,27,28800, 2),
            ('2021-02-14',100,1,28,27600, 3),
            ('2021-05-03',100,1,29,7800, 4)
    ";
    $this->_db->execute($sql);
  }
}
