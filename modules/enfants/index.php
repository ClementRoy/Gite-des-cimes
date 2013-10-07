<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/header.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/menu.php'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/breadcrumb.php'); ?>


	<div class="container">

		<div class="content">
			<h1>Display homepage widgets here</h1>
		</div>

	
<div id="tablewrapper">
		<div id="tableheader">
        	<div class="search">

<div class="row">
  <div class="col-lg-2">
    <select id="columns" class="form-control" onchange="sorter.search('query')"></select>
  </div>
  <div class="col-lg-4">
    <input type="text" id="query"class="form-control" placeholder="Tapez votre recherche ici..." onkeyup="sorter.search('query')">
  </div>
  <div class="col-lg-2 col-lg-offset-4 text-right">
    <a href="javascript:sorter.reset()" class="btn btn-primary">Remettre à zéro</a>
  </div>
</div>


                
                
            </div>
            <span class="details">
				<div>Records <span id="startrecord">1</span>-<span id="endrecord">10</span> of <span id="totalrecords">49</span></div>
        		
        	</span>
        </div>

        <table id="table" class="table table-striped tinytable">
            <thead>
                <tr>
                    <th class="asc"><h3>Prénom</h3></th>
                    <th class="head"><h3>Nom</h3></th>
                    <th class="head"><h3>Date de naissance</h3></th>
                    <th class="unsort"><h3>actions</h3></th>
                </tr>
            </thead>
            <tbody>
				<tr class="evenrow" onmouseover="sorter.hover(0,1)" onmouseout="sorter.hover(0,0)">
					<td class="evenselected">Christophe</td>
					<td>Béghin</td>
					<td>02/01/1990</td>
					<td>actions...</td>
				</tr>
				<tr class="evenrow" onmouseover="sorter.hover(0,1)" onmouseout="sorter.hover(0,0)">
					<td class="evenselected">Clément</td>
					<td>Roy</td>
					<td>02/05/1990</td>
					<td>actions...</td>
				</tr>
				<tr class="evenrow" onmouseover="sorter.hover(0,1)" onmouseout="sorter.hover(0,0)">
					<td class="evenselected">Nedjma</td>
					<td>Behlouli</td>
					<td>01/12/1989</td>
					<td>actions...</td>
				</tr>
				<tr class="evenrow" onmouseover="sorter.hover(0,1)" onmouseout="sorter.hover(0,0)">
					<td class="evenselected">Coraline</td>
					<td>Assimon</td>
					<td>23/04/1989</td>
					<td>actions...</td>
				</tr>
            </tbody>
		</table>



        <div id="tablefooter">
          <div id="tablenav" style="display: block;">
            	<div>
                    <i class="icon-step-backward" onclick="sorter.move(-1,true)"></i>
                    <i class="icon-chevron-left" onclick="sorter.move(-1)"></i>
                    <i class="icon-chevron-right" onclick="sorter.move(1)"></i>
                    <i class="icon-step-forward" onclick="sorter.move(1,true)"></i>
                </div>
                <div>
                	<select id="pagedropdown" onchange="sorter.goto(this.value)"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select>
				</div>
                <div class="btn-reset"><a class="button blue" href="javascript:sorter.showall()">view all</a>
                </div>
            </div>
			<div id="tablelocation">
            <div>
                    <select onchange="sorter.size(this.value)">
                    <option value="5">5</option>
                        <option value="10" selected="selected">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="txt-page">Entries Per Page</span>
                </div>

            	
                <div class="page txt-txt">Page <span id="currentpage">1</span> of <span id="totalpages">5</span></div>
            </div>
        </div>
    </div>


	</div><!-- /.container -->


<?php require($_SERVER["DOCUMENT_ROOT"] . '/parts/footer.php'); ?>