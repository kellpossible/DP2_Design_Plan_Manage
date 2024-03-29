<!DOCTYPE html>
<html>
    <head>
		<title><?=$this->e($title)?></title>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-sacle=1.0"/>
		<!-- Bootstrap -->
		<link href="/static/css/bootstrap.min.css" rel="stylesheet"/>
        <!--jQuery - required for Bootstrap's JavaScript plugins) -->
		<script src="/static/js/jquery.min.js"></script>
		<!--All Bootstrap plugin files-->
		<script src="/static/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container - fluid">
			<div class ="row">
				<div class="col-md-8"><img src="/static/images/logo.png"/></div>
				<div class="col-md-4"><br /><br /><br /><br />
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
					"Home" => "/",
					"Inventory" => "/Inventory/ViewInventory",
					"Add Stock Item" => "/Inventory/NewItem",
					"Stock Report" => "/Report/NewStockReport",
          "Download Report CSV" => "/Report/DownloadSalesReportCSV"
				];

        $users = $models['users'];

        if ($users->isLoggedIn())
        {
          $navbar["Logout"] = "/Login/Logout";
        } else {
          $navbar["Login"] = "/Login/Login";
        }

				$path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
				?>
				<ul class="nav navbar-nav">
					<?php foreach($navbar as $item_name=>$href_value): ?>
						<li <?=$this->uri($href_value,'class="active"')?>>
						<a href="/index.php<?=$href_value?>"><?=$item_name?></a>
						</li>
					<?php endforeach ?>
				</ul>
			</nav>

		<?=$this->section('content')?>

		</div>
        <footer class="footer">
            <div class="container">
                <div class="well">
				<div id="footer" align="center">
            <p><a href="/static/images/Manual.pdf"><strong>User Manual</strong></a> </br>

             &copy; People Health Pharmacy Sales Reporting System
               </p>
               </div>
                </div>
            </div>
        </footer>
	</body>
</html>
