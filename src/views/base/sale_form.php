<?php $this->layout('base::website_layout', ['title' => $title]) ;
/** show a table of sales in the Purchases Table */
?>

<form name="<?=$this->e($form)?>" action="<?=$this->e($action)?>" method="post">
    
    <input type="submit" value="<?=$this->e($buttonValue)?>" class="btn btn-primary col-md-offset-10 col-md-2"/>	
</form>