<?php echo $this->render('header.html',NULL,get_defined_vars(),0); ?>
<div class="jumbotron">
    <div class="container">
        <h1>Tasks</h1>
        <p>These are three tasks to do. And a sample to get inspired.</p>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="list-group">
                <a href="sample" class="list-group-item">
                    Trips per hour
                    <span class="label label-success">Sample</span>
                </a>
                <a href="taskOne" class="list-group-item">
                    Trips stats per company
                    <span class="label label-warning">Task 1</span>
                </a>
                <a href="taskTwo" class="list-group-item">
                    Vehicles in companies
                    <span class="label label-warning">Task 2</span>
                </a>
                <a href="taskThree" class="list-group-item">
                    Trips stats per vehicle
                    <span class="label label-warning">Task 3</span>
                </a>
            </div>
        </div>
    </div>
</div>
<?php echo $this->render('footer.html',NULL,get_defined_vars(),0); ?>