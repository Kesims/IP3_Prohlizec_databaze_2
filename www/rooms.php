<?php

include "../bootstrap.php";

class RoomListPage extends Page
{

    public string $title = "Seznam místností";

    protected function HTMLPageBody(): string
    {
        // ziskam data o mistnostech
        $rooms = RoomModel::all();

        return MustacheProvider::get()->render("roomList", ["rooms" => $rooms]);

        // vyrendruju


    }
}

$page = new RoomListPage();
$page->render();
