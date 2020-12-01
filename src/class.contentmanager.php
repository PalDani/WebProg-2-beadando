<?php

class ContentManager {

    private $currentPage;

    public function __construct() {
        if(!isset($_GET["page"]) || $_GET["page"] == "" || !PageDatabase::pageExists($_GET["page"])) {
            echo "<div class='text-center'><h1>404 hiba - nincs találat</h1><p>Sajnos a keresett oldal nem található.</p></div>";
        } else {
            if(!file_exists('src/pages/' . PageDatabase::getPageById($_GET["page"])["PageFile"])) {
                echo "<div class='text-center'><h1>404 hiba - nincs találat</h1><p>Sajnos a keresett oldal nem található.</p></div>"; 
            } else {
                echo "<div class='paginator'></div>";
                include('src/pages/' . PageDatabase::getPageById($_GET["page"])["PageFile"]);
                $currentPage =  $_GET["page"];
            }
        }
    }
}

?>