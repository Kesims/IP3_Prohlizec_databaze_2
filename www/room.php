<?php

include "../bootstrap.php";

class RoomDetailPage extends Page
{

    private $room;
    private $employees;
//    public string $title;

    protected function prepareData(): void
    {
        parent::prepareData();

        //na koho se ptám?
        $room_id = filter_input(INPUT_GET, 'room_id', FILTER_VALIDATE_INT);
        if(!$room_id) {
            throw new BadRequestException();
        }

        //vytáhnu místnost
        $query = ('SELECT room_id, name, no, phone FROM room WHERE room_id = :roomId');
        $stmt = PdoProvider::get()->prepare($query);
        $stmt->execute(['roomId' => $room_id]);
        if($stmt->rowCount() < 1) {
            throw new NotFoundException();
        }
        $this->room = $stmt->fetch();
        $this->title = htmlspecialchars("Mistnost {$this->room->no} ({$this->room->name})");

        //získám lidi
        $query = "SELECT `name`, `surname`, `employee_id` from `employee` WHERE `room` = :roomId";
        $stmt = PdoProvider::get()->prepare($query);
        $stmt->execute(['roomId' => $room_id]);
        $this->employees = $stmt->fetchAll();
    }


    //ukážu ho

    protected function HTMLPageBody(): string
    {
        return MustacheProvider::get()->render('roomDetail', ["room" => $this->room, "employees" => $this->employees]);
    }
}

$page = new RoomDetailPage();
$page->render();
