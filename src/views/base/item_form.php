<?php $this->layout('base::website_layout', ['title' => $title]) ;
/** show a table of items in the inventory */
?>

<h1><?=$this->e($message)?></h1>
<form name="<?=$this->e($form['id'])?>" action="<?=$this->e($form['action'])?>" method="post">
    <fieldset class="form-group">
      <?php foreach($form['inputs'] as $form_input): ?>
        <?php if(isset($form_input['label'])): ?>
          <label for="<?=$this->e($form_input['id'])?>">
            <?=$this->e($form_input['label'])?>
          </label>
        <?php endif ?>
        <input type="<?=$this->e($form_input['type'])?>" class="form-control"
        id="<?=$this->e($form_input['id'])?>"
        name="<?=$this->e($form_input['id'])?>"
        <?php if(isset($form_input['value'])): ?>
          value="<?=$this->e($form_input['value'])?>"
        <?php endif ?>
        />
      <?php endforeach ?>
    </fieldset>
    <input type="submit" value="<?=$this->e($form['button_label'])?>" class="btn btn-primary col-md-offset-10 col-md-2"/>
</form>
