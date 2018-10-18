<?php
/**
 * Created by PhpStorm.
 * User: piotr.grzegorzewski
 * Date: 13/10/2018
 * Time: 23:52
 */
namespace controllers;

use models\SqlModelFactory;

class SampleController implements ControllerInterface
{
    /** @var \Base */
    private $f3;

    /**
     * SampleController constructor.
     * @param \Base $f3
     */
    public function __construct($f3)
    {
        $this->f3 = $f3;
    }

    public function display()
    {
        $this->setData();

        $this->f3->set('title','Sample presentation');
        echo \Template::instance()->render('sample-view.html');
        return;
    }

    private function setData()
    {
        $companiesMapper = SqlModelFactory::instance()->getMapper('companies');
        $vehiclesMapper = SqlModelFactory::instance()->getMapper('vehicles');
        $tripsMapper = SqlModelFactory::instance()->getMapper('trips');

        $finalData = [];
        $this->f3->set("data", $finalData); // Setting default response, just in case the method finishes earlier

        $companiesMapper->load(["id=?", 3]);
        if ($companiesMapper->dry()) {
            $this->f3->error(404, "Company not found");
            return;
        }
        $this->f3->set("companyName", (string)$companiesMapper->name);

        $vehiclesMapper->load(["company_id=?", (int)$companiesMapper->id]);
        if ($vehiclesMapper->dry()) {
            $this->f3->error(404, "Company has no vehicles assigned");
            return;
        }
        $vehicleIDs = [];
        while ($vehiclesMapper->valid()) {
            $vehicleIDs[] = (int)$vehiclesMapper->id;
            $vehiclesMapper->next();
        }

        $tripsInfo = [];
        $tripsMapper->day = "DAY(start_date)";  // https://fatfreeframework.com/3.6/databases#VirtualFields
        $tripsMapper->counter = "COUNT(*)";
        $tripsMapper->load(array_merge(
            ["vehicles_id IN (?".str_repeat(", ?", count($vehicleIDs)-1).")"],
            $vehicleIDs
        ), ["group" => "DAY(start_date)"]);
        if ($tripsMapper->dry()) {
            $this->f3->error(404, "Company has no trips");
            return;
        }
        while ($tripsMapper->valid()) {
            $tripsInfo[(string)$tripsMapper->day] = (int)$tripsMapper->counter;
            $tripsMapper->next();
        }
        $this->f3->set("trips", $tripsInfo);
        return;
    }
}