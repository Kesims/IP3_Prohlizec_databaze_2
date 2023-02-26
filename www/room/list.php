<?php

include "../../bootstrap.php";

class RoomListPage extends CRUDPage
{

    public string $title = "Seznam místností";

    protected function HTMLPageBody(): string
    {
        $html = $this->alert();

        // ziskam data o mistnostech
        $rooms = RoomModel::all();
        $html .= MustacheProvider::get()->render("roomList", ["rooms" => $rooms]);

        // vyrendruju
        return $html;
    }

    private function alert() : string {
        $action = filter_input(INPUT_GET, "action");
        if(!$action) return "";

        $success = filter_input(INPUT_GET, "success", FILTER_VALIDATE_INT);
        $data = [];

        switch($action) {
            case self::ACTION_INSERT:
                if($success === 1) {
                    $data["message"] = "Mistnost byla zalozena";
                    $data["alertType"] = "success";
                }
                else {
                    $data["message"] = "Chyba pri vytvareni mistnosti.";
                    $data["alertType"] = "danger";
                }
                break;
            case self::ACTION_DELETE:
                if($success === 1) {
                    $data["message"] = "Mistnost byla smazana";
                    $data["alertType"] = "success";
                }
                else {
                    $data["message"] = "Chyba pri mazani mistnosti.";
                    $data["alertType"] = "danger";
                }
                break;

        }

        return MustacheProvider::get()->render("alert", $data);
    }
}

$page = new RoomListPage();
$page->render();
