<?php

class Navigator {

    private $currentPage;

    public function getCurrentPage() {
        return $currentPage;
    }

    public function __construct() {
        if(!isset($_GET["page"]) || $_GET["page"] == "") {
            //goTo("front");
            echo "<script>Navigator.goTo('1')</script>";
        }
    }

    public function goTo($target) {
        echo "<script>Navigator.goTo($target)</script>";
    }

    public function navbar() {
        $pages = PageDatabase::getPages();

        $pageHtml = array('<hr><ul class="nav nav-tabs">');

        //var_dump($pages);
        foreach($pages as $page) {
            $isRoot = PageDatabase::isRootMenu($page["Id"]);
            
            if($isRoot) {
                $submenus = PageDatabase::getPagesByParent($page["Id"]);

                if(is_array($submenus) && sizeof($submenus) > 0) {
                    $submenuHtml = '<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" data-toggle="dropdown"
                    href="#" role="button" aria-haspopup="true" aria-expanded="false">' . $page["Name"] . '</a><div class="dropdown-menu">';

                    foreach($submenus as $submenu) {
                        $submenuHtml .= '<a class="dropdown-item" href="?page=' . $submenu["Id"] . '">' . $submenu["Name"] . '</a>';
                    }

                    $submenuHtml .= '</div></li>';
                    array_push($pageHtml, $submenuHtml);
                } else {
                    array_push($pageHtml, '<li class="nav-item"><a class="nav-link" href="?page=' . $page["Id"] . '">' . $page["Name"] .  '</a></li>');
                }
            }

        }
        array_push($pageHtml, '</ul>');
        foreach($pageHtml as $html) {
            echo $html;
        }
    }
}

?>