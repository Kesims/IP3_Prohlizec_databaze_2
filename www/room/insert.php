<?php

include "../../bootstrap.php";

class RoomInsertPage extends CRUDPage
{


    protected int $state;
    private RoomModel $room;
    private array $errors;

    public string $title = "Přidat místnost";

    protected function prepareData(): void
    {
        parent::prepareData();
        $this->state = $this->getState();

        switch ($this->state) {
            case self::STATE_FORM_REQUEST:
            {
                $this->room = new RoomModel();
                $this->errors = [];
                break;
            }
            case self::STATE_DATA_SEND:
            {
                //načíst data
                $this->room = RoomModel::readPost();

                //zkontrolovad data
                $this->errors = [];
                if ($this->room->validate($this->errors)) {
                    //zpracovat
                    $result = $this->room->insert();
                    //přesměrovat
                    $this->redirect(self::ACTION_INSERT, $result);
                } else {
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

        // vyrendruju
        return MustacheProvider::get()->render("roomForm", [
            "room" => $this->room,
            "errors" => $this->errors
        ]);

    }

    protected function getState(): int
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            return self::STATE_DATA_SEND;
        }
        return self::STATE_FORM_REQUEST;
    }


}

$page = new RoomInsertPage();
$page->render();
