<?php

namespace controllers;

use models\SqlModelFactory;

class TaskTwoController implements ControllerInterface
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

        echo \Template::instance()->render('taskTwo-view.html');
        return;
    }

    private function setData()
    {
        $companiesMapper = SqlModelFactory::instance()->getMapper('companies');
        $vehiclesMapper = SqlModelFactory::instance()->getMapper('vehicles');

        $vehiclesMapper->load();
        if ($vehiclesMapper->dry()) {
            $this->f3->error(404, "Company not found");
            return;
        }

        $results = [];
        while ($vehiclesMapper->valid()) {
            $results[$vehiclesMapper->plates] = [
                "active" => $vehiclesMapper->active == 0 ? "false" : "true",
                "company_name" => $companiesMapper->load(["id=?", (int)$vehiclesMapper->company_id])->name,
            ];

            $vehiclesMapper->next();
        }

        $this->f3->set("results", $results);
        return;
    }
}