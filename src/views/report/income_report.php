<?php $this->layout('base::website_layout', [
  'title' => 'Sales Income Report',
  'models' => $models
  ]);   
    
?>

<h1>Sales income report</h1>

<form name="income_report" action="<?=$_SERVER['PHP_SELF'];?>" method="post">
    <div class="radio col-md-offset-10">
        <label><input type="radio" value="-6 days" name="date">Weekly</label>
    </div>
    <div class="radio col-md-offset-10">
        <label><input type="radio" value="-1 month" name="date">Monthly</label>
    </div>
        <input type="submit" value="Create Report" class="btn btn-primary col-md-offset-10 col-md-2"/>
    </form>
    <br/><br/>

<?php

if(isset($_POST['date'])){

    //$sales_income = $purchases->getSalesIncome($date);
    
        $p->data = array(array(array("Dove",48.25),array("Sukin",238.75),array("Colgate",95.50),array("...",300.50),array("Dove Fresh",286.80),array("Libra",400)));
    
        
        $p->chart_type = "bar"; 

        // Common Options 
        $p->title = "Income"; 
        $p->xlabel = "Product"; 
        $p->ylabel = "Income made"; 

        $out = $p->render('c1'); 
        echo $out;
}
?>