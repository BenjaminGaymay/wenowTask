<?php


use Phinx\Migration\AbstractMigration;

class InitialSetup extends AbstractMigration
{
    public function up()
    {
        $this->table("companies", ['signed' => false])
            ->addColumn("name", "string", ["limit" => 80, "null" => false])
            ->save();
        $this->table("companies")->insert([
            [
                "id" => 1,
                "name" => "Arctic bears"
            ],
            [
                "id" => 2,
                "name" => "Bees"
            ],
            [
                "id" => 3,
                "name" => "Clean Sky"
            ]
        ])->saveData();
        $this->table("vehicles", ['signed' => false])
            ->addColumn("company_id", "integer", ['signed' => false, "null" => false])
            ->addColumn("plates", "string", ["limit" => 9, "null" => false])
            ->addColumn("active", "boolean", ["default" => true])
            ->addForeignKey("company_id", "companies", "id")
            ->save();
        $this->table("vehicles")->insert([
            [
                "id" => 1,
                "company_id" => 2,
                "plates" => "BA-123-CC",
                "active" => 0
            ],
            [
                "id" => 2,
                "company_id" => 2,
                "plates" => "BB-234-DD",
                "active" => 0
            ],
            [
                "id" => 3,
                "company_id" => 3,
                "plates" => "CA-123-ED",
                "active" => 1
            ],
            [
                "id" => 4,
                "company_id" => 3,
                "plates" => "CB-234-CC",
                "active" => 1
            ],
            [
                "id" => 5,
                "company_id" => 3,
                "plates" => "CC-345-CC",
                "active" => 0
            ]
        ])->saveData();
        $this->table("trips", ['signed' => false])
            ->addColumn("vehicles_id", "integer", ['signed' => false, "null" => false])
            ->addColumn("distance", "integer", ["signed" => false, "null" => false])
            ->addColumn("duration", "integer", ["signed" => false, "null" => false])
            ->addColumn("start_date", "date", ["null" => false])
            ->addForeignKey("vehicles_id", "vehicles", "id")
            ->save();
        $tripsData = [
            [1, 1, 1983, 285, "2018-09-29 10:21:07"],
            [2, 2, 1521, 191, "2018-09-28 18:35:10"],
            [3, 3, 11102, 1462, "2018-09-28 18:03:06"],
            [4, 4, 1259, 177, "2018-09-28 13:36:22"],
            [5, 3, 1591, 238, "2018-09-28 12:33:12"],
            [6, 3, 51767, 3375, "2018-09-28 10:29:50"],
            [7, 3, 60366, 4229, "2018-09-28 07:47:26"],
            [8, 4, 12542, 1174, "2018-09-27 18:54:17"],
            [9, 4, 23169, 1790, "2018-09-27 09:12:30"],
            [10, 3, 28158, 1721, "2018-09-27 07:46:03"],
            [11, 4, 12367, 973, "2018-09-26 19:18:34"],
            [12, 4, 12868, 1034, "2018-09-26 13:43:37"],
            [13, 4, 12480, 1121, "2018-09-26 12:05:31"],
            [14, 4, 14839, 1674, "2018-09-26 08:00:08"],
            [15, 3, 12459, 1107, "2018-09-25 18:58:31"],
            [16, 3, 14536, 1954, "2018-09-25 07:45:37"],
            [17, 3, 12601, 1077, "2018-09-24 19:00:53"],
            [18, 2, 12102, 948, "2018-09-24 13:47:37"],
            [19, 5, 1495, 198, "2018-09-24 13:40:08"],
            [20, 5, 12513, 1118, "2018-09-24 12:00:52"],
            [21, 3, 14484, 2159, "2018-09-24 07:52:40"],
            [22, 2, 74197, 4064, "2018-09-23 15:48:52"],
            [23, 3, 16546, 1511, "2018-09-22 17:17:54"],
            [24, 5, 16162, 1082, "2018-09-22 16:43:05"],
            [25, 2, 16523, 1223, "2018-09-22 14:17:57"],
            [26, 2, 964, 144, "2018-09-22 14:09:27"],
            [27, 3, 14904, 1190, "2018-09-22 13:24:10"],
            [28, 3, 13862, 1145, "2018-09-22 11:44:44"],
            [29, 2, 2031, 327, "2018-09-22 11:24:35"],
            [30, 2, 1413, 360, "2018-09-22 10:48:47"],
            [31, 2, 1252, 200, "2018-09-22 10:41:40"]
        ];
        $keys = ['id', 'vehicles_id', 'distance', 'duration', 'start_date'];
        $tripsTable = $this->table("trips");
        foreach ($tripsData as $trip) {
            $tripsTable->insert([
                array_combine($keys, $trip)
            ]);
        }
        $tripsTable->saveData();
    }

    public function down()
    {
        $this->table("trips")->drop()->save();
        $this->table("vehicles")->drop()->save();
        $this->table("companies")->drop()->save();
    }
}
