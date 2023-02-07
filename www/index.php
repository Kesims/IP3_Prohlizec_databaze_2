<?php
require_once __DIR__ . "/../bootstrap.php";

dump("It Works");

class IndexPage extends Page {

    public string $title = "Cokoliv";

    protected function HTMLPageBody(): string
    {
        $room = RoomModel::all();
        dump($room);


        return "<p>Hlavni strana</p> ";
    }
}

$page = new IndexPage();
$page->render();

?>