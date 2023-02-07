<?php
class RoomModel
{
    public ?int $room_id;
    public ?string $name;
    public ?string $phone;
    public ?string $no;

    private static string $table = "room";

    public function __construct(array $raw_data = [])
    {
        $this->hydrate($raw_data);
    }

    /**
     * @param $sort
     * @return array Room[]
     */
    public static function all($sort = []): array
    {
        $pdo = PdoProvider::get();
        $query = "select * from `" . self::$table . "` " . self::generateSortStatement($sort);;
        $stmt = $pdo->query($query);

        $result = [];

        while ($room = $stmt->fetch(PDO::FETCH_ASSOC))
            $result[] = new RoomModel($room);

        return $result;
    }

    public static function find($sort)
    {
        // neimplementujeme
    }

    public static function findById(int $id): ?RoomModel
    {
        $pdo = PdoProvider::get();
        $query = "select * from `" . self::$table . "` where `room_id` = {$id}";
        $stmt = $pdo->query($query);

        if($stmt->rowCount() < 1)
            return null;
        else return new RoomModel($stmt->fetch(PDO::FETCH_ASSOC));
    }

    /**
     * @param array $raw_data
     * @return void
     */
    private function hydrate(array $raw_data): void
    {
        if (array_key_exists("room_id", $raw_data)) $this->room_id = $raw_data["room_id"];
        if (array_key_exists("name", $raw_data)) $this->name = $raw_data["name"];
        if (array_key_exists("phone", $raw_data)) $this->phone = $raw_data["phone"];
        if (array_key_exists("no", $raw_data)) $this->no = $raw_data["no"];
    }

    private static function generateSortStatement(array $sort): string
    {
        if(!$sort) return "";
        $statementChunks = [];
        foreach($sort as $column => $direction) {
            $statementChunks[] = "`$column` $direction";
        }

        return "ORDER BY " . implode(" ", $statementChunks);
    }
}