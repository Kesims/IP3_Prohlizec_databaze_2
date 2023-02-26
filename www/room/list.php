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
                    $data["message"] = "Místnost byla založena.";
                    $data["alertType"] = "success";
                }
                else {
                    $data["message"] = "Chyba při vytváření místnosti.";
                    $data["alertType"] = "danger";
                }
                break;
            case self::ACTION_DELETE:
                if($success === 1) {
                    $data["message"] = "Místnost byla smazána.";
                    $data["alertType"] = "success";
                }
                else {
                    $data["message"] = "Chyba při mazání místnosti.";
                    $data["alertType"] = "danger";
                }
                break;
            case self::ACTION_UPDATE:
                if($success === 1) {
                    $data["message"] = "Místnost byla upravena.";
                    $data["alertType"] = "success";
                }
                else {
                    $data["message"] = "Chyba při úpravě místnosti.";
                    $data["alertType"] = "danger";
                }
                break;
        }

        return MustacheProvider::get()->render("alert", $data);
    }
}

$page = new RoomListPage();
$page->render();
