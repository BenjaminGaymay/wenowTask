<?php
namespace controllers;

use models\SqlModelFactory;

class TaskThreeController implements ControllerInterface
{
    /** @var \Base */
    private $f3;

    /**
     * TaskThreeController constructor.
     * @param \Base $f3
     */
    public function __construct($f3)
    {
        $this->f3 = $f3;
    }

    public function display()
    {
        $this->setData();

        $this->f3->set('title','Task3 presentation');
        echo \Template::instance()->render('taskThree-view.html');
        return;
    }

    private function setData()
    {
        $vehiclesMapper = SqlModelFactory::instance()->getMapper('vehicles');
        $tripsMapper = SqlModelFactory::instance()->getMapper('trips');

        $vehiclesMapper->load();
        if ($vehiclesMapper->dry()) {
            $this->f3->error(404, "Company not found");
            return;
        }
        $RobzResults = [];
        while ($vehiclesMapper->valid()) {
		$tripsMapper->counter = "COUNT(*)";
		$tripsMapper->sum_dist = "SUM(distance)";
		$tripsMapper->sum_dur = "SUM(duration)";
		$FinalResults[$vehiclesMapper->plates] = [
			"trips" => $tripsMapper->load(["vehicles_id=?", (int)$vehiclesMapper->id])->counter,
			"sum_dist" => $tripsMapper->load(["vehicles_id=?", (int)$vehiclesMapper->id])->sum_dist,
			"sum_dur" => $tripsMapper->load(["vehicles_id=?", (int)$vehiclesMapper->id])->sum_dur,
		    ];

            $vehiclesMapper->next();
        }

        $this->f3->set("results", $FinalResults);
        return;
    }
}