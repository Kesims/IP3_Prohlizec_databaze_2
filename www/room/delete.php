<?php

include "../../bootstrap.php";

class RoomDeletePage extends CRUDPage
{
    const STATE_FORM_REQUEST = 0;
    const STATE_DATA_SEND = 1;

    protected int $state;
    private RoomModel $room;
    private array $errors;

    public string $title = "Přidat místnost";

    protected function prepareData(): void
    {
        parent::prepareData();
        $room_id = filter_input(INPUT_POST, "room_id", FILTER_VALIDATE_INT);
        if(!$room_id) throw new BadRequestException();
        $result = RoomModel::deleteById($room_id);
        $this->redirect(self::ACTION_DELETE,true);
    }


    protected function HTMLPageBody(): string
    {
        return "";
    }
}

$page = new RoomDeletePage();
$page->render();
