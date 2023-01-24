<?php
require_once __DIR__ . "/../bootstrap.php";

dump("It Works");

class IndexPage extends Page {

    public string $title = "Cokoliv";

    protected function HTMLPageBody(): string
    {
//        return "<p>Hlavni strana</p> ";
//        return PdoProvider::get();
    }
}

$page = new IndexPage();
$page->render();

?>