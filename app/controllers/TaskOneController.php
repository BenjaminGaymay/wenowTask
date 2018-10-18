<?php
namespace controllers;

use models\SqlModelFactory;

class TaskOneController implements ControllerInterface
{
    /** @var \Base */
    private $f3;

    /**
     * TaskOneController constructor.
     * @param \Base $f3
     */
    public function __construct($f3)
    {
        $this->f3 = $f3;
    }

    public function display()
    {
        $this->setData();

        $this->f3->set('title','Task1 presentation');
        echo \Template::instance()->render('taskOne-view.html');
        return;
    }

    private function setData()
    {
        $companiesMapper = SqlModelFactory::instance()->getMapper('companies');
        $vehiclesMapper = SqlModelFactory::instance()->getMapper('vehicles');
        $tripsMapper = SqlModelFactory::instance()->getMapper('trips');

        $companiesMapper->load();
        if ($companiesMapper->dry()) {
            $this->f3->error(404, "Company not found");
            return;
        }

        $companyResults = [];
        while ($companiesMapper->valid()) {
            $vehiclesMapper->counter = "COUNT(*)";
            $companyResults[$companiesMapper->name] = [
                "inactives" => $vehiclesMapper->load(["company_id=? AND active=?", (int)$companiesMapper->id, 0])->counter,
                "actives" => $vehiclesMapper->load(["company_id=? AND active=?", (int)$companiesMapper->id, 1])->counter,
            ];

            $companiesMapper->next();
        }

        $this->f3->set("results", $companyResults);
        return;
    }
}