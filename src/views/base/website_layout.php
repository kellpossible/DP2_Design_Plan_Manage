<!DOCTYPE html>
<html>
    <head>
		<title><?=$this->e($title)?></title>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-sacle=1.0"/>
		<!-- Bootstrap -->
		<link href="/static/css/bootstrap.min.css" rel="stylesheet"/>
	</head>
	<body>
		<div class="container - fluid">
			<div class ="row">
				<div class="col-md-8"><h1> Logo </h1></div>
				<div class="col-md-4"><br />
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            </button>
                        </span>
                    </div>
                </div>
			</div>
			<nav class="navbar navbar-default">
				<?php $navbar = [
					"Home" => "/index.php",
					"Inventory" => "/index.php/Inventory/ViewInventory",
					"Add Stock Item" => "/index.php/Inventory/NewItem",
					"Stock Report" => "/index.php/Report/ViewStockReport"
				];

				$path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
				?>
				<ul class="nav navbar-nav">
					<?php foreach($navbar as $item_name=>$href_value): ?>
						<li<?php if($path == trim($href_value, "/")): ?> class="active"<?php endif ?>>
						<a href="<?=$href_value?>"><?=$item_name?></a>
						</li>
					<?php endforeach ?>
				</ul>
			</nav>

		<?=$this->section('content')?>

            
        <p><b>this is the footer testing layout is functioning</b></p>    
        
            
		</div>
		<!--jQuery - required for Bootstrap's JavaScript plugins) -->
		<script src="/static/js/jquery.min.js"></script>
		
		<!--All Bootstrap plugin files-->
		<script src="/static/js/bootstrap.min.js"></script>
	</body>
</html>