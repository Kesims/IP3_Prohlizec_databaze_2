<?php

include "../../bootstrap.php";

class RoomInsertPage extends Page
{
    const STATE_FORM_REQUEST = 0;
    const STATE_DATA_SEND = 0;

    protected int $state;
    private RoomModel $room;
    private array $errors;

    public string $title = "Přidat místnost";

    protected function prepareData(): void
    {
        parent::prepareData();
        $this->state = $this->getState();

        switch($this->state){
            case self::STATE_DATA_SEND: {
                $this->room = new RoomModel();
                break;
            }
            case self::STATE_FORM_REQUEST: {
                //načíst data
                $this->room = RoomModel::readPost();

                //zkontrolovad data
                $this->errors = [];
                if($this->room->validate($this->errors)) {
                    //zpracovat
                    $result = $this->room->insert();
                    //přesměrovat
                    $this->redirect($result);
                }
                else {
                    //na formular
                    $this->state = self::STATE_FORM_REQUEST;

                }
                //vykreslit nebo zpracovat
                break;
            }
        }
    }


    protected function HTMLPageBody(): string
    {
        // ziskam data o mistnostech
//        $rooms = RoomModel::all();

        $room = new RoomModel();
        $room->room_id = 1;
        $room->name = "Test";
        $room->no = 1;
        $room->phone = 1234;

        // vyrendruju
        return MustacheProvider::get()->render("roomForm", [
            "room" => $room,
            "errors" => [
                'no' => "Číslo je špatně"
            ]
        ]);

    }

    protected function getState() : int {
        throw new Exception("Not implemented.");
    }

    protected function redirect(bool $success): void {
        throw new Exception("Not implemented");
    }
}

$page = new RoomInsertPage();
$page->render();
