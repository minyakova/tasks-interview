<?php
declare(strict_types=1);

namespace App;

use Exception;
use PDO;
use PDOStatement;

class App
{
    private PDO $pdo;
    private PDOStatement $selectStatementALL;
    private PDOStatement $selectStatementProducts;

    public function __construct(){

        $this->pdo = $this->dbConnect();

    }

    public function dbConnect():PDO
    {
        try{
            $ini = parse_ini_file('./config/config.ini');

            $host = $ini['host'];
            $database = $ini['database'];
            $username = $ini['username'];
            $password = $ini['password'];

            $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);

        }catch (Exception $e){
            echo $e->getMessage();
        }

        return $conn;
    }


    public function run():void
    {
        $group = $_GET['group'];

        echo '<a href="?group=all">Все товары</a><br>';

        $cat = $this->getCat();//Массив категорий

        $parent = $this->findParent($cat,$group);//Массив родителей
        $child = $this->findChild($cat,$group);//Массив потомков

        $tree = $this->getTree($cat);//Формирование дерева

        $menu = '<ul>'.$this->showCat($tree,$group,$child).'</ul>';

        echo '<pre>';
        print_r($menu);
        echo '</pre>';

        $this->getProducts($child);


    }

    public function getCat():array
    {
        $this->selectStatementALL = $this->pdo->prepare(
            'SELECT groups.id, groups.id_parent, groups.name, products.col 
                   FROM groups
                   LEFT JOIN (Select id_group, count(1) as col from products group by id_group) products 
                   ON products.id_group=groups.id;'
        );

        $this->selectStatementALL->setFetchMode(PDO::FETCH_ASSOC);
        $this->selectStatementALL->execute();
        $result = $this->selectStatementALL->fetchAll();

        $cat = array();
        foreach ($result as $item) {
            $cat[$item['id']] = $item;

        }
        return $cat;
    }

    public function getProducts(?array $child):void
    {
        $group = $_GET['group'];
        $orders=array("name");
        $key=array_search("ASC",$orders);
        $order = $orders[$key];

        $sql = "SELECT * FROM products ";

        if(empty($child)){
            if($group=='all' or !isset($group)){
                $sql .= "ORDER BY {$order}";
            }else{
                $sql .= "WHERE id_group=".$group." ORDER BY {$order}";
            }
            $execute = [];
        }else {
            $child[] = $group;
            $place_holders = implode(',', array_fill(0, count($child), '?'));
            $sql .= "WHERE id_group IN (".$place_holders.") ORDER BY {$order}";
            $execute = $child;
        }


        $this->selectStatementProducts = $this->pdo->prepare(
            $sql
        );
        $this->selectStatementProducts->setFetchMode(PDO::FETCH_ASSOC);
        $this->selectStatementProducts->execute($execute);

        $result1 = $this->selectStatementProducts->fetchAll();

        foreach ($result1 as $item) {
            echo $item['name']."<br>";
        }

    }

    public function findParent($cats, $catID):array
    {
        do {

            $parentTree[] = $cats[$catID]["id_parent"];
            $catID = $cats[$catID]["id_parent"];

        } while(array_key_exists($catID, $cats)); // пока `id_parent` известен

        return $parentTree;
    }

    public function findChild($cats,$catID,$childTree=[]):?array
    {

            foreach ($cats as $cats1){
                if($cats1["id_parent"]==$catID){

                    $childTree[] = $cats1["id"];
                }
            }

            foreach ($childTree as $item){
                foreach ($cats as $cats1) {
                    if($cats1["id_parent"]==$item) {

                        $childTree[] = $cats1["id"];
                    }
                }
            }

        return $childTree;
    }

    public function getTree($data,$sub=0):array
    {

        $tree = array();
        foreach ($data as $id => &$item){
            if(!$item['id_parent']){
                $tree[$id] = &$item;
            }else{
                $data[$item['id_parent']]['childs'][$id] = &$item;
            }
        }
        return $tree;

    }

    public function tplMenu($category,$idGroup=0,$child=[]):string
    {
        $menu = "<li>";
        $menu .= '<a href="index?group='. $category["id"] . '">' . $category["name"] .'</a> ('. $category["col"].')';

        if(isset($category['childs'])){
                $menu .= '<ul>'.$this->showCat($category['childs'],$idGroup,$child).'</ul>';
        }

        $menu .= "</li>";

        return $menu;
    }

    public function showCat($data,$idGroup,$child):string
    {

        $string ='';

        foreach ($data as $id=>$item){
                $string .= $this->tplMenu($item,$idGroup,$child);
        }

        return $string;
    }


}